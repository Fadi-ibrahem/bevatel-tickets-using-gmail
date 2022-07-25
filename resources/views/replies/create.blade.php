@extends('layouts.main')

@section('title')
    {{"Replies"}}
@endsection

@section('content')

        <h3 class="mb-3">Create New Reply For Ticket ID {{$ticketID}} </h3>

        @include('layouts.partials._messages')

        <form action="{{route('replies.store')}}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="content" class="form-label">Content</label>
                <input type="text" id="content" name="content" class="form-control"/>
            </div>

            <input type="hidden" name="ticket_id" value="{{$ticketID}}">

            <button type="submit" class="btn btn-primary">Reply</button>
            <a href="{{URL::previous()}}" class="btn btn-secondary">Go Back</a>
        </form>
@endsection
