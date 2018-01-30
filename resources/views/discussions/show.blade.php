@extends('layouts.app')

@section('content')
    

    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{ $discussion->user->avatar }}" alt="{{ $discussion->user->name }}" width="40px" height="40px">
            &nbsp
            <span>{{ $discussion->user->name }}  {{ $discussion->created_at->diffForHumans() }}</span>
             @if($discussion->user_id == Auth::id() && !$discussion->has_best_answer())
                <a href="{{ route('discussion.edit',['slug' => $discussion->slug]) }}" class="btn btn-warning btn-xs pull-right" style="margin-left: 5px">edit</a>
            @endif
            @if($discussion->is_being_watch_by_auth_user())
                <a href="{{ route('watch.unwatch',['id' => $discussion->id]) }}" class="btn btn-default btn-xs pull-right">unwatch</a>
            @else
                <a href="{{ route('watch.watch',['id' => $discussion->id]) }}" class="btn btn-default btn-xs pull-right">watch</a>
            @endif
        </div>
        
        <div class="panel-body">
            <h4><b>{{ $discussion->title }}</b></h4>   
            {!! Markdown::convertToHtml($discussion->content) !!}
            <hr/>
            <h3>Comments ({{ $discussion->replies->count()}})</h3>
                <!-- User Comments -->
                @foreach($discussion->replies as $reply)
                    <?php $headerStyle = 'panel-default'; ?>

                    @if($bestAnswer)
                        @if($reply->id == $bestAnswer->id) 
                            <?php $headerStyle = 'panel-success'; ?>
                        @endif
                    @endif

                    
                    <div class="panel {{ $headerStyle }}">
                        <div class="panel-heading">
                            <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }} {{ $reply->id }}" width="40px" height="40px">
                            &nbsp
                            <span>{{ $reply->user->name }}  {{ $reply->created_at->diffForHumans() }}</span>
                            &nbsp;&nbsp;
                            @if(Auth::check())
                                @if($reply->user_id == Auth::user()->id)
                                    <a href="{{ route('reply.delete',['id' => $reply->id]) }}" class="btn btn-danger btn-xs pull-right" style="margin-left: 5px;">Delete</a>
                                @endif

                                @if(Auth::id() == $reply->user_id && !$bestAnswer)
                                    <a href="{{ route('reply.edit',['id' => $reply->id]) }}" class="btn btn-primary btn-xs pull-right" style="margin-left: 5px">edit</a>
                                @endif
                                
                                @if(!$bestAnswer && Auth::user()->id == $discussion->user_id)
                                    <a href="{{ route('reply.mark',['id' => $reply->id]) }}" class="btn btn-info btn-xs pull-right">Mark Best Answer</a>
                                @elseif ($bestAnswer && Auth::user()->id == $discussion->user_id && $bestAnswer->id == $reply->id)
                                    <a href="{{ route('reply.unmark',['id' => $reply->id]) }}" class="btn btn-success btn-xs pull-right">Unmark Best Answer</a>
                                @endif
                            @endif

                            
                        </div>
                        
                        <div class="panel-body">
                            {!! Markdown::convertToHtml($reply->content) !!}
                        </div>
                        <div class="panel-footer">
                            <span>
                                @if($reply->is_like_by_auth_user())
                                    <a href="{{ route('reply.unlike', ['id' => $reply->id ]) }}" class="btn btn-danger btn-xs">Unlike</a>
                                @else
                                    <a href="{{ route('reply.like', ['id' => $reply->id ]) }}" class="btn btn-success btn-xs">Like</a>
                                @endif
                            </sapn> 
                        </div>
                    </div>
                @endforeach
                <!-- End User Comments -->
        </div>
        <!-- <div class="panel-footer">
            <span> -->
                <!-- {{ $discussion->replies->count() }} -->
                @if($discussion->replies->count() > 1)
                    <!-- Replies -->
                @else
                    <!-- Reply -->
                @endif
           <!--  </span> 
        </div> -->
    </div>

    <!-- Reply Text box -->
    <div class="panel panel-default">
        <div class="panel-body">
            @if($discussion->has_best_answer())
                <div class="text-center">
                    <h2>This forum is already closed!</h2>
                </div>
            @elseif(Auth::check())
               
                <form action="{{ route('discussion.reply', ['id' => $discussion->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('reply') ? 'has-error':'' }}">
                        <label for="reply">Leave a reply...</label>
                        <textarea name="reply" id="reply" class="form-control" rows="5" placeholder="Leave a reply"></textarea>
                         @if($errors->has('reply'))
                            <span class="help-block">{{ $errors->first('reply') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default pull-right" type="submit">Reply</button>
                    </div>
                </form>
            @else 
                <div class="text-center">
                    <h2>Sign in to leave a reply..</h2>
                </div>
            @endif
            
        </div>
    </div>
    <!-- End Reply Text box -->
@endsection
