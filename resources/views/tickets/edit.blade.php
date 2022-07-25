@extends('layouts.main')

@section('title')
    {{"Tickets"}}
@endsection

@section('content')
        <h3> Update Ticket ID {{$ticket->id}} </h3>

        @include('layouts.partials._messages')

        <form action="{{url('tickets/' . $ticket->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{$ticket->email}}"/>
            </div>

            <div class="form-group mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" id="subject" name="subject" class="form-control" value="{{$ticket->subject}}"/>
            </div>

            <div class="form-group mb-3">
                <label for="content" class="form-label">Content</label>
                <input type="text" id="content" name="content" class="form-control" value="{{$ticket->content}}"/>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{URL::previous()}}" class="btn btn-secondary">Go Back</a>
        </form>
@endsection
