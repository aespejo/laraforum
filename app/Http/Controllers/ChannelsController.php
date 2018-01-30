<?php

namespace App\Http\Controllers;

use Session;

use App\Channel;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('channels.index')->with('channels', Channel::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('channels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required'
        ]);

        $rsSave = Channel::create([
            'title' => $request->title,
            'slug'  => str_slug($request->title)
        ]);

        if($rsSave) {
            Session::flash('success', 'Record Successfully saved!');
        } else {
            Session::flash('error', 'An error occured while saving the data. Please refresh the page!');
        }

        return redirect()->route('channels.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $channel = Channel::findOrFail((int)$id);
        return view('channels.edit')->with('channel', $channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $channel = channel::findOrFail((int)$id);
        $channel->title = $request->title;
        $channel->slug  = str_slug($request->title);

        if($channel->save()) {
            Session::flash('success', 'Record Successfully saved!');
        } else {
            Session::flash('error', 'An error occured while saving the data. Please refresh the page!');
        }

        return redirect()->route('channels.edit', ['channel' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $channel = Channel::findOrFail((int)$id);
        if($channel->delete()) {
            Session::flash('success', 'Record successfully deleted!');
        } else {
            Session::flash('error', 'An error occured while deleting the record. Please refresh the page!');
        }

        return redirect()->route('channels.index');
    }
}
