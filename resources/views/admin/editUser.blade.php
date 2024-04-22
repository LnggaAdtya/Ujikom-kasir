@extends('layout.main')
@section('content')

<div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal form-material" action="{{route ('updateUser', $dataUser->id)}}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Email</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input name="email" type="email" placeholder="Nama" class="form-control p-0 border-0" required value='{{$dataUser->email}}'> </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Nama</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input name="name" type="text" placeholder="Nama" class="form-control p-0 border-0" required value='{{$dataUser->name}}'> </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Role</label>
                        <div class="col-md-12 border-bottom p-0">
                            <select name="role" class="form-control" required value='{{$dataUser->role}}'>
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
@endsection