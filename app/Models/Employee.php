<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'national_id',
        'contact_number',
        'email',
        'address',
        'job_title',
        'department',
        'qualification',
        'years_of_experience',
        'date_joined',
        'license_number',
        'license_expiry_date',
        'certificate_path',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone',
        'role',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_joined' => 'date',
        'license_expiry_date' => 'date',
    ];
}
