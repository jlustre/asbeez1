<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   //this is used for mass assignment
   protected $fillable = ['title','body'];
   
   //Each question belongs to a user
   public function user() {
   	 return $this->belongsTo('App\User');
   }

}
