<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $table_id
 * @method static find(int $id)
 * @method static Builder where(string $column, string $value)
 */
class RestaurantTable extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'restaurant_id',
        'table_id'
    ];

    public $timestamps = false;


}
