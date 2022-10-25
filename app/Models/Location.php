<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $table = "location";

    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'created_by'
    ];
}
