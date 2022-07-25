@extends('layouts.main')

@section('title')
    {{"Tickets"}}
@endsection

@section('content')

    <div class="table-responsive">
        <a class="btn btn-primary mb-3" href="{{url('tickets/create')}}">Add New Ticket</a>
        @include('layouts.partials._messages')
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Time Ago</th>
                    <th scope="col">Add Reply</th>
                    <th scope="col">Show All Related Replies</th>
                    <th scope="col">Actions</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Content</th>
                </tr>
                </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$ticket->email}}</td>
                    <td>{{$ticket->subject}}</td>
                    <td>{{$ticket->created_at->diffForHumans()}}</td>
                    <td>
                        <a href="{{route('replies.create', ['ticket_id' => $ticket->id])}}" class="btn btn-primary">Add</a>
                    </td>
                    <td>
                        <a href="{{route('ticket.replies', ['ticket' => $ticket->id])}}" class="btn btn-success">Replies</a>
                    </td>
                    <td>
                        <a href="{{route('tickets.edit', $ticket->id)}}" class="btn btn-info">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('tickets.destroy', $ticket->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{route('tickets.show', $ticket->id)}}" class="btn btn-secondary">Show</a>
                    </td>
                    <td>{{$ticket->content}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
@endsection
