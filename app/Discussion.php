<?php

namespace App;

use Auth;
use App\Watcher;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['channel_id', 'user_id', 'title', 'content', 'slug'];

    public function channel()
    {
    	return $this->belongsTo(Channel::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function replies()
    {
    	return $this->hasMany(Reply::class);
    }

    public function watchers()
    {
        return $this->hasMany(Watcher::class);
    }

    public function is_being_watch_by_auth_user()
    {   
        $id = Auth::id();
        // option 1
        // $watchers_id = [];
        // foreach ($this->watchers as $watcher) {
        //     array_push($watchers_id, $watcher->user_id);
        // }

        // if( in_array($id, $watchers_id) ) {
        //     return true;
        // } 
        // return false;

        // options 2
        return Watcher::where('user_id', $id)->where('discussion_id', $this->id)->count();
        
    }

    public function has_best_answer()
    {
        $found = false;
        foreach ($this->replies as $reply) {
            if($reply->best_answer) {
                $found = true;
                break;
            }
        }
        return $found;
    }
}
