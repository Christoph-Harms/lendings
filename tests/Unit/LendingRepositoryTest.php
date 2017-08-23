<?php
/**
 * Created by IntelliJ IDEA.
 * User: chensink_privat
 * Date: 11.08.17
 * Time: 15:55
 */

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Lendings\Item;
use Lendings\Lending;
use Lendings\Repositories\LendingRepository;
use Lendings\User;
use Tests\TestCase;

class LendingRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  LendingRepository */
    protected $lendingRepo;

    protected function setUp()
    {
        parent::setUp();

        $this->lendingRepo = app(LendingRepository::class);
    }

    /** @test */
    public function it_can_lend_one_item_for_a_user()
    {
        $user = factory(User::class)->create();

        $item = factory(Item::class)->create();

        $lending = $this->lendingRepo->lendOne($item, $user);

        $this->assertInstanceOf(Lending::class, $lending);

        $this->assertDatabaseHas('lendings', $lending->toArray());
    }
}
