<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class productController extends Controller
{
    public function index(){

        return view ('products.index', ['products' => Product::get()]); //Fetches the products
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){

        //form data validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        //upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('/products'),$imageName);
        // dd($imageName);
        $product = new Product;
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return back()->withSuccess('Product Created!');
    }

    public function edit($id){
        $product = Product::where('id', $id)->first();
        return view('products.edit', ['product' => $product]);
    }

    public function  update(Request $request, $id) {

        //form data validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $product = Product::where('id', $id)->first();
        if(isset($request->image)){
            //upload image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('/products'),$imageName);
            $product->image = $imageName;
        }

        // dd($imageName);

        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return back()->withSuccess('Product Updated!');
    }

    public function destroy($id){
        $product = Product::where('id', $id)->first();
        $product->delete();
        return back()->withSuccess('Product deleted!');
    }
}
