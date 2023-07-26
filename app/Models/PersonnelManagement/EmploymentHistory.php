<?php

namespace App\Models\PersonnelManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'personnel_id',
        'id',
        'employer',
        'employer_address',
        'designation',
        'start_date',
        'end_date'
    ];
}
