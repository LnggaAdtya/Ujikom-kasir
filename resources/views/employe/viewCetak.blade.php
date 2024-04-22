<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        .card {
            border: 2px solid #000;
            background-color: #fff;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 10px 15px;
            font-weight: bold;
        }
        .card-body {
            padding: 15px;
        }
        .table {
            margin-bottom: 0;
        }
        .total-price {
            font-weight: bold;
            text-align: right;
        }
        .thead-gray {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    @if(Auth::user()->role == 'admin')
        <a href="{{ route('saleAdmin') }}" class="btn btn-secondary">Kembali</a>
    @elseif(Auth::user()->role == 'employe')
        <a href="{{ route('sale') }}" class="btn btn-secondary">Kembali</a>
    @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Struk pembelian</h5>
                    <!-- Tombol Kembali dengan Logika -->
                </div>
                <div class="card-body">
                    @if(!empty($cetak))
                    <p class="mb-0"><strong>Pelanggan:</strong> {{ $cetak->customer->name }}</p>
                    <p class="mb-0"><strong>Alamat:</strong> {{ $cetak->customer->address }}</p>
                    <p class="mb-0"><strong>Nomor Telepon:</strong> {{ $cetak->customer->no_hp }}</p>
                    <p class=" mb-2"><strong>Oleh:</strong> {{ $cetak->user->name }}</p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-gray">
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th class="subtotal">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cetak->detail_sales as $detail)
                                <tr>
                                    <td>{{ $detail->product->name }}</td>
                                    <td>{{ $detail->amount }}</td>
                                    <td class="subtotal"> Rp {{ number_format($detail->sub_total, 0, ',', '.')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="total-price">Total Harga:</th>
                                    <td class="total-price"> Rp {{ number_format($cetak->total_price, 0, ',', '.')}}</td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="total-price">Bayar:</th>
                                    <td class="total-price"> Rp {{ number_format($cetak->bayar, 0, ',', '.')}}</td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="total-price">Kembalian:</th>
                                    <td class="total-price"> Rp {{ number_format($cetak->kembalian, 0, ',', '.')}}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- <p class="text-center"><strong>Bayar:</strong> Rp {{ number_format($cetak->bayar, 0, ',', '.')}}</p> -->
                        <!-- <p class="text-center"><strong>Kembalian:</strong> Rp {{ number_format($cetak->kembalian, 0, ',', '.')}}</p> -->
                    </div>
                    <p class="text-center mb-0"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($cetak->created_at)->setTimezone('Asia/Jakarta')->format('j F, Y H:i:s')}}</p>
                    
                    @else
                    <p class="text-center">Tidak ada data penjualan yang ditemukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
