<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallationServices extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'description',
        'image',
    ];
}
