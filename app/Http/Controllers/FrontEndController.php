<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
	public function index(){
		return view('public.index');
	}
	public function getBlogPosts(){
		return response()->json([
			'posts'=>Post::with('user','category')->orderBy('id','desc')->get(),
		], 200);
	}
	public function getIndividualPost($id){
		return response()->json([
			'post'=>Post::with('user','category')->find($id),
		], 200);
	}
	public function getAllCategories(){
		return response()->json([
			'categories'=>Category::get(),
		], 200);
	}
	public function getLatestPosts(){
		return response()->json([
			'posts'=>Post::with('user','category')->orderBy('id','desc')->limit(3)->get(),
		], 200);
	}
	public function getPostsByCategory($category_id){
		return response()->json([
			'posts'=>Post::with('user','category')->orderBy('id','desc')->where('category_id',$category_id)->get(),
		], 200);
	}

	public function searchPosts(){
		$keyword = \Request::get('s');
		$posts = Post::with('user','category')->orderBy('id','desc')
				->where('title','like', '%'.$keyword.'%')
				->orWhere('description','like', '%'.$keyword.'%')
				->orWhereHas('user', function ($query) use ($keyword){
			        $query->where('name', 'like', '%'.$keyword.'%');
			    })
			    ->orWhereHas('category', function ($query) use ($keyword){
			        $query->where('name', 'like', '%'.$keyword.'%');
			    })
				->get();
		return response()->json([
			'posts'=> $posts,
		], 200);
	}
}
