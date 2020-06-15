<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request){

        $this->validate($request,[
            'title'=>'required|min:2|max:500',
            'description'=>'required|min:20|max:500000',
            'category_id'=>'required',
        ]);
        
        if($request->image){
            $extention = explode('/',explode(':',explode(';',$request->image)[0])[1])[1];
            $image_name = rand().time().'.'.$extention;
            $upload_path = public_path('images/'.$image_name);
            $image = Image::make($request->image)->save($upload_path);
            
        }

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::id();
        if($request->image){
            $post->image = $image_name;
        }
        
        
        $post->save();


        
    }

    public function getPost(){

        $posts = Post::with('user','category')->get();
        return response()->json([
            'posts'=>$posts,
        ], 200);
    
    }

    public function deletePost($id){

        $post = Post::find($id);
        if($post->image != "" && file_exists(public_path('images/').$post->image)){
            unlink(public_path('images/').$post->image);
        }
        $post->delete();

    }

    public function edit($id){

        $post = Post::find($id);
        return response()->json([
            'post'=>$post,
        ]);
        
    }

    public function update(Request $request, $id){

        $this->validate($request,[
            'title'=>'required|min:2|max:200',
            'description'=>'required|min:20|max:50000',
            'category_id'=>'required',
        ]);

        //return $request->all();

        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::id();
        if(($request->image != '') && $request->image != $post->image){
            if($post->image != "" && file_exists(public_path('images/').$post->image)){
                unlink(public_path('images/').$post->image);
            }
            $extention = explode('/',explode(':',explode(';',$request->image)[0])[1])[1];
            $image_name = rand().time().'.'.$extention;
            $upload_path = public_path('images/'.$image_name);
            $image = Image::make($request->image)->save($upload_path);
            $post->image = $image_name;
        }
        $post->save();
        
    }
}
