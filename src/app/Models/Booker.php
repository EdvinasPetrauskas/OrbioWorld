<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class Booker extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone'
    ];

    public $timestamps = false;
}
