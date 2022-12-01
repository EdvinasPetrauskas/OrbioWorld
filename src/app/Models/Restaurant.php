<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 *
 * @method static Builder where(string $column, string $value)
 */
class Restaurant extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    /**
     * @return BelongsToMany
     */
    public function tables(): BelongsToMany
    {
        return $this->belongsToMany(Table::class, 'restaurant_tables')->withPivot('id');
    }
}
