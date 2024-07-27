<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
        'reference',
        'file_id',
        'amount_bs',
        'amount_dollar',
        'user_id_approve',
    ];

    /**
     * Get the post's file.
     */
    public function file(): MorphOne
    {
        return $this->morphOne(Task::class, 'fileable');
    }

}
