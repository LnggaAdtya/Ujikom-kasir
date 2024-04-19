<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('admin.product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=> 'required',
            'stok' =>'required',
            'image'=> 'required',
        ]);

        $path = (public_path('assets/data_foto/'));
        $image =($request->file('image'));
        $imgName = (rand() . '.'.$image->extension());
        $image->move($path, $image);

        $product = Product::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'stok'=> $request->stok,
            'image'=> $image,
        ]);

        return redirect()->route('admin.product')->with(['Success'=> 'Success add new data']);
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //
    }
}
