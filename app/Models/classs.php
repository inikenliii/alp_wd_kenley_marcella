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
        return $this->HasMany(User::class);
    }

    public function trainsessions (): HasMany
    {
        return $this->HasMany(trainsession::class);
    }
}
