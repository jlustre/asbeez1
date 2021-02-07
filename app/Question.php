<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Question extends Model
{
   //this is used for mass assignment
   protected $fillable = ['title','body'];
   
   //Each question belongs to a user
   public function user() {
   	 return $this->belongsTo('App\User');
   }
  
  	public function answers() {
        return $this->hasMany('App\Answer');
    }

   public function setTitleAttribute($value) {
       $this->attributes['title'] = $value;
       //putting a dash in between each words
       $this->attributes['slug'] = Str::slug($value, '-');
   }
  
  public function getUrlAttribute() {
  	// return route("questions.show", $this->id);
      return route("questions.show", $this->slug);
  }

  public function getCreatedDateAttribute() {
  	return Carbon::parse($this->created_at)->diffForHumans();
  }

  public function getStatusAttribute() {
      if ($this->answers_count > 0) {
          if ($this->best_answer_id) {
              return "answered-accepted";
          }
          return "answered";
      } 
      return "unanswered";
  }

  public function getBodyHtmlAttribute() {
      return \Parsedown::instance()->text($this->body);
  }

  public function acceptBestAnswer(Answer $answer) {
      $this->best_answer_id = $answer->id;
      $this->save();
  }

  public function favorites() {
      return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
  }

  public function isFavorited() {
    return $this->favorites()->where('user_id', auth()->id())->count() > 0;
  }

  public function getIsFavoritedAttribute() {
    return $this->isFavorited();
  }

  public function getFavoritesCountAttribute() {
    return $this->favorites->count();
  }

  public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }

    public function upVotes()
    {
        return $this->votes()->wherePivot('vote', 1);
    }

    public function downVotes()
    {
        return $this->votes()->wherePivot('vote', -1);
    }

}
