<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Collection;
use Lendings\Item;
use Lendings\Lending;
use Lendings\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LendItemsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_lend_items()
    {
        // Given we have a logged-in user and an item
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $item = factory(Item::class)->create();

        // And that user posts to /lendings with an item ID
        $response = $this->json(
            'POST',
            route('lendings.store'), [
            'item_id' => $item->id,
        ]);

        $response->assertRedirect();

        // A new lending is made that associates that item with a user
        $this->assertDatabaseHas(
            'lendings', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    /** @test */
    public function a_guest_can_not_lend_items()
    {
        $this->assertFalse(auth()->check());

        $item = factory(Item::class)->create();
        // And that user posts to /lendings with an item ID
        $response = $this->json(
            'POST',
            route('lendings.store'), [
            'item_id' => $item->id,
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function a_user_can_see_his_lendings_only()
    {
        $this->disableExceptionHandling();

        // Given we have a user
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // who has lendings associatet with them
        /** @var Collection $usersLendings */
        $usersLendings = factory(Lending::class, 3)->create(['user_id' => $user->id]);
        $usersLendings->load('item');

        // And there are other lendings that are NOT associated with this user
        $otherLendings = factory(Lending::class, 3)->create();
        $otherLendings->load('item');

        // The user can see his (and only his) lendings
        $response = $this->get(route('lendings.index'));

        $usersLendings->each(
            function ($lending) use ($response) {
                $response->assertSee($lending->item->name);
            });

        $otherLendings->each(
            function ($lending) use ($response) {
                $response->assertDontSee($lending->item->name);
            });
    }

    /** @test */
    public function a_user_can_only_lend_items_that_are_available()
    {
        // Given we have a user and an item
        $user = factory(User::class)->create();
        $item = factory(Item::class)->create();
        $this->actingAs($user);

        // If the user lends an item
        $this->json(
            'POST',
            route('lendings.store'),
            [
                'item_id' => $item->id,
            ]
        );

        // the item becomes unavailable and can not be lent anymore
        $response = $this->json(
            'POST',
            route('lendings.store'),
            [
                'item_id' => $item->id,
            ]
        );

        //dd($response);

        $response->assertRedirect();
        $response->assertSessionHasErrors('item');
    }
}
