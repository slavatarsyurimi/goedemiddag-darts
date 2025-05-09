<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'full_name',
    ];

    /**
     * The matches that the player participated in.
     */
    public function matches(): BelongsToMany
    {
        return $this->belongsToMany(DartsMatch::class, table: 'match_player', relatedPivotKey: 'match_id')
            ->withPivot('remainder_points');
    }
}
