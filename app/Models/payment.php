<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    public function user (): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
