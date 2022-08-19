@extends('admin.templates.app')

@section('title','List of post')
    


@section('content')
    @if (session('message'))
        <div>{{session('message')}}</div>
    @endif
        <h1>HELLO POSTS</h1>
        <hr>
    <form action="{{route('posts.search')}}" method="post">
        @csrf
        <input type="text" name="search" id="seach" placeholder="Filtrar">
        <button type="submit">Filtrar</button>
    </form>

    @foreach ($posts as $post)
        <p>
            <img src="{{url("storage/".$post->image)}}" width="200px"><br>
            {{ $post->title }} - <a href="{{route('posts.show',$post->id)}}">More details </a> | <a href="{{route('posts.edit',$post->id)}}">Edit</a></p>

    @endforeach

    <button><a href="{{route('posts.create')}}">New post</a></button>


    <hr>
    @if (isset($filters))
        {{$posts->appends($filters)->links()}}    
    @else
        {{$posts->links()}}
    @endif


@endsection