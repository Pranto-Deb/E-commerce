<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;
use File;
use Image;


class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
    	$categories = Category::orderBy('id', 'desc')->get();
    	return view('backend.pages.categories.index')->with('categories', $categories);
    }

    public function create(){
    	$main_categories = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
    	return view('backend.pages.categories.create')->with('main_categories', $main_categories);
    }

    public function store(Request $request){
    	
    	$request->validate([
    		'name' => 'required',
    		'image' => 'nullable|image',
		],

		[
			'name.required' => 'Enter a valid name',
			'image.image'=> 'Please provide a valid image with .jpg, .png, .gif, .jpeg extension',
		]);

    	$category = new Category();

    	$category->name = $request->name;
    	$category->description = $request->description;
    	$category->parent_id = $request->parent_id;

    	if ($request->image > 0){
    		$image = $request->file('image');
    		$img = time().'.'.$image->getClientOriginalExtension();
    	 	$location = public_path('images/categories/'.$img);
    		Image::make($image)->save($location);
    	 	$category->image = $img;    		
    	}

    	$category->save();

    	session()->flash('success', 'A new category has added successfully !!');
    	return redirect()->route('admin.categories');
    }

    public function edit($id){
    	$main_categories = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
    	$category = Category::find($id);
    	if(!is_null($category)){
    		return view('backend.pages.categories.edit', compact('category', 'main_categories'));
    	}
    	else{
    		return redirect()->route('admin.categories');
    	}
    } 

    public function update(Request $request, $id){
    	
    	$request->validate([
    		'name' => 'required',
    		'image' => 'nullable|image',
		],

		[
			'name.required' => 'Enter a valid name',
			'image.image'=> 'Please provide a valid image with .jpg, .png, .gif, .jpeg extension',
		]);

    	$category = Category::find($id);

    	$category->name = $request->name;
    	$category->description = $request->description;
    	$category->parent_id = $request->parent_id;

    	//Category image existing new image
    	if (!empty($request->image)){

    		if(File::exists('images/categories/'.$category->image)){
    			File::delete('images/categories/'.$category->image);
    		}

    		$image = $request->file('image');
    		$img = time().'.'.$image->getClientOriginalExtension();
    	 	$location = public_path('images/categories/'.$img);
    		Image::make($image)->save($location);
    	 	$category->image = $img;    		
    	}

    	$category->save();

    	session()->flash('success', 'Category has updated successfully !!');
    	return redirect()->route('admin.categories');
    }

    public function delete($id){

    	$category = Category::find($id);

    	if(!is_null($category)){
    		//if it is parent category, it is deleted all sub category
    		if ($category->parent_id == NULL) {
    			//Deleted all sub category
    			$sub_categories = Category::orderBy('name', 'desc')->where('parent_id', $category->id)->get();

    			foreach ($sub_categories as $sub){
    				//delete sub category images
    				if(File::exists('images/categories/'.$sub->image)){
    				File::delete('images/categories/'.$sub->image);
    				}
    				$sub->delete();
    			}
    		}
    		//delete category image
    		if(File::exists('images/categories/'.$category->image)){
    			File::delete('images/categories/'.$category->image);
    		}

    		$category->delete();
    	}

    	session()->flash('success', 'Category has deleted successfully !!');
    	return redirect()->back();
    }

}
