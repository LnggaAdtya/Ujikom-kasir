<!-- @extends('layout.employe')
@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <!-- <form class="form-horizontal form-material" action="{{route ('chekout')}}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Nama</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input name="name" type="email"  class="form-control p-0 border-0" required> </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Alamat</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input name="address" type="text" class="form-control p-0 border-0" required> </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Alamat</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input name="no_hp" type="text"  class="form-control p-0 border-0" required> </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Role</label>
                        <div class="col-md-12 border-bottom p-0">
                            <select name="role" class="form-control" required>
                                <option selected hidden disabled>Choose</option>
                                <option value="admin">Admin</option>
                                <option value="employe">Employe</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Password</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input name="password" type="password" palceholder="password" class="form-control p-0 border-0" required>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal form-material" action="{{ route('chekoutStore') }}" method="post">
                    @csrf
                    Input hidden untuk menyimpan product_id 
                    @foreach ($products as $product)
                    <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                    @endforeach

                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Nama Pelanggan</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input name="name" type="username" class="form-control p-0 border-0" required> </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Alamat</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input name="address" type="text" class="form-control p-0 border-0" required> </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Nomor</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input name="no_hp" type="number" class="form-control p-0 border-0" required> </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">Pesan</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
