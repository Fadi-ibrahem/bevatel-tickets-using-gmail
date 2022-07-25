@extends('layouts.main')

@section('title')
    {{"Replies"}}
@endsection

@section('content')
        <h3 class="mb-3">Show Reply On Ticket ID {{$ticketID}} </h3>

        <form>

            <div class="form-group mb-3">
                <label for="content" class="form-label">Content</label>
                <input type="text" id="content" name="content" class="form-control" value="{{$reply->content}}" disabled readonly/>
            </div>

            <a href="{{URL::previous()}}" class="btn btn-secondary">Go Back</a>
        </form>
@endsection
