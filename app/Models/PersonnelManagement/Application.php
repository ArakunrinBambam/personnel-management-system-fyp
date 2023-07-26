<?php

namespace App\Models\PersonnelManagement;

use App\Enums\ApplicationStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'personnel_id',
        'title',
        'category',
        'supporting_document',
        'status',
        'user_id',
        'remark'
    ];

    protected $casts = [
        'status' => ApplicationStatus::class,
        // 'category' => ApplicationCategory::class
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class,'personnel_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
