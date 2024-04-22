@extends('layout.main')
@section('content')



<div class="d-md-flex mb-3 align-items-center justify-content-between">
    <a href="{{ route('export.excel') }}" class="btn btn-success">Export penjualan (.xlsx)</a>
</div>
<div class="table-responsive">
    <table class="table no-wrap">
        <thead>
            <tr>
                <th class="border-top-0">#</th>
                <th class="border-top-0">Nama pelanggan</th>
                <th class="border-top-0">Tanggal penjualan</th>
                <th class="border-top-0">Total harga</th>
                <th class="border-top-0">Dibuat oleh</th>
                <th class="border-top-0"></th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($customers as $customer)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $customer->name }}</td>

                @foreach ($customer->sales as $sale)
                <td>{{ $sale->sale_date }}</td>
                <td>{{ $sale->total_price }}</td>
                <td>{{ $sale->user->name }}</td>
                <td>
                    <a href="{{ route('viewCetak', $customer->id) }}" class="btn btn-warning"
                        style="text-decoration: none; margin-right: 10px;"><span>Lihat</span></a>
                    <a href="{{ route('export.pdf', $customer->id) }}" class="btn btn-success"
                        style="text-decoration: none; margin-right: 10px;"><span>Export PDF</span></a>
                </td>
                @endforeach

            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
