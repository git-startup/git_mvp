@extends('emails.master')
@section('content')
    <h4>Dear {{$user->name}},</h4>
    <p style="margin-bottom: 15px;">A new Article has been published in <strong>git script</strong> about {{$article->category->name}}</p>

    <div style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px;">
        <h2>{{$article->heading}}</h2>
        <div>{{substr($article->content, 0, 100)}}...</div>
        <a href="{{route('articles.single', [$article->slug])}}">Read More</a>
    </div><br><br><br>


@endsection
