<?php

namespace Lendings;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
 * @property string $name      The name of the item
 * @property bool   $available Whether or not the item is currently available.
 */
class Item extends Model
{
    protected $guarded = [];

    protected $visible = [
        'name',
    ];
}
