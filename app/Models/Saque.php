<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saque extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor',
        'status',
        'liberacao',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusFormatedAttribute()
    {
        if ($this->status == 0) {
            return 'PENDENTE';

        }
        if ($this->status == 1) {
            return 'PAGA';
        }
        if ($this->status == 2) {
            return 'ESTORNADA';
        }
    }
}
