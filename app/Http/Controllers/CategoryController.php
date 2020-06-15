<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function store(Request $request){

		$this->validate($request,[
			'name'=>'required|min:2|max:20',
		]);
		$category = new Category();
		$category->name = $request->name;
		$category->save();

		if($category){
			return ['message'=>'ok'];
		}
		
	}

	public function getCategory(){

		$categories = Category::all();
		return response()->json([
			'categories'=>$categories,
		], 200);
	
	}

	public function deleteCategory($id){

		$category = Category::find($id);
		$category->delete();

	}

	public function edit($id){

		$category = Category::find($id);
		return response()->json([
			'category'=>$category,
		]);
		
	}

	public function update(Request $request, $id){

		$this->validate($request,[
			'name'=>'required|min:2|max:20',
		]);
		$category = Category::find($id);
		$category->name = $request->name;
		$category->save();
		
	}
}
