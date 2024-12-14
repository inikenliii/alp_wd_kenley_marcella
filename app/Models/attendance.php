<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class attendance extends Model
{
    use HasFactory;

    public function attendance (): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function attendance2 (): BelongsTo
    {
        return $this->belongsTo(trainsession::class);
    }
}
