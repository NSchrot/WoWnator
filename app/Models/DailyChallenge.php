<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyChallenge extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['date', 'character_id', 'zone_id', 'quote_id', 'mount_id', 'skill_id'];

    public function character() {
        return $this->belongsTo(Character::class);
    }

    public function zone() {
        return $this->belongsTo(Zone::class);
    }

    public function quote() {
        return $this->belongsTo(Quote::class);
    }

    public function mount() {
        return $this->belongsTo(Mount::class);
    }

    public function skill() {
        return $this->belongsTo(Skill::class);
    }
    
}