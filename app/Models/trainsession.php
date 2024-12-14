<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class trainsession extends Model
{
    use HasFactory;

    public function trainsession1 (): HasMany
    {
        return $this->HasMany(attendance::class);
    }

    public function trainsession2 (): BelongsTo
    {
        return $this->belongsTo(classs::class);
    }
}
