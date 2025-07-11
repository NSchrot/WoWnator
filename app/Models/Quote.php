<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['text', 'character_id'];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
