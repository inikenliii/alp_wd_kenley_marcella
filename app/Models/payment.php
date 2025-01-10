<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'amount',
        'payment_status',
        'payment_date',
        'description',
    ];

    public function user (): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
