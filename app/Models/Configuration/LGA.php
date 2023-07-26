<?php

namespace App\Models\Configuration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGA extends Model
{
    use HasFactory;

    protected $fillables = [
        'name',
        'state_id'
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
