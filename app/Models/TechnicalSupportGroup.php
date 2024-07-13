<?php

namespace App\Models;

use App\Models\user;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TechnicalSupportGroup extends Model
{
    use HasFactory;


    /**
     * The users that belong to the technical_support_group.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(user::class);
    }

}
