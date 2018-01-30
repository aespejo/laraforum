@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Create New Discussion</div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('discussions.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{old('title')}}" placeholder="Title" class="form-control">
                    @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('channel_id') ? 'has-error' : '' }}">
                    <label for="Channels">Select channels</label>
                    <select name="channel_id" id="channel_id" class="form-control">
                        @if( $channels->count() )
                            @foreach( $channels as $channel )
                                <option value="{{ $channel->id }}"> {{ $channel->title }} </option>
                            @endforeach
                        @endif
                    </select>
                    @if($errors->has('channel_id'))
                        <span class="help-block">{{ $errors->first('channel_id') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                    <label for="content">Ask Question</label>
                    <textarea name="content" id="content" cols="30" rows="5" class="form-control" placeholder="Question">{{old('content')}}</textarea>
                    @if($errors->has('content'))
                        <span class="help-block">{{ $errors->first('content') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection
