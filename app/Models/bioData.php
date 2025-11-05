<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bioData extends Model
{
    protected $fillable = [
        'identification',
        'firstName',
        'lastName',
        'gender',
        'nationality_id',
        'phoneNumber',
        'highest_academic_certificate',
        'professional_certificate',
        'C_name',
        'C_no',
        'p_No_cert',
        'p_name',
        'highest_academic_certificate_file',
        'professional_certificate_file',
        'resident_type',
        'user_id',
        'status',
        // Conditional fields
        'residence_address',
        'residence_duration',
        'visa_type',
        'visa_expiry',
        // New conditional fields for register
        'passport_no',
        'visa_no',
        'id_front',
        'id_back',
        'visa_upload',
    ];

    // Relationship with nationalities
    public function nationality()
    {
        return $this->belongsTo(\App\Models\nationalities::class, 'nationality_id');
    }

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
