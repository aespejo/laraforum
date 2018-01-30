<?php

namespace App\Http\Controllers;

use Session;
use Auth;
use App\Like;
use App\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

    public function like(Request $request, $id)
    {
        $rs = Reply::find((int)$id);
        if(!$rs) return redirect()->back();

        Like::create([
        	'user_id' 	=> Auth::id(),
        	'reply_id' 	=> $id
        ]);
        Session::flash('success', 'Reply successfully liked');
        return redirect()->back();
    }


    public function unlike(Request $request, $id)
    {
      	$like = Like::where('user_id', Auth::id())->where('reply_id', $id)->first();
      	$like->delete();
      	Session::flash('success', 'Reply successfully unliked');
      	return redirect()->back();
    }

    public function mark_best_answer(Request $request, $id)
    {
        $reply = Reply::find($id);
        if(!$reply)
            return abort(404);

        $reply->best_answer = 1;
        $reply->save();
        
        $reply->user->points += 20;
        $reply->user->save();

        Session::flash('success', 'Successfully marked as best answer');
        return redirect()->back();
    }

    public function unmark_best_answer(Request $request, $id)
    {
        $reply = Reply::find($id);
        if(!$reply)
            return abort(404);

        $reply->best_answer = 0;
        $reply->save();

        $reply->user->points -= 20;
        $reply->user->save();

        Session::flash('success', 'Successfully unmarked as best answer');
        return redirect()->back();
    }

    public function delete_reply(Request $request, $id)
    {
        $reply = Reply::find($id);
        if(!$reply)
            return abort(404);

        if($reply->user_id == Auth::id()) {
            if($reply->best_answer == 1) {
                $reply->user->points -= 20; // best answer
            }
            $reply->user->points -= 10;     // comment
        } else {
            $reply->user->points -= 20;     // comment
        }
        $reply->user->save();
        $reply->delete();
        Session::flash('success', 'Reply successfully deleted!');
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        return view('replies.edit')->with('reply', Reply::find((int)$id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required'
        ]);
        
        $reply = Reply::find($id);
        if(!$reply) return abort(404);

        $reply->content = $request->reply;
        
        if($reply->save()) {
            Session::flash('success', 'Reply successfully updated!');
        } else {
            Session::flash('error', 'An error occured while updating the record!');
        }

        return redirect()->route('discussion', ['slug' => $reply->discussion->slug]);
    }

}
