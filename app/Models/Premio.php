<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'meta_id',
        'status'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }
}
