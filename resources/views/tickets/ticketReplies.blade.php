@extends('layouts.main')

@section('title')
    {{"Tickets"}}
@endsection

@section('content')
    <h3 class="mb-3"> Replies Of Ticket ID {{$ticketID}} </h3>
    <div class="table-responsive">
        @include('layouts.partials._messages')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Content</th>
                <th scope="col">Related Ticket ID</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$reply->content}}</td>
                    <td>{{$reply->ticket_id}}</td>
                    <td>{{$reply->created_at}}</td>
                    <td>
                        <a href="{{route('replies.edit', ['reply' => $reply->id, 'ticket_id' => $reply->ticket_id])}}" class="btn btn-info">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('replies.destroy', $reply->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{route('replies.show', ['reply' => $reply->id, 'ticket_id' => $reply->ticket_id])}}" class="btn btn-secondary">Show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
