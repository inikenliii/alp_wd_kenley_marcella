<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class classs extends Model
{
    use HasFactory;

    public function class1 (): HasMany
    {
        return $this->HasMany(User::class);
    }

    public function class2 (): HasMany
    {
        return $this->HasMany(trainsession::class);
    }
}
