@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Channels</div>
        <div class="panel-body">
            <div >
                <table class="table table-hover">
                @if($channels->count())
                    <thead>
                        <th>Name</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($channels as $channel)
                            <tr>
                                <td>{{ $channel->title }}</td>
                                <td style="display: inline; vertical-align: inherit;">
                                    <a href="{{ route('channels.edit',['channel' => $channel->id] ) }}" class="btn btn-xs btn-primary">Edit</a>
                                    <form action="{{ route('channels.destroy', ['channel' => $channel->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-xs btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>   
                            </tr>   
                        @endforeach;
                    </tbody>
                @else 
                    <h2>No Records Found</h2>
                @endif
                </table>
            </div>
        </div>
    </div>

@endsection
