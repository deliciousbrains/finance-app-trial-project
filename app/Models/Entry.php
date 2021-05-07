<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Entry
 * @package App\Models
 * @property int $id
 * @property string $label
 * @property float $value
 * @property Carbon $date
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 */
class Entry extends Model
{
    // explicit > implicit
    protected $table = 'entries';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'float',
        'date' => 'datetime',
    ];
}
