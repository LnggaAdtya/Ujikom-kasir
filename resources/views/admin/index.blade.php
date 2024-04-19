@extends('layout.main')
@section('content')
<div class="d-md-flex mb-3 align-items-center justify-content-between">
    <h3 class="box-title mb-0">Dashboard</h3>
    <a type="submit" class="btn btn-primary" href="{{route ('create')}}"
        style="text-decoration: none; color: inherit;">Add product</a>

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
                <th class="border-top-0">Action </th>
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
                    <img src="{{asset ('data_foto/' .$product->image)}}" alt="image">
                </td>
                <td>{{$product['name']}}</td>
                <td>{{$product['price']}}</td>
                <td>{{$product['stok']}}</td>
                <td>
                    <div class="btn-group">
                    <a href="{{route('edit', $product->id)}}" class="btn btn-primary" style="text-decoration: none; margin-right: 10px;">
                    <i class=" fas fa-pencil-alt"></i>
                </a>
                <form action="{{route('delete', $product->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger fas fa-trash-alt" style="text-decoration: none; margin-right: 10px;"></button>
                </form>
            </div>
                </td>
                
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
@endsection