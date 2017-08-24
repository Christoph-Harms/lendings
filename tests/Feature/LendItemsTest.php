<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Collection;
use Laravel\Passport\Passport;
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
        $user = factory(User::class)->create();
        Passport::actingAs($user);
        $item = factory(Item::class)->create();

        $response = $this->json(
            'POST',
            route('lendings.store'), [
            'item_id' => $item->id,
        ]);

        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        $expected = Lending::where('user_id', $user->id)
            ->where('item_id', $item->id)
            ->first()->toArray();

        $response->assertStatus(200);
        $response->assertJson($expected);

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

        $this->assertDatabaseMissing(
            'lendings', [
            'item_id' => $item->id,
        ]);
    }

    /** @test */
    public function a_user_can_fetch_his_lendings_only()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        Passport::actingAs($user);

        // who has lendings associatet with them
        /** @var Collection $usersLendings */
        $usersLendings = factory(Lending::class, 3)->create(['user_id' => $user->id]);

        // And there are other lendings that are NOT associated with this user
        $otherLendings = factory(Lending::class, 3)->create();

        // The user can see his (and only his) lendings
        $response = $this->getJson(route('lendings.api_index'));

        $response->assertJson($usersLendings->toArray());
        $response->assertJsonMissing($otherLendings->toArray());
    }

    /** @test */
    public function a_user_can_only_lend_items_that_are_available()
    {
        // Given we have a user and an item
        $user = factory(User::class)->create();
        $item = factory(Item::class)->create();
        Passport::actingAs($user);

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

        $response->assertStatus(423);
    }
}
