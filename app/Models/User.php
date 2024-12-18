<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

     public function user1 (): HasMany
     {
         return $this->HasMany(attendance::class);
     }
     public function user2 (): HasMany
     {
         return $this->HasMany(payment::class);
     }
     public function classs(): BelongsTo
    {
    return $this->belongsTo(classs::class);
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

    public static function allData(){
        return self::$fillable;
    }

    public static function findData($id) {
        $all = self::$fillable;
        foreach ($all as $pro) {
            if ($pro[0]==$id){
                return $pro;
            }
        }
    }
}
