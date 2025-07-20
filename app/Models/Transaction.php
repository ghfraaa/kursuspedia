<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kursus_id',
        'amount',
        'status',
        'payment_proof',
    ];

    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kursus that the transaction belongs to.
     */
    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }
}
