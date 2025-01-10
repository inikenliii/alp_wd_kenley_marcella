<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class classs extends Model
{
    use HasFactory;
    protected $fillable = ['class_name', 'description'];
    protected $table = 'classes';

    public function users (): HasMany
    {
        return $this->hasMany(User::class, 'class_id');
    }

    public function trainsessions (): HasMany
    {
        return $this->hasMany(trainsession::class);
    }
}
