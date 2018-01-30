@extends('layouts.app')

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">
			Create New Channel
		</div>
		<div class="panel-body">
			<form action="{{ route('channels.store') }}" method="post">
				{{  csrf_field() }}
				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
					<label class="title">Title</label>
					<input type="text" name="title" id="title" value="" placeholder="Title" class="form-control">
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
