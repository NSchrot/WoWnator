<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'type', 'faction', 'xpac', 'source','description', 'image_url', 'icon_url'];
}