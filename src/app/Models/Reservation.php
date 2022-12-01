<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Builder where(string $column, string $value)
 */
class Reservation extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'booker_id',
        'restaurant_name',
        'reserved_restaurant_tables_ids',
        'reservation_date',
    ];

    protected $casts = [
        'reserved_restaurant_tables_ids' => 'array'
    ];

    public $timestamps = false;
}
