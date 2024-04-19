@extends('layout.main')
@section('content')
<form action="{{route ('update', $data->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group">
      <label for="name">Product Name</label>
      <input type="username" class="form-control" id="name" aria-describedby="emailHelp" placeholder="name" name="name" value="{{$data->name}}">
    </div>
    <div class="form-group">
      <label for="Price">Price</label>
      <input type="number" class="form-control" id="price" aria-describedby="emailHelp" placeholder="Price" name="price" value="{{$data->price}}">
      
    </div>
    <div class="form-group">
      <label for="image">Image</label>
      <input type="file" class="form-control" id="image" placeholder="image" name="image">
    </div>
    <div class="form-group">
      <label for="stock">Stock</label>
      <input type="number" class="form-control" id="stok" placeholder="stok" value="{{$data->stok}}" name="stok" disabled selected>
    </div>
    <div class="modal-footer">
      <a href="/index" type="button" class="btn btn-secondary" data-dismiss="modal" >Back</a>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
@endsection