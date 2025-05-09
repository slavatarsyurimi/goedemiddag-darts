<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function (Visit $visit) {
            $visit->tosses()->createMany([
                ['score' => null],
                ['score' => null],
                ['score' => null],
            ]);
        });
    }

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'player_id',
        'order',
    ];

    /**
     * The match that this visit belongs to.
     */
    public function dartsMatch(): BelongsTo
    {
        return $this->belongsTo(DartsMatch::class, foreignKey: 'match_id');
    }

    /**
     * The tosses of this visit.
     */
    public function tosses(): HasMany
    {
        return $this->hasMany(Toss::class);
    }

    /**
     * The total scroe of this visit.
     */
    protected function totalScore(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tosses->sum('score'),
        );
    }
}
