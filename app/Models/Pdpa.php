<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdpa extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'cookies',
        'policys',
        'publish',
    ];
}
