<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Watcher;
use Illuminate\Http\Request;

class WatchersController extends Controller
{
    public function watch(Request $request, $id)
    {
    	Watcher::create([
    		'discussion_id' => (int)$id,
    		'user_id' => Auth::id() 
    	]);

    	Session::flash('success', "You are watching this discussion");

    	return redirect()->back();
    }

    public function unwatch(Request $request, $id)
    {
    	$rs = Watcher::where('discussion_id', (int)$id)
    					->where('user_id', Auth::id())->first();
    	if(!$rs)
    		return abort(404);
    	$rs->delete();
    	Session::flash('success', "You are no longer watching this discussion");

    	return redirect()->back();
    }	
}
