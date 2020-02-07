@extends('emails.master')
@section('content')
    <h4>Dear {{$user->name}},</h4>
    <p style="margin-bottom: 15px;">A new Event has been published in <strong>social script</strong> Organized By {{$event->organizer}}</p>
 
    <div style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px;">
        <h2>{{$event->organizer}}</h2>
        <div>{{substr($event->description, 0, 100)}}...</div>
        <a href="{{route('events.single', [$event->slug])}}">Read More</a>
    </div><br><br><br> 

    
@endsection
