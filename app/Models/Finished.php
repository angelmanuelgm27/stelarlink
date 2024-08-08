<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Finished extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'paid',
    ];

    /**
     * Get the parent finishedable model (user or post).
     */
    public function finishedable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the post's task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post's file.
     */
    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

}
