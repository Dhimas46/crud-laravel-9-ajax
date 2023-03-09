@extends('layout.default')

<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4>Tabel Product</h4>
        <div class="float-right">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>&nbsp  Add Products</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <div class="table-data">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="table-posts">
            @foreach($products as $key=> $value)
             <tr id="index_{{ $value->id }}">
                 <td>{{ $key+1}}</td>
                 <td>{{ $value->name }}</td>
                 <td>{{ $value->quantity }}</td>
                 <td>{{ $value->harga }}</td>
                 <td class="text-center">
                     <a href="#" data-toggle="modal" data-target="#updateModal" class="btn btn-success btn-sm">EDIT</a>
                     <a data-id="{{ $value->id }}" class="btn btn-danger btn-sm">DELETE</a>
                 </td>
             </tr>
             @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


  </div>
</div>

@include('products.update_product_modal')
@include('products.add_product_modal')
@include('products.products_js')
@endsection
