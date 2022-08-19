@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>    
@endif

@csrf
<input type="file" name="image" id="image">
<input type="text" name="title" id="title" value="{{$post->title ?? old('title')}}"><br>
<textarea name="content" id="content" cols="30" rows="4">{{$post->content ?? old('content') }}</textarea><br>
<button type="submit">Submit</button>