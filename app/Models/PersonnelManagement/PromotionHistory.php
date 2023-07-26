<?php

namespace App\Models\PersonnelManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'personnel_id',
        'id',
        'previous_designation',
        'new_designation',
        'date',
        'effective_date',
        'user_id'
    ];
}
