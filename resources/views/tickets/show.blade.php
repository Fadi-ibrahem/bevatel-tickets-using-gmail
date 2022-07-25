@extends('layouts.main')

@section('title')
    {{"Tickets"}}
@endsection

@section('content')
        <h3 class="mb-3"> Show Ticket ID {{$ticket->id}} </h3>

        <form>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{$ticket->email}}" disabled readonly/>
            </div>

            <div class="form-group mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" id="subject" name="subject" class="form-control" value="{{$ticket->subject}}" disabled readonly/>
            </div>

            <div class="form-group mb-3">
                <label for="content" class="form-label">Content</label>
                <input type="text" id="content" name="content" class="form-control" value="{{$ticket->content}}" disabled readonly/>
            </div>

            <a href="{{URL::previous()}}" class="btn btn-secondary">Go Back</a>
        </form>
@endsection
