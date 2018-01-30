@extends('layouts.app')

@section('content')

    @if($discussions->count())
        @foreach($discussions as $discussion)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="{{ $discussion->user->avatar }}" alt="{{ $discussion->user->name }}" width="40px" height="40px">
                    &nbsp
                    <span>{{ $discussion->user->name }}  {{ $discussion->created_at->diffForHumans() }}</span>
                    @if($discussion->has_best_answer())
                        <button class="btn btn-primary btn-xs pull-right" style="margin-left: 5px">closed</button>
                    @else
                        <button class="btn btn-primary btn-xs pull-right" style="margin-left: 5px">open</button>
                    @endif
                    @if($discussion->user_id == Auth::id() && !$discussion->has_best_answer())
                        <a href="{{ route('discussion.edit',['slug' => $discussion->slug]) }}" class="btn btn-warning btn-xs pull-right" style="margin-left: 5px">edit</a>
                    @endif
                    <a href="{{ route('discussion',['slug' => $discussion->slug]) }}" class="btn btn-default btn-xs pull-right">view</a>
                </div>

                <div class="panel-body">
                    <h4><b>{{ $discussion->title }}</b></h4>   
                    {!! Markdown::convertToHtml(str_limit($discussion->content,200)) !!}
                </div>
                <div class="panel-footer">
                    <span>
                        {{ $discussion->replies->count() }}
                        @if($discussion->replies->count() > 1)
                            Replies
                        @else
                            Reply
                        @endif
                    </span>
                    <a href="{{route('channel',['slug'=>$discussion->channel->slug ])}}" class="btn btn-default btn-xs pull-right">{{$discussion->channel->title}}</a>
                </div>
            </div>
        @endforeach

        <div class="text-center">
            {!! $discussions->appends( Request::query() )->render() !!}
        </div>
    @else
        <div class="panel panel-default">
            <div class="panel-heading">
                Forums
            <div>

            <div class="panel-body">
                No Records Found
            </div>
        </div>
    @endif

@endsection
