<?php

namespace App\Models;

use App\Models\user;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TechnicalSupportGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'availability',
    ];

    /**
     * The users that belong to the technical_support_group.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(user::class);
    }

    /**
     * Get the post's task.
     */
    public function task(): HasOne
    {
        return $this->hasOne(Task::class, 'technical_support_group_id');
    }

}
