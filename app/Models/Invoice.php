<?php

namespace App\Models;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Invoice extends Model
{

    use HasFactory;

    /**
     *
     */
    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

}
