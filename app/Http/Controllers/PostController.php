<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{   
    
    public function index(){
        
        $posts = Post::orderBy('id')->paginate();
        
        
        return view('admin/posts/index',compact('posts'));
        
    }
    
    public function create(){
        return view('admin/posts/create');
    }

    public function store(storeUpdatePost $request){
        //$request->file('image'); é um jeito de pegar a imagem
        $data = $request->all();

        if($request->image->isValid()){

            $nameFile = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();
            //estou definindo o nome padrão para arquivos e sua extensão 

            $image = $request->image->store('posts','public',$nameFile);
            //fazendo o upload
            $data['image'] = $image;
            //colocando no request
        }
        $post = Post::create($data);
        
        return redirect()->route('posts.index');
    }

    public function show($id){
        $post = Post::find($id);
        if(!$post){
            return redirect()->route('posts.index');
        }
        return view('admin.posts.show',compact('post'));
    }
    public function edit($id){
        if(!$post= Post::find($id)){
            return redirect()->back();
        }
        return view('admin.posts.edit',compact('post'));
    }

    public function update(storeUpdatePost $request,$id){
        if(!$post= Post::find($id)){
            return redirect()->back();
        }

        $data = $request->all();

        if($request->image && $request->image->isValid()){
            if(Storage::exists($post->image)){
                Storage::delete($post->image);
            }
            

            $nameFile = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();
            //estou definindo o nome padrão para arquivos e sua extensão 

            $image = $request->image->storeAs('posts',$nameFile);
            //fazendo o upload
            $data['image'] = $image;
            //colocando no request
        }

        $post->update($data);
        return redirect()->route('posts.index')->with('message','Post edited with sucess');
    }

    public function destroy($id){
        if(!$post = Post::find($id)){
            return redirect()->route('posts.index');
        }

        if(Storage::exists($post->image)){
            Storage::delete($post->image);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('message','Deleted with sucess');
    }
    public function search(Request $request){
        $filters = $request->except('_token');
        //vai pegar todos os dados menos o token


        $posts = Post::where('title','=',"{$request->search}")
            ->orWhere('content','LIKE',"%{$request->search}%")
            ->paginate();
        return view('admin.posts.index',compact('posts','filters'));
        //estou passando os posts e o que foi colocado na filtragem
    }
}
