<?php

// app/Models/Challenge.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'points'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_challenges')
                    ->withPivot('proof', 'completed')
                    ->withTimestamps();
    }
}
