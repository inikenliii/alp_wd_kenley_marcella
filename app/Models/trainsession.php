<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class trainsession extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainsession_date',
        'image',
        'start_time',
        'end_time',
        'description',
        'class_id',
    ];

    protected $table = 'trainsessions';

    public function attendance (): HasMany
    {
        return $this->HasMany(attendance::class);
    }

    public function classs(): BelongsTo
    {
    return $this->belongsTo(classs::class, 'class_id');
    }
    
    public function users(): BelongsToMany
    {
    return $this->belongsToMany(User::class, 'train_session_user');
    }
}
