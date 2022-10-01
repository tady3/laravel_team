<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = ['user_id_from','user_id_to','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
