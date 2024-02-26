<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function addToCart(Request $req){

        $cart = $req->validate([
            'product_id'=>'integer|required',
            'quantity'=>'integer|required'
        ]);

        $product = Product::where('id',$cart['product_id'])->first();

        if(!$product){
            return response()->json(['message'=>'please enter a valid product id.'],422);
        }

        $cart['user_id'] = $req->user()->id;
        $cart['price'] = $product->price * $cart['quantity'];

        CartItem::create($cart);

        return response()->json(['message'=>'product successfully added to database'],201);
    }

    public function getCart(Request $req){

        $cart = DB::table('cart_items')
        ->where('cart_items.user_id','=',$req->user()->id)
        ->join('products','cart_items.product_id','=','products.id')
        ->select('products.id','products.name','cart_items.quantity','cart_items.price')
        ->get();

        return response()->json(['data'=>$cart]);
    }

    public function checkout(Request $req){

    }

}
