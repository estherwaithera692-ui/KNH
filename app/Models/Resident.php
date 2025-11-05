<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'identification_number',
        'phone_number',
        'email',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'state',
        'postal_code',
        'nationality_id',
        'marital_status',
        'occupation',
        'registration_date',
        'status',
        'resident_number',
        'resident_area',
        'role',
        'department',
        'medical_credentials',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'registration_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relationship with nationalities
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
}
