<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int $seats
 *
 * @method static find(int $id)
 * @method static Builder where(string $column, int $value)
 */
class Table extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'seats'
    ];

    public $timestamps = false;
}
