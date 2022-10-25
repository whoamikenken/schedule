<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'remarks',
        'applicant_id',
        'diploma',
        'created_by'
    ];
}
