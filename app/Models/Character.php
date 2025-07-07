<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'gender', 'class', 'race', 'faction', 'realm', 'xpac', 'image_url'];
}
