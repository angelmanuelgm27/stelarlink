<?php

namespace App\Models;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'payment_method_id',
    ];

    /**
     * Get the post's file.
     */
    public function file(): MorphOne
    {
        return $this->morphOne(Task::class, 'fileable');
    }

    /**
     * Get the post's task.
     */
    public function payment_method(): HasOne
    {
        return $this->hasOne(PaymentMethod::class);
    }

    /**
     * Get the post's task.
     */
    public function client(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
