<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookerGuest extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'booker_id',
        'guest_id'
    ];

    public $timestamps = false;
}
