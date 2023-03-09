@extends('layout.default')

<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<style media="screen">
#loading {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.5);
  text-align: center;
  padding-top: 200px;
  z-index: 999;
}

</style>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4>Tabel Users</h4>
        <div class="float-right">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>&nbsp  Add Users</a>
        </div>
      </div>
      <div class="card-body">
        <div id="loading" style="display: none;">
            Loading...
      </div>
        <div class="table-responsive">
          <div class="table-data">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Email</th>
              <th style="width: 200px;">Action</th>
            </tr>
          </thead>
          <tbody id="user-list">

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


  </div>
</div>
@include('products.details_product_modal')
@include('products.update_product_modal')
@include('products.add_product_modal')
@include('users.users_js')
@endsection
