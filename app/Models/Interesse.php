<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interesse extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'extra_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
