<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;

class ProductsController extends Controller
{
    public function index(){
    	// $categories= Category::orderBy('name', 'asc')
    	// 					   ->where('parent_id', NUll)->get();
    	$products = Product::orderBy('id', 'desc')->paginate(9);
    	return view('frontend.pages.product.index', compact('products'));
    }

    public function show($slug){

    	$product = Product::where('slug', $slug)->first();
    	if (!is_null($product)){
    		return view('frontend.pages.product.show', compact('product'));
    	}
    	else{
    		session()->flash('errors', 'There is no product in this url...!!');
    		return redirect()->route('products');
    	}
    }


}
