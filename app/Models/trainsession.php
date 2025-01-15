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

    protected $fillable = [
        'class_id',
        'user_id',
        'image',
        'trainsession_date',
        'start_time',
        'end_time',
        'description',
    ];

    public function attendance (): HasMany
    {
        return $this->hasMany(attendance::class);
    }

    public function classs(): BelongsTo
    {
    return $this->belongsTo(classs::class, 'class_id');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }          
}

