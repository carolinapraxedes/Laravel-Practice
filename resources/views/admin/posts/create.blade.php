@extends('admin.templates.app')
@section('title','New post')
    

@section('content')
    <h1>New post</h1>
    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">  
        @include('admin.posts._partials.form')
        <button><a href="{{route('posts.index')}}">Home</a></button>
    </form>
    
@endsection