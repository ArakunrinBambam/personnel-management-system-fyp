<?php

namespace App\Models\PersonnelManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname',
        'othernames',
        'phone',
        'address',
        'relationship',
        'id',
        'personnel_id'
    ];
}
