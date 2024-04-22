<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 300px;
            margin: 0 auto;
            border: 2px solid #000;
            padding: 10px;
            background-color: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: none;
            padding: 5px 0;
        }
        th {
            text-align: left;
            background-color: #eeee ; /* Warna abu-abu untuk header */
        }
        .subtotal {
            text-align: right;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Struk Penjualan</h2>
    </div>
    @foreach($data as $item)
    <table>
        <tr>
            <th>Tanggal:</th>
            <td>{{ \Carbon\Carbon::parse($item['penjualan']->created_at)->setTimezone('Asia/Jakarta')->format('j F, Y H:i:s')}}</td> 
        </tr>
        <tr>
            <th>Pelanggan:</th>
            <td>{{ $item['pelanggan']->name }}</td>
        </tr>
        <tr>
            <th>Di Buat Oleh:</th>
            <td>{{ $item['created_by_username']->name }}</td>
        </tr>
        <tr>
            <th>Alamat:</th>
            <td>{{ $item['pelanggan']->address }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon:</th>
            <td>{{ $item['pelanggan']->no_hp }}</td>
        </tr>
    </table>
    @endforeach
    <table>
        <tr>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th class="subtotal">Subtotal</th>
        </tr>
        @foreach ($item['detail_sales'] as $detail)
        <tr>
            <td>{{ $detail->product->name }}</td>
            <td>{{ $detail->amount }}</td>
            <td class="subtotal">RP.{{ $detail->sub_total }}</td>
        </tr>
        @endforeach
    </table>
    <div class="footer">
    @foreach ($penjualan as $detail)
        <p class="total">Total Harga: RP.{{ $detail->total_price }}</p>
        <p class="bayar">Bayar : RP.{{ $detail->bayar }}</p>
        <p class="kembalian">Kembalian: RP.{{ $detail->kembalian }}</p>
    @endforeach
    <p>Terima kasih telah berbelanja di toko kami!</p>
</div>
</div>
</body>
</html>
