<?php

namespace Tests\Unit;

use Lendings\Lending;
use Lendings\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_has_many_lendings()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // And that user has multiple lendings associated with him
        factory(Lending::class, 5)->create(['user_id' => $user->id]);
        // We can retrieve the user's lendings

        $this->assertCount(5, $user->lendings);
        $this->assertContainsOnlyInstancesOf(Lending::class, $user->lendings);
    }
}
