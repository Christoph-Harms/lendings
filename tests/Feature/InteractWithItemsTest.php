<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Session;
use Lendings\Item;
use Lendings\User;
use Tests\TestCase;

class InteractWithItemsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_see_items()
    {
        $user = factory(User::class)->create();
        $items = factory(Item::class, 3)->create();

        $this->actingAs($user);

        $response = $this->get(route('items.index'));

        $response->assertStatus(200);
        $response->assertViewIs('items.index');

        $items->each(function ($item) use ($response) {
            $response->assertSee($item->name);
        });
    }

    /** @test */
    public function an_admin_can_delete_items()
    {
        $item = factory(Item::class)->create();
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
        $response = $this->delete(route('items.destroy', ['id' => $item->id]));
        //dd($response);
        $response->assertRedirect();

        $this->assertDatabaseMissing('items', $item->toArray());

    }

    /** @test */
    public function a_normal_user_can_not_delete_items()
    {
        $item = factory(Item::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->delete(route('items.destroy', ['id' => $item->id]));
        //dd($response);
        $response->assertStatus(403);

        $this->assertDatabaseHas('items', $item->toArray());
    }
}
