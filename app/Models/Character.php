<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'gender', 'class', 'race', 'faction', 'realm', 'xpac', 'image_url', 'splash_url'];
}
