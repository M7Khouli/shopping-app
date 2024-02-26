<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $req){

        $products = Product::where('user_id',$req->user()->id)->get();

        return ProductResource::collection($products);
    }

    public function store(ProductRequest $req){

        Product::create(array_merge($req->validated(), ['user_id' => $req->user()->id]));
        return response()->json(['message'=>'product successfully added']);
    }

    public function show(Request $req){

        $product = Product::where([['id',$req->id],['user_id',$req->user()->id]])->first();

        if(!$product)
        return response()->json(['message'=>'no product with this id !'],422);

        return new ProductResource($product);
    }

    public function update(ProductRequest $req){

        Product::where([['id',$req->id],['user_id',$req->user()->id]])->update($req->validated());

        return response()->json(['message'=>'product successfully updated']);
    }

    public function destroy(Request $req){

        Product::where([['id',$req->id],['user_id',$req->user()->id]])->delete();

        return response()->json(['message'=>'product deleted successfully']);
    }

    public function getImage(Request $req){

        $product = Product::where('id',$req->id)->first();

        if(!$product)
        return response()->json(['message'=>'no image with this id !'],422);

        return Storage::response($product->photo_dir);
    }

}
