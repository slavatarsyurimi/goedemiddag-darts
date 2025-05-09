<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DartsMatch extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'matches';

    /**
     * The players that participate in the match.
     */
    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, table: 'match_player', foreignPivotKey: 'match_id')
            ->withPivot('remainder_points');
    }

    /**
     * The visits for the match.
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, foreignKey: 'match_id');
    }

    /**
     * The winner of this match based on remaining points.
     */
    public function winner(): Attribute
    {
        return Attribute::make(
            get: fn () => $this
                ->players()
                ->wherePivot('remainder_points', 0)
                ->first(),
        );
    }
}
