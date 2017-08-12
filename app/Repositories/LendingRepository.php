<?php
/**
 * Created by IntelliJ IDEA.
 * User: chensink_privat
 * Date: 11.08.17
 * Time: 15:46
 */

namespace Lendings\Repositories;


use Lendings\Item;
use Lendings\Lending;
use Lendings\User;

class LendingRepository
{
    public function lendOne(Item $item, User $user): Lending
    {
        if ($item->available) {
            $item->qty_available -= 1;
            $item->save();
            /** @noinspection PhpDynamicAsStaticMethodCallInspection */
            return Lending::create([
                'item_id' => $item->id,
                'user_id' => $user->id,
            ]);
        }
        return null;
    }
}