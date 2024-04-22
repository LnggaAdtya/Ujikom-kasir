<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\customer;
use App\Models\sales;
use App\Models\detail_sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\saleExport;
use Excel;
use PDF;

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

    public function employeProduct()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('employe.productEmploye', compact('products'));
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
            'image'=> 'required|image|mimes:jpg,jpeg,png',
        ]);

        $path = public_path('assets/data_foto');
        $image = $request->file('image');
        $imgName = rand() . '.' .$image->extension();
        $image->move($path, $imgName);

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
    public function editStok($id)
    {
        $dataStok = Product::where('id', '=', $id)->first();
        return view('admin.updateStok', compact('dataStok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'price'=> 'required',
        ]);


        if (is_null($request->file('image'))) {
            $imgName = Product::where('id', $id)->value('image');
        } else {
            $image = $request->file('image');
            $imgName = rand() . '.' .$image->extension();
            $path = public_path('assets/data_foto/');
            $image->move($path, $imgName);
        }

        Product::where('id', '=', $id)->update ([
            'name' => $request->name,
            'price'=> $request->price,
            'image'=> $imgName,
        ]);

        return redirect()->route('index')->with(['Success' => 'Updated Success']);
    }

    public function updateStok(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required',
        ]);

        Product::where('id', '=', $id)->update ([
            'stok'=> $request->stok,
        ]);

        return redirect()->route('index')->with(['Success' => 'Updated stok Success']);
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
    public function saleAdmin()
{
    $customers = Customer::orderBy('created_at', 'DESC')->get();
    $sales = Sales::orderBy('created_at', 'DESC')->get();
    

    return view('admin.saleAdmin', compact('customers', 'sales'));
}

public function strukVieew($id_pesanan)
{
    $cetak = sales::findOrFail($id_pesanan);
    return view('employe.viewCetak', compact('cetak'));
}

    public function sale()
    {
        // $customers = customer::orderBy('created_at', 'DESC')->get();
        $sales = sales::with('customer', 'user', 'detail_sales')->orderBy('created_at', 'DESC')->get();

        return view('employe.sale', compact('sales'));
    }

    public function saleCreate()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('employe.create', compact('products'));
    }
    public function saleDelete($id)
    {
       //Temukan penjualan yang akan dihapus     
       $penjualan = sales::findOrFail($id);      // Hapus detail penjualan terlebih dahulu    
       $penjualan->detail_sales()->delete();      // Hapus pelanggan terkait     
       $pelanggan = customer::findOrFail($penjualan->customer_id);   
       $pelanggan->delete();      // Hapus penjualan itu sendiri     
       $penjualan->delete();  

        return redirect()->route('sale')->with('success', 'Penjualan dan detailnya berhasil dihapus.');    
       
    }

    

public function storePenjualan(Request $request)
{
    // dd($request->all());
    $request->validate([
        'product_id' => 'required|array',
        'amount' => 'required|array',
        'bayar' => 'required|numeric|min:0', // Validasi pembayaran
    ]);

    $pelanggan = new customer();
    $pelanggan->name = $request->input('name');
    $pelanggan->address = $request->input('address');
    $pelanggan->no_hp = $request->input('no_hp');
    $pelanggan->save();

    $penjualan = new sales();
    $penjualan->sale_date = now();
    $totalHarga = 0;

    foreach ($request->input('product_id') as $key => $productId) {
        $jumlahProduk = $request->input('amount.' . $key);
        if ($jumlahProduk !== null && $jumlahProduk > 0) {
            $produk = product::find($productId);
            $sub_total = $produk->price * $jumlahProduk;
            $totalHarga += $sub_total;
            // Kurangi stok produk yang terjual
            $produk->stok -= $jumlahProduk;
            $produk->save();
        }
    }

    $bayar = $request->input('bayar');
    $kembalian = $bayar - $totalHarga;

    $penjualan->total_price = $totalHarga;
    $penjualan->bayar = $bayar;
    $penjualan->kembalian = $kembalian;
    $penjualan->customer_id = $pelanggan->id;
    $penjualan->user_id = Auth::user()->id;
    $penjualan->save();

    foreach ($request->input('product_id') as $key => $productId) {
        $jumlahProduk = $request->input('amount.' . $key);
        if ($jumlahProduk !== null && $jumlahProduk > 0) {
            $detailPenjualan = new detail_sales();
            $detailPenjualan->sales_id = $penjualan->id;
            $detailPenjualan->product_id = $productId;
            $detailPenjualan->amount = $jumlahProduk;

            $produk = product::find($productId);
            $detailPenjualan->sub_total = $produk->price * $jumlahProduk;

            if ($detailPenjualan->sub_total > 0) {
                $detailPenjualan->save();
            }
        }
    }
    return redirect()->route('viewCetak', ['id_pesanan' =>$penjualan->id])->with('successPenjualan', 'Penjualan berhasil.');
}

public function createExcel()
{
$file_name = 'laporan-pembelian'.'.xlsx';
return Excel::download(new saleExport, $file_name);
}


public function cetakpenjualan($id)
    {
        $penjualan = sales::where('id', $id)->get();
        $data = [];

        foreach ($penjualan as $jual) {
            // Memuat data pelanggan
            $pelanggan = customer::find($jual->customer_id);

            // Memuat pengguna yang membuat penjualan
            $user = $jual->User;

            $detailPenjualan = $jual->detail_sales;

            // Menambahkan data ke dalam array $data
            $data[] = [
                'penjualan' => $jual,
                'pelanggan' => $pelanggan,
                'created_by_username' => $user,
                'detail_sales' => $detailPenjualan,
            ];
        }

        $pdf = PDF::loadView('employe.cetak', compact('data', 'penjualan', 'detailPenjualan'));
        return $pdf->stream('Bukti-Data-Penjualan.pdf');
    }

    // public function strukView($id_pesanan)
    // {
    //     $cetak = sales::findOrFail($id_pesanan);
    //     return view('employe.viewCetak', compact('cetak'));

        
    // }

    public function strukView($id_pesanan)
    {
        $cetak = sales::findOrFail($id_pesanan);
        // Tambahkan logika untuk menentukan view yang sesuai
        if (Auth::user()->role == 'admin') {
            return view('employe.viewCetak', compact('cetak'));
        } else {
            return view('employe.viewCetak', compact('cetak'));
        }
    }
    



}
