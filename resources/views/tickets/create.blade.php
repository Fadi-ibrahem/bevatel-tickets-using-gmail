@extends('layouts.main')

@section('title')
    {{"Tickets"}}
@endsection

@section('content')

        <h3 class="mb-3">Create New Ticket</h3>

        @include('layouts.partials._messages')

        <form action="{{url('tickets')}}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control"/>
            </div>

            <div class="form-group mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" id="subject" name="subject" class="form-control"/>
            </div>

            <div class="form-group mb-3">
                <label for="content" class="form-label">Content</label>
                <input type="text" id="content" name="content" class="form-control"/>
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
            <a href="{{URL::previous()}}" class="btn btn-secondary">Go Back</a>
        </form>
@endsection
