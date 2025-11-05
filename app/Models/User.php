<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'status',
        'usertype_id',
        'nationality_id',
        'id_type',
        'id_number',
        'gender',
        'role',
        // New fields for register
        'dob',
        'country',
        'address',
        'city',
        'emergency_name',
        'emergency_phone',
        'relation',
        'security_question',
        'security_answer',
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function usertype()
    {
        return $this->belongsTo(UserType::class, 'usertype_id');
    }

    public function nationality()
    {
        return $this->belongsTo(nationalities::class, 'nationality_id');
    }

    public function bioData()
    {
        return $this->hasOne(bioData::class, 'user_id');
    }
}
