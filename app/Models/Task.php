<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Task extends Model
{

    use HasFactory;

    public static $task_names = [
        'App\Models\Solicitudes' => 'Solicitud de instalación',
    ];

    /**
     * Get the parent taskable model (user or post).
     */
    public function taskable(): MorphTo
    {
        return $this->morphTo();
    }

}
