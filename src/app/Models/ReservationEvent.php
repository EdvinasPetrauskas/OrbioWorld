<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property array $available_restaurant_tables_ids
 * @property int $available_seats
 *
 * @method static Builder where(string $column, string $value)
 */
class ReservationEvent extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'restaurant_name',
        'reservation_date',
        'available_restaurant_tables_ids',
        'available_seats'
    ];

    protected $casts = [
        'available_restaurant_tables_ids' => 'array'
    ];

    public $timestamps = false;
}
