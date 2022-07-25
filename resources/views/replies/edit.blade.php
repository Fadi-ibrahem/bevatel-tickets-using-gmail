@extends('layouts.main')

@section('title')
    {{"Replies"}}
@endsection

@section('content')
    <h3 class="mb-3">Edit Reply On Ticket ID {{$ticketID}} </h3>

        @include('layouts.partials._messages')

        <form action="{{route('replies.update', $reply->id)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="content" class="form-label">Content</label>
                <input type="text" id="content" name="content" class="form-control" value="{{$reply->content}}"/>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{URL::previous()}}" class="btn btn-secondary">Go Back</a>
        </form>
@endsection
