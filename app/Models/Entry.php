<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Entry
 * @package App\Models
 * @property int $id
 * @property int $userId
 * @property string $label
 * @property float $value
 * @property Carbon $date
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 * @property-read User $user
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

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
