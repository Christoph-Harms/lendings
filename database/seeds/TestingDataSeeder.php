<?php

use Illuminate\Database\Seeder;

class TestingDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(\Lendings\User::class)->states('admin')->create(
            [
                'name'     => 'Christoph Harms-Ensink',
                'email'    => 'c.harms.ensink@gmail.com',
                'password' => bcrypt('secret'),
            ]);

        $items = factory(\Lendings\Item::class, 50)->create();

        $items->shuffle()->take(10)->each(function ($item) use ($user) {
            factory(\Lendings\Lending::class)->create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
            /** @var \Lendings\Item $item */
            $item->qty_available -= 1;
            $item->save();
        });
    }
}
