<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Pos;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Pos::findOrFail($id);

        $cart->delete();
    }

    public function showToCart(){

        $carts = Pos::all();
        return response()->json($carts);
    }

    public function addToCart(Request $request, $id){

        $product = Product::where('id', $id)->first();

        $check = DB::table('pos')->where('product_id', $id)->first();

        if($check){
            $quantity = DB::table('pos')->where('product_id',$id)->increment('product_quantity');

            $cart = DB::table('pos')->where('product_id',$id)->first();

            $subtotal = $cart->product_quantity * $cart->product_price;

            DB::table('pos')->where('product_id',$id)->update(['sub_total' => $subtotal]);

            return response('Done');
        }
        else{
            $pos = new Pos();

            $pos->product_id = $product->id;
            $pos->product_name = $product->product_name;
            $pos->product_quantity = 1;
            $pos->product_price = $product->selling_price;
            $pos->sub_total = $product->selling_price;

            $pos->save();
        }
    }

    public function cartIncrement($id){

        $quantity = DB::table('pos')->where('id',$id)->increment('product_quantity');

        $cart = DB::table('pos')->where('id',$id)->first();

        $subtotal = $cart->product_quantity * $cart->product_price;

        DB::table('pos')->where('id',$id)->update(['sub_total' => $subtotal]);

        return response('Done');
    }

    public function cartDecrement($id){
        $quantity = DB::table('pos')->where('id',$id)->decrement('product_quantity');

        $cart = DB::table('pos')->where('id',$id)->first();

        $subtotal = $cart->product_quantity * $cart->product_price;

        DB::table('pos')->where('id',$id)->update(['sub_total' => $subtotal]);

        return response('Done');
    }

    public function tax()
    {
        $taxes = DB::table('extra')->first();

        return response()->json($taxes);
    }
}
