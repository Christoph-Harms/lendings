<?php

namespace Lendings\Policies;

use Lendings\User;
use Lendings\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the item.
     *
     * @param  \Lendings\User  $user
     * @param  \Lendings\Item  $item
     * @return mixed
     */
    public function view(User $user, Item $item)
    {
        //
    }

    /**
     * Determine whether the user can create items.
     *
     * @param  \Lendings\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->admin == true;
    }

    /**
     * Determine whether the user can update the item.
     *
     * @param  \Lendings\User  $user
     * @param  \Lendings\Item  $item
     * @return mixed
     */
    public function update(User $user, Item $item)
    {
        //
    }

    /**
     * Determine whether the user can delete the item.
     *
     * @param  \Lendings\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->admin == true;
    }
}
