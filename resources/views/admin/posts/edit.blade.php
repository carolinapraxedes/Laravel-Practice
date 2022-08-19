@extends('admin.templates.app')

@section('content')
    <h1>Edit post - <strong>{{$post->title}}</strong></h1>
    <form action="{{route('posts.update',$post->id)}}" method="post" enctype="multipart/form-data">

        @method('put')
        @include('admin.posts._partials.form')
        <button><a href="{{route('posts.index')}}">Home</a></button>
    </form>
    
@endsection