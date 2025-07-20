<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $fillable = [
        "user_id",
        "kursus_id",
        "rating",
        "komentar",
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function kursus() {
        return $this->belongsTo(Kursus::class);
    }

}
