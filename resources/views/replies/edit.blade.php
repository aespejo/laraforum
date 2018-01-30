@extends('layouts.app')

@section('content')
    <!-- Reply Text box -->
    <div class="panel panel-default">
        <div class="panel-body">
            @if(Auth::check())
                <form action="{{ route('reply.update', ['id' => $reply->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('reply') ? 'has-error':'' }}">
                        <label for="reply">Edit a reply...</label>
                        <textarea name="reply" id="reply" class="form-control" rows="5" placeholder="Leave a reply">{{ $reply->content }}</textarea>
                        @if($errors->has('reply'))
                            <span class="help-block">{{ $errors->first('reply') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default pull-right" type="submit">Save reply</button>
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