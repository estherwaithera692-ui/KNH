<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Employee ID',
            'First Name',
            'Last Name',
            'Gender',
            'Date of Birth',
            'National ID',
            'Contact Number',
            'Email',
            'Address',
            'Job Title',
            'Department',
            'Qualification',
            'Years of Experience',
            'Date Joined',
            'License Number',
            'License Expiry Date',
            'Certificate Path',
            'Emergency Contact Name',
            'Emergency Contact Relationship',
            'Emergency Contact Phone',
            'Role',
            'Created At',
            'Updated At',
        ];
    }
}
