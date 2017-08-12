<?php
/**
 * Created by IntelliJ IDEA.
 * User: chensink_privat
 * Date: 11.08.17
 * Time: 15:07
 */

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Lendings\Repositories\LendingRepository;
use Lendings\Item;
use Lendings\User;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  Item */
    protected $item;

    /** @var  LendingRepository */
    protected $lendingRepo;

    protected function setUp()
    {
        parent::setUp();

        $this->lendingRepo = app(LendingRepository::class);

        $this->item = factory(Item::class)->create([
            'quantity' => 3,
            'qty_available' => 3,
        ]);

        $this->item = $this->item->fresh();
    }

    /** @test */
    public function its_available_quantity_decreases_when_an_item_is_lent()
    {
        $this->lendingRepo->lendOne($this->item, factory(User::class)->create());
        $freshItem = $this->item->fresh();
        $this->assertEquals(2, $freshItem->qty_available);
    }
}
