<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Question extends Model
{
   use VotableTrait;
   
   //this is used for mass assignment
   protected $fillable = ['title','body'];
   
   //Each question belongs to a user
   public function user() {
   	 return $this->belongsTo('App\User');
   }
  
  	public function answers() {
        return $this->hasMany('App\Answer')->orderBy('votes_count','DESC');
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
      return clean($this->bodyHtml());
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

  public function getExcerptAttribute() {
    return $this->excerpt(250);
  }

  public function excerpt($length) {
    return Str::limit(strip_tags($this->bodyHtml()), $length);
  }

  private function bodyHtml() {
    return \Parsedown::instance()->text($this->body); 
  }
}
