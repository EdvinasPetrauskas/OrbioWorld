<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class Guest extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'email'
    ];

    public $timestamps = false;
}
