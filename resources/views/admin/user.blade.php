@extends('layout.main')
@section ('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal form-material" action="{{route ('createUser')}}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Email</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input name="email" type="email" placeholder="Nama" class="form-control p-0 border-0" required> </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Nama</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input name="name" type="text" placeholder="Nama" class="form-control p-0 border-0" required> </div>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    @php
                    $no = 1;
                    @endphp

                    @foreach ($users as $user)
                        <tr>
                            <th scope="row"></th>
                            <td>{{$user['email']}}</td>
                            <td>{{$user['name']}}</td>
                            <td>{{$user['role']}}</td>
                            <td>
                                <a href="{{route ('editUser', $user->id)}}" class="btn btn-success  fas fa-edit"></a>
                                <form action="{{route ('deleteUser', $user->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" class="btn btn-danger   fas fa-trash-alt" style="text-decoration: none; margin-right: 10px;"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection