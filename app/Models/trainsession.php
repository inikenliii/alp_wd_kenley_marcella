<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class trainsession extends Model
{
    use HasFactory;

    protected $table = 'trainsessions';

    public function attendance (): HasMany
    {
        return $this->HasMany(attendance::class);
    }

    public function classs(): BelongsTo
    {
    return $this->belongsTo(classs::class, 'class_id');
    }
    
    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
