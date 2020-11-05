<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['body', 'user_id'];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function question() {
    	return $this->belongsTo(Question::class);
    }

    public function getBodyHtmlAttribute() {
        return \Parsedown::Instance()->Text($this->body);
    }

    public static function boot() {
    	parent::boot();
    	static::created(function($answer) {
    		$answer->question->increment('answers_count');
    	});

        // static::deleted(function($answer) {
        //     $answer->question->decrement('answers_count');
        // });

        static::deleted(function($answer) {
            $answer->question->decrement('answers_count');
            //one way of setting the best answer id to null if deleting a best answer
            // $question = $answer->question;
            // $question->decrement('answers_count');
            // if ($question->best_answer_id === $answer->id) {
            //     $question->best_answer_id = NULL;
            //     $question->save();
            // }
        });
    }
    
    public function getCreatedDateAttribute() {
    	return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute() {
        return $this->id === $this->question->best_answer_id ? 'vote-accepted' : '';
    }
}
