<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    public $table = "medical";
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'jobsite',
        'location',
        'contact',
        'address',
        'expiration_date',
        'created_by'
    ];
}
    


