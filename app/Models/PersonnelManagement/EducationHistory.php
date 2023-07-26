<?php

namespace App\Models\PersonnelManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_name',
        'qualification_obtained',
        'year',
        'id',
        'personnel_id'
    ];
}
