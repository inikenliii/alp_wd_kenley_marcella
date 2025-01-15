<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'name',
        'phone_number',
        'address',
        'birth_date',
        'image_profile',
        'class_id',
        'isAdmin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function classs(): BelongsTo
    {
        return $this->belongsTo(Classs::class, 'class_id');
    }

    public function trainsession(): HasMany
    {
        return $this->hasMany(TrainSession::class);
    }

    // Booted method to assign default class_id based on age
    protected static function booted()
    {
        static::creating(function ($user) {
            $user->class_id = User::assignClassBasedOnAge($user->birth_date);
        });
    }

    // Helper function to assign class based on age
    public static function assignClassBasedOnAge(string $birthDate): ?int
    {
        $classes = Classs::all();
        $age = now()->year - date('Y', strtotime($birthDate));

        return match (true) {
            $age >= 10 && $age <= 12 => $classes->where('class_name', 'KU 12')->first()?->id,
            $age >= 12 && $age <= 14 => $classes->where('class_name', 'KU 14')->first()?->id,
            $age >= 14 && $age <= 16 => $classes->where('class_name', 'KU 16')->first()?->id,
            $age >= 16 && $age <= 18 => $classes->where('class_name', 'KU 18')->first()?->id,
            $age > 18 => $classes->where('class_name', 'Adult')->first()?->id,
            default => null,
        };
    }
}
