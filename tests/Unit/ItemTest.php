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
    }

    /** @test */
    public function its_available_quantity_decreases_when_an_item_is_lent()
    {
        $this->lendingRepo->lendOne($this->item, factory(User::class)->create());
        $this->assertEquals(2, $this->item->qty_available);
    }

    /** @test */
    public function it_has_the_properties_it_needs()
    {
        $this->assertNotNull(filter_var($this->item->img_url, FILTER_VALIDATE_URL));
        $this->assertNotNull($this->item->description);
    }
}
