<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Reply;
use App\Discussion;
use Notification;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    

    public function create() 
    {
    	return view('discussion');
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
    		'channel_id' 	=> 'required',
    		'content' 		=>'required',
    		'title' 		=> 'required'
    	]);

    	$discussion = Discussion::create([
    		'user_id'	 	=> Auth::id(),
    		'channel_id' 	=> $request->channel_id,
    		'title' 		=> $request->title,
    		'content' 		=> $request->content,
    		'slug'			=> str_slug($request->title)
    	]);

    	if($discussion) {
    		Session::flash('success', 'Record successfully saved!');
    	} else {
    		Session::flash('error', 'An error occured while saving the data. Please refresh the page!');
    	}

    	return redirect()->route('discussion',['slug' => $discussion->slug]);
    }

    public function show(Request $request)
    {
    	$discussion = Discussion::where('slug', $request->slug)->first();
    	if(!$discussion) return abort(404);
        $bestAnswer = $discussion->replies()->where('best_answer', 1)->first();
    	return view('discussions.show')
                        ->with('discussion', $discussion)
                        ->with('bestAnswer', $bestAnswer);

    }

    public function edit(Request $request)
    {
        $discussion = Discussion::where('slug', $request->slug)->first();
        if(!$discussion) return abort(404);
        return view('discussions.edit')->with('discussion', $discussion);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'channel_id'    => 'required',
            'content'       =>'required',
            'title'         => 'required'
        ]);

        $discussion = Discussion::find((int)$id);
        if(!$discussion)
            return abort(404);

        $discussion->title      = $request->title;
        $discussion->channel_id = $request->channel_id;
        $discussion->content    = $request->content;
        $rs                     = $discussion->save();

        if($rs) {
            Session::flash('success', 'Record successfully saved!');
        } else {
            Session::flash('error', 'An error occured while saving the data. Please refresh the page!');
        }

        return redirect()->back();
    }

    public function reply(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required'
        ]);

        $discussion = Discussion::find((int)$request->id);
        if(!$discussion) return abort(404);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $request->id,
            'content' => $request->reply
        ]);

        if($reply) {
            if($reply->user_id == Auth::id()) {
                $reply->user->points += 10;
            } else {
                $reply->user->points += 20;
            }
            $reply->user->save();
            Session::flash('success', 'Reply successfully saved!');
            if($discussion) {
                $watchers = [];
                foreach ($discussion->watchers as $watcher) {
                    array_push($watchers, User::find($watcher->user_id));
                }
                if(count($watchers)) {
                    Notification::send($watchers, new \App\Notifications\DiscussionNotifications($discussion));
                }
            }
        } else {
            Session::flash('error', 'An error occured while replying to this forum. Please refresh the page!');
        }

        return redirect()->back();
    }
}
