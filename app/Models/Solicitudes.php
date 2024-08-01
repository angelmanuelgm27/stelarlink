<?php

namespace App\Models;

use App\Models\File;
use App\Models\Finished;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solicitudes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'service_id',
        'status',
        'ip',
        'group_id',
        'adrress',
        'zone_id',
        'invoice_id',
        'instalation_date',
    ];

    public static array $statuses = [
        'Pendiente',
        'Aprobada',
        'Asignada',
        'Completada',
        'Rechazada',
    ];

    /**
     * Get the post's task.
     */
    public function task(): MorphOne
    {
        return $this->morphOne(Task::class, 'taskable');
    }

    /**
     * Get all of the post's comments.
     */
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * Get all of the post's comments.
     */
    public function finisheds(): MorphMany
    {
        return $this->morphMany(Finished::class, 'finishedable');
    }

    /**
     * Get the post's task.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

}
