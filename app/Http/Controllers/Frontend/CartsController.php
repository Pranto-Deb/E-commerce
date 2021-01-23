<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Cart;


class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.carts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required'
        ],
        [
            'product_id.required' => 'Please give a product'
        ]);

        if (Auth::check()) {
            $cart = Cart::Where('user_id', Auth::id())
                    ->Where('product_id', $request->product_id)
                    ->Where('order_id', NULL)
                    ->first();
        }
        else{
            $cart = Cart::Where('ip_address', request()->ip())
                    ->Where('product_id', $request->product_id)
                    ->Where('order_id', NULL)
                    ->first();
        }
        if(!is_null($cart)){
            $cart->increment('product_quantity');
        }
        else{
            $cart = new Cart();
            if(Auth::check()){
            $cart->user_id = Auth::id();
            }
            $cart->product_id = $request->product_id;
            $cart->ip_address = request()->ip();
            $cart->save();
        }
        
        session()->flash('success', 'Product has added to cart !!');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        if (!is_null($cart)) {
            $cart->product_quantity = $request->product_quantity;
            $cart->save();
        }
        else{
            return redirect()->route('carts');
        }
        session()->flash('success', 'Cart item has updated successfully !!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        if (!is_null($cart)) {
            $cart->delete();
        }
        else{
            return redirect()->route('carts');
        }
        session()->flash('success', 'Cart item has deleted successfully !!');
        return redirect()->back();
    }
}
