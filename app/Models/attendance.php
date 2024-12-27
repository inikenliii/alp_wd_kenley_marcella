<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    public function User (): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function trainsession (): BelongsTo
    {
        return $this->belongsTo(trainsession::class, 'train_session_id');
    }
}
