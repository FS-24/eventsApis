<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
   protected $fillable = [
    'title',
    'content',
    'event_date',
    'photo',
    'author_id'
];

public function author(){
    return $this->belongsTo(User::class);
}

public function comments(){
    return $this->hasMany(Comment::class);
}

public function participants(){
    return $this->belongsToMany(User::class);
}
}