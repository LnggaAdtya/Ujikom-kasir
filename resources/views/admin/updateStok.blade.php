@extends('layout.main')
@section('content')
<form action="{{route ('updateStok', $dataStok->id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="form-group">
      <label for="name">Product Name</label>
      <input type="username" class="form-control" id="name" aria-describedby="emailHelp" placeholder="name" name="name" value="{{$dataStok->name}}" selected disabled>
    </div>
    <div class="form-group">
      <label for="stock">Stock</label>
      <input type="number" class="form-control" id="stok" placeholder="stok" value="{{$dataStok->stok}}" name="stok">
    </div>
    <div class="modal-footer">
      <a href="/index" type="button" class="btn btn-secondary" data-dismiss="modal" >Back</a>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
@endsection