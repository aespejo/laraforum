@extends('layouts.app')

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">
			Edit Channel Record
		</div>
		<div class="panel-body">
			<form action="{{ route('channels.update', ['channel' => $channel->id ]) }}" method="post">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
					<label class="title">Title</label>
					<input type="text" name="title" id="title" value="{{ $channel->title }}" placeholder="Title" class="form-control">
					@if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
				</div>
				<div class="form-group">
					<button class="btn btn-success">Save</button>
				</div>
			</form>
		</div>
	</div>

@stop
