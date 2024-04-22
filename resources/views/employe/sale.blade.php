@extends('layout.employe')
@section('content')
<div class="d-md-flex mb-3 align-items-center justify-content-between">
     <a href="{{ route('export.excel') }}" class="btn btn-success">Export penjualan (.xlsx)</a>
    <a type="submit" class="btn btn-primary" href="{{route ('saleCreate')}}"
        style="text-decoration: none; color: inherit;">Tambah Penjualan</a>
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
            @foreach ($sales as $customer)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $customer->customer->name }}</td>
                <!-- Tambahkan kolom lainnya untuk informasi pelanggan -->

                <td>{{ \Carbon\Carbon::parse($customer->created_at)->setTimezone('Asia/Jakarta')->format('j F, Y H:i:s')}}</td>
                <td>Rp {{ number_format($customer->total_price, 0, ',', '.')}}</td>
                <td>{{ $customer->user->name }}</td>
                <!-- Tambahkan kolom lainnya untuk informasi penjualan -->
                <td>
                <div class="btn-group">
                    <a href="{{ route('export.pdf', $customer->id) }}" class="btn btn-success" style="text-decoration: none; margin-right: 10px;">
                    <span>Export PDF</span>
                </a>
                    <a href="{{ route('viewCetak', $customer->id) }}" class="btn btn-success" style="text-decoration: none; margin-right: 10px;">
                    <span>Lihat</span>
                </a>
                <form action="{{ route('saleDelete', $customer->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="text-decoration: none; margin-right: 10px;">Delete</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
