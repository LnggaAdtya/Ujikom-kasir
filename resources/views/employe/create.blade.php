@extends('layout.employe')
@section('content')
<style>
    .product-container {
        display: flex;
        flex-wrap: wrap; /* Kartu produk akan turun ke bawah setelah tiga data */
        justify-content: space-between; /* Jarak antara kartu produk */
    }

    .product-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    flex-basis: 250px; /* Tetapkan ukuran basis kartu produk */
    margin-bottom: 20px; /* Jarak antara kartu produk */
    margin-right: 10px; /* Jarak antara kartu produk */
    margin-left: 10px; /* Jarak antara kartu produk */
}

    .product-image {
        width: 100%;
        height: 150px; /* Perbesar ukuran gambar produk */
        display: block;
        object-fit: cover;
    }

    .product-details {
        padding: 10px;
        text-align: center;
    }

    .product-title {
        font-size: 16px; /* Perbesar ukuran judul produk */
        margin-bottom: 5px;
    }

    .product-price {
        font-size: 14px; /* Perbesar ukuran harga produk */
        margin-bottom: 5px;
    }

    .product-stock {
        font-size: 12px; /* Perbesar ukuran stok produk */
        color: #666;
    }

    .quantity-input {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
    }

    .quantity-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        width: 25px;
        height: 25px;
        font-size: 14px;
        cursor: pointer;
    }

    .quantity-value {
        margin: 0 5px;
        font-size: 14px;
        width: 30px;
        text-align: center;
    }

    /* Adjusted button style */
    .submit-button {
        margin-top: 20px; /* Beri jarak antara form dan tombol pesan */
        margin-bottom: 20px; /* Beri jarak antara form dan tombol pesan */
        text-align: center; /* Pusatkan tombol pesan */
    }

    .submit-button button {
        width: 150px; /* Perbesar lebar tombol pesan */
        font-size: 16px; /* Perbesar ukuran teks tombol pesan */
    }

</style>

<div class="d-md-flex mb-3 align-items-center justify-content-between">
    <a type="submit" class="btn btn-primary" href="/sale" style="text-decoration: none; color: inherit; margin-left: auto;">Back</a>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal form-material" action="{{ route('chekoutStore') }}" method="post">
                @csrf

                <!-- Input data pelanggan -->
                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Nama Pelanggan</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input name="name" type="username" class="form-control p-0 border-0" required>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Alamat</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input name="address" type="text" class="form-control p-0 border-0" required>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Nomor</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input name="no_hp" type="number" class="form-control p-0 border-0" required>
                    </div>
                </div>

                <!-- Daftar produk -->
                <div class="product-container">
                    @foreach ($products as $key => $product)
                        <div class="product-card">
                            <img src="{{ asset('assets/data_foto/' . $product->image) }}" alt="Product Image" class="product-image">
                            <div class="product-details">
                                <h3 class="product-title">{{ $product->name }}</h3>
                                <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                                <input type="hidden" name="price[]" value="{{ $product->price }}">
                                <p class="product-price">Price: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="product-stock">Stok: {{ $product->stok }}</p>
                                <h5 class="product-subtotal">Subtotal: Rp 0</h5>
                                <div class="quantity-input">
                                    <button type="button" class="quantity-btn minus-btn" onclick="decreaseQuantity(this)">-</button>
                                    <input type="text" class="quantity-value" name="amount[]" value="0">
                                    <button type="button" class="quantity-btn plus-btn" onclick="increaseQuantity(this)">+</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <h3 class="box-title mb-0">
                    <div id="total-price">Total: Rp </div>
                </h3>
                <br>
                <!-- Input pembayaran dan kembalian -->
                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Bayar</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input name="bayar" id="bayar" type="number" class="form-control p-0 border-0" required>
                    </div>
                </div>
                <div id="kembalian">Kembalian: Rp 0</div>

                <!-- Tombol submit -->
                <div class="form-group mb-4 submit-button">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Pesan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk mengupdate subtotal dan total harga
    function updateSubtotal() {
        var products = document.querySelectorAll('.product-card');
        var totalPrice = 0;
        products.forEach(function (product) {
            var amountInput = product.querySelector('.quantity-value');
            var price = parseFloat(product.querySelector('.product-price').innerText.replace('Price: Rp ', '').replace('.', '').replace(',', '.'));
            var amount = parseInt(amountInput.value);
            var subtotal = price * amount;
            product.querySelector('.product-subtotal').innerText = 'Subtotal: Rp ' + subtotal.toLocaleString('id-ID');
            totalPrice += subtotal;
        });
        document.getElementById('total-price').innerText = 'Total: Rp ' + totalPrice.toLocaleString('id-ID');
    }

    // Fungsi untuk mengurangi jumlah produk
    function decreaseQuantity(button) {
        var input = button.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 0) {
            input.value = value - 1;
            updateSubtotal();
        }
    }

    // Fungsi untuk menambah jumlah produk
    function increaseQuantity(button) {
        var input = button.previousElementSibling;
        var value = parseInt(input.value, 10);
        input.value = value + 1;
        updateSubtotal();
    }

    // Fungsi untuk menghitung kembalian
    function calculateChange() {
        var total = parseFloat(document.getElementById('total-price').innerText.replace('Total: Rp ', '').replace('.', '').replace(',', '.'));
        var bayar = parseFloat(document.getElementById('bayar').value);
        var kembalian = bayar - total;
        document.getElementById('kembalian').innerText = 'Kembalian: Rp ' + kembalian.toLocaleString('id-ID');
    }

    // Event listener untuk input pembayaran
    document.getElementById('bayar').addEventListener('input', function () {
        calculateChange();
    });

</script>

@endsection
