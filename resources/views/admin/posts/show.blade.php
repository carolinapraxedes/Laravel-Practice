@extends('admin.templates.app')

@section('title','Details post')

@section('content')
    <h1>{{$post->id}} - {{$post->title}} </h1>

    <ul>
        <li>
            Description: {{$post->content}}
        </li>
    </ul>

    <form action="{{route('posts.destroy',$post->id)}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit">Delete post {{$post->id}}</button>
    </form>    
@endsection