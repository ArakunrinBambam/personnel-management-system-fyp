<?php

namespace App\Models\PersonnelManagement;

use App\Enums\MaritalStatusEnum;
use App\Enums\PersonnelMaritalStatus;
use App\Models\Configuration\Department;
use App\Models\Configuration\Establishment;
use App\Models\Configuration\Faculty;
use App\Models\Configuration\LGA;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'surname',
        'middlename',
        'staffno',
        'nationality',
        'lga_id',
        'address',
        'date_of_birth',
        'hometown',
        'sex',
        'email',
        'phone',
        'marital_status',
        'department_id',
        'appointment_type',
        'establishment_id',
        'passport',
        'signature',
        'date_of_first_appointment',
        'date_of_confirmation',
        'user_id',
        'designation',
        'title'

    ];


    protected $casts = [
        'marital_status' => PersonnelMaritalStatus::class
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = json_encode($value);
    }

    public function getTitleAttribute($value)
    {
        return $this->attributes['title'] = json_decode($value);
    }


    public function educationHistory()
    {
        return $this->hasMany(EducationHistory::class);
    }

    public function nextOfKin()
    {
        return $this->hasOne(NextOfKin::class);
    }

    public function employmentHistory()
    {
        return $this->hasMany(EmploymentHistory::class);
    }

    public function promotionHistory()
    {
        return $this->hasMany(PromotionHistory::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function lga()
    {
        return $this->belongsTo(LGA::class);
    }

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

}
