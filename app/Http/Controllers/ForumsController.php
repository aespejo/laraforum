<?php

namespace App\Http\Controllers;

use Auth;
use App\Channel;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;


class ForumsController extends Controller
{
    public function index(Request $request)
    {
        switch ($request->filter) {
            case 'me':
                $discussions = Discussion::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(3);
                break;
            case 'answered':
                // option 1
                // $answered = [];
                // $discussions = Discussion::all();
                // if($discussions) {
                //     foreach ($discussions as $discussion) {
                //         if($discussion->has_best_answer()) {
                //             array_push($answered, $discussion);
                //         }
                //     }

                //     if(count($answered)) {
                //         $discussions = new Paginator($answered, 3);
                //     }
                // }
                // $discussions = $this->filter_discussion(true);
                $discussions = Discussion::where('discussions.user_id', Auth::id())->where('replies.best_answer', 0)
                    ->leftJoin('replies', 'replies.discussion_id', '=', 'discussions.id')
                    ->select('discussions.*')->groupBy('discussions.id')
                    ->orderBy('created_at', 'desc')->paginate(3);
                                            

                break;
            case 'unanswered':
                // option 1
                // $unanswered = [];
                // $discussions = Discussion::all();
                // if($discussions) {
                //     foreach ($discussions as $discussion) {
                //         if(!$discussion->has_best_answer()) {
                //             array_push($unanswered, $discussion);
                //         }
                //     }

                //     if(count($unanswered)) {
                //         $discussions = new Paginator($unanswered, 3);
                //     }
                // }
                // $discussions = $this->filter_discussion(false);
               $discussions = Discussion::where('discussions.user_id', Auth::id())->where('replies.best_answer', 0)
                    ->leftJoin('replies', 'replies.discussion_id', '=', 'discussions.id')
                    ->select('discussions.*')->groupBy('discussions.id')
                    ->orderBy('created_at', 'desc')->paginate(3);

                break;
            default:
                $discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);
                break;
        }
    	
    	return view('forum')->with('discussions', $discussions);	
    }

    public function channel($slug)
    {
    	$channel = Channel::where('slug', $slug)->first();
    	return view('channel')->with('discussions', $channel->discussions()->paginate(3));	
    }

    private function filter_discussion($answered = true)
    {
        // option 1
        $result = [];
        $discussions = Discussion::all();
        if($discussions) {
            foreach ($discussions as $discussion) {
                if($answered) {
                    if($discussion->has_best_answer()) {
                        array_push($result, $discussion);
                    }
                } else {
                    if(!$discussion->has_best_answer()) {
                        array_push($result, $discussion);
                    }
                }   
            }
            if(count($result)) {
                
            }
        }
        $discussions = new Paginator($result, 3);

        return $discussions;
    }
}
