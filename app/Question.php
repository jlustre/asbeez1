<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
   //this is used for mass assignment
   protected $fillable = ['title','body'];
   
   //Each question belongs to a user
   public function user() {
   	 return $this->belongsTo('App\User');
   }

   public function setTitleAttribute($value) {
       $this->attributes['title'] = $value;
       //putting a dash in between each words
       $this->attributes['slug'] = Str::slug($value, '-');
   }
}
