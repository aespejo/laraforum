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
                        <button class="btn btn-primary btn-xs pull-right">close</button>
                    @else
                        <button class="btn btn-primary btn-xs pull-right">open</button>
                    @endif
                    <a href="{{ route('discussion',['slug' => $discussion->slug]) }}" class="btn btn-default btn-xs pull-right">view</a>
                </div>

                <div class="panel-body">
                    <h4><b>{{ $discussion->title }}</b></h4>   
                    {{ str_limit($discussion->content,200) }}
                </div>
                <div class="panel-footer">
                    <p>
                        {{ $discussion->replies->count() }}
                        @if($discussion->replies->count() > 1)
                            Replies
                        @else
                            Reply
                        @endif
                    </p> 
                </div>
            </div>
        @endforeach

        <div class="text-center">
            {{ $discussions->links() }}
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
