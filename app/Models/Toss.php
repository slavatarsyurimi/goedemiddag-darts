<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Toss extends Model
{
    /**
     * The visit that this toss belongs to.
     */
    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }
}
