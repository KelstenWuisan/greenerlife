<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
  use HasFactory;
  
  protected $fillable = ["title", 'slug', "category_id", "location", "body", "user_id", "image"];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }
  //guarded, cuma itu doang yang gabole diisi
  //Post::find(3)->update(['title' => 'Judulberubah'])
  //Post::create([
  //'title' => 'judul',
  //blablabla,
  //])
  public static function boot() {
    parent::boot();

    static::creating(function($post) {
        if (empty($post->category_id)) {
            $post->category_id = 1; // default category ID or choose another
        }
    });
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function scopeFilter($query)
  {
    if(request('search')){
      return $query->where('title', 'like', '%' .request('search') . '%')->orWhere('body', 'like', '%' . request('search') . '%');
    }
  }

  public function rsvps()
  {
      return $this->hasMany(Rsvp::class);
  }
}
