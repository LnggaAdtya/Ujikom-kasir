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
        return view('admin.index', compact('products'));
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
            'stok'=> 'required',
            'image'=> 'required',
        ]);

        $path = public_path('/data_foto');
        $image = $request->file('image');
        $imgName = rand() . '.' .$image->extension();
        $image->move($path, $image);

        Product::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'stok'=> $request->stok,
            'image'=> $imgName,
        ]);

        return redirect()->route('index')->with(['Success'=> 'Success add new data']);
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
    public function edit($id)
    {
        $data = Product::where('id', '=', $id)->first();
        return view('admin.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'price'=> 'required',
            'image'=> 'required|image|mimes:jpg,jpeg,png,svg',
        ]);


        if (is_null($request->file('image'))) {
            $imgName = Product::where('id', $id)->value('image');
        } else {
            $path = public_path('assets/data_foto/');
            $image = $request->file('image');
            $imgName = rand() . '.' .$image->extension();
            $image->move($path, $image);
        }

        Product::where('id', '=', $id)->update ([
            'name' => $request->name,
            'price'=> $request->price,
            'image'=> $imgName,
        ]);

        return redirect()->route('index')->with(['Success' => 'Updated Success']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = Product::findOrFail($id);
        $images =  public_path('assets/data_foto/'.$data->image);
        unlink($images);
        $data->delete();
        
        return redirect()->route('index')->with('success', 'Data deleted');
    }
}
