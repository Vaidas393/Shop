@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <!-- <div class="col-sm-6">
          <h1>Sections</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Forms</li>
          </ol>
        </div> -->
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          @if(Session::has('success_message'))
          <div class="alert alert-success fade show" role="alert">
            {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Products</h3>
              <a href="{{ url('admin/add-edit-product') }}" class="btn btn-block btn-success productBtn">Add Product</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="products" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Product Brand</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Category</th>
                  <th>Section</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                <tr>
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->brand }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->code }}</td>
                  <td>{{ $product->category->category_name }}</td>
                  <td>{{ $product->section->name }}</td>
                  <td>@if($product->status==1)
                    <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)">Active</a>
                  @else
                  <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)">Inactive</a>
                  @endif
                  </td>
                  <td>
                    <a href="{{ url('admin/add-edit-product/'.$product->id) }}">Edit</a>
                    &nbsp;
                    <!-- <a class="confirmDelete" record="product" recordid="{{ $product->id }}" <?php /*href="{{ url('admin/delete-product/'.$product->id) }}" */?> >Delete</a> -->
                    <a href="javascript:void(0)" class="confirmDelete" record="product" recordid="{{ $product->id }}" <?php /*href="{{ url('admin/delete-category/'.$category->id) }}" */?> >Delete</a>

                </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


@endsection
<script type="text/javascript">
$(".alert-success").fadeOut(500);
</script>
