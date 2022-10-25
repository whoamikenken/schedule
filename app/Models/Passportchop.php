<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passportchop extends Model
{
    public $table = "passport_chops";
    use HasFactory;

    protected $fillable = [
        'remarks',
        'applicant_id',
        'chops',
        'created_by'
    ];
}
