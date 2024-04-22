@extends('layout.employe')
@section('content')
<div class="d-md-flex mb-3 align-items-center justify-content-between">
    <h3 class="box-title mb-0">Product</h3>
</div>

<div class="table-responsive">
    <table class="table no-wrap">
        <thead>
            <tr>
                <th class="border-top-0">#</th>
                <th class="border-top-0">Image</th>
                <th class="border-top-0">Name Product</th>
                <th class="border-top-0">Price</th>
                <th class="border-top-0">Stok</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp

            @foreach ($products as $product)
            <tr>
                <td>{{$no++}}</td>
                <td>
                    <img src="{{asset ('assets/data_foto/' .$product->image)}}" width="120" >
                </td>
                <td>{{$product['name']}}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.')}}</td>
                <td>{{$product['stok']}}</td>
            </div>
                </td>
                
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
@endsection

