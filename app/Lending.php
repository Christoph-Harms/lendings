<?php

namespace Lendings;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lending
 *
 * @package Lendings
 */
class Lending extends Model
{
    protected $guarded = [];

    protected $visible =[
        'item_id', 'user_id', 'created_at',
    ];

    protected $casts = [
        'item_id' => 'integer',
        'user_id' => 'integer',
    ];

    protected $with = [
        'item',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
