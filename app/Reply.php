<?php

namespace App;

use Auth;
use App\Like;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['content', 'user_id', 'discussion_id', 'best_answer'];


    public function discussion()
    {
    	return $this->belongsTo(Discussion::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function likes()
    {
    	return $this->hasMany(Like::class);
    }

    public function is_like_by_auth_user()
    {
        return Like::where('user_id', Auth::id())->where('reply_id', $this->id)->count();
    }    
}
