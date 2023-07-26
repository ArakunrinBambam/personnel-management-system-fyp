<?php

namespace App\Models\PersonnelManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'year_of_publication', 'link', 'authors', 'personnel_id', 'id'];


}
