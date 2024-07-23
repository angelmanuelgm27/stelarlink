<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Finished extends Model
{
    use HasFactory;

    /**
     * Get the parent finishedable model (user or post).
     */
    public function finishedable(): MorphTo
    {
        return $this->morphTo();
    }

}
