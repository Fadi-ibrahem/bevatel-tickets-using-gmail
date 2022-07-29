@component('mail::message')
# We Have Replied To Your Ticket

<h2>Reply Message</h2>
<p>{{$data['content']}}</p>

{{-- <img src="{{asset('assets/images/bevatel.png')}}" alt="Bevatel Image"> --}}

Thanks,<br>
Bevatel Hiring Task
@endcomponent
