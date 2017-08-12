<?php

namespace Lendings;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
 * @property int    $id
 * @property string $name              The name of the item
 * @property int    $quantity          The overall quantity of the item. Available and unavailable combined
 * @property int    $qty_available     The quantity of this item that is available
 * @property bool   $available         Whether or not the item is currently available.
 */
class Item extends Model
{
    protected $guarded = [];

    protected $visible = [
        'id',
        'name',
    ];

    public function getAvailableAttribute()
    {
        return $this->qty_available > 0;
    }
}
