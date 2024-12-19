<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

     public function attendance (): HasMany
     {
         return $this->HasMany(attendance::class);
     }
     public function payment (): HasMany
     {
         return $this->HasMany(payment::class);
     }
     public function classs(): BelongsTo
    {
    return $this->belongsTo(classs::class);
    }
    public function trainsession (): HasMany
     {
         return $this->HasMany(trainsession::class);
     }

    protected $fillable = [
        'username',
        'password',
        'name',
        'phone_number',
        'address',
        'birth_date',
        'image_profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
