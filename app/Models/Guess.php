<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guess extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'daily_challenge_id', 'type', 'guess_id', 'is_correct'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dailyChallenge()
    {
        return $this->belongsTo(DailyChallenge::class);
    }
}

