@extends('layouts.admin_layout.admin_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @if ($errors->any())
      <div id="alert" class="alert alert-primary fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(Session::has('success_message'))
    <div class="alert alert-success fade show" role="alert">
      {{ Session::get('success_message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <form name="productFrom" id="ProForm" @if(empty($productdata['id'])) action="{{ url('admin/add-edit-product')}}" @else action="{{ url('admin/add-edit-product/'.$productdata['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">{{ $title }}</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Select Category</label>
                <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                  <option value="">Select category</option>
                  @foreach($categories as $section)
                    <optgroup label="{{ $section['name'] }}"></optgroup>
                    @foreach($section['categories'] as $category)
                      <option value="{{ $category['id'] }}" @if(!empty(@old('category_id')) && $category['id']==@old('category_id')) selected="" @endif>&nbsp;&nbsp;--&nbsp;{{ $category['category_name'] }}</option>
                      @foreach($category['subcategories'] as $subcategory)
                      <option value="{{ $subcategory['id'] }}" @if(!empty(@old('category_id')) && $subcategory['id']==@old('category_id')) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{ $subcategory['category_name'] }}</option>
                      @endforeach
                    @endforeach
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6 col-6">
              <div class="form-group">
                <label for="productBrand">Product Brand</label>
                <input type="text" class="form-control" name="brand" id="brand" placeholder="Product brand" @if(!empty($productdata['brand'])) value="{{ $productdata['brand'] }}" @else value"{{ old('brand') }}" @endif >
              </div>
            </div>
          </div>
            <div class="row">
            <div class="col-md-6 col-6">
              <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Product name" @if(!empty($productdata['name'])) value="{{ $productdata['name'] }}" @else value"{{ old('name') }}" @endif >
              </div>
            </div>
              <div class="com-md-6 col-6">
              <div class="form-group">
                  <label for="code">Product Code</label>
                  <input type="text" class="form-control" name="code" id="code" placeholder="Product code" @if(!empty($productdata['code'])) value="{{ $productdata['code'] }}" @else value"{{ old('code') }}" @endif >
              </div>
            </div>
          </div>
        <!-- </div> -->
        <div class="row">
            <div class="col-md-6 col-6">
              <div class="form-group">
                <label for="productPrice">Product Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Product price" @if(!empty($productdata['price'])) value="{{ $productdata['price'] }}" @else value"{{ old('price') }}" @endif >
              </div>
            </div>
              <div class="col-md-6 col-6">
              <div class="form-group">
                  <label for="productCode">Product Discount %</label>
                  <input type="text" class="form-control" name="discount" id="code" placeholder="Product discount" @if(!empty($productdata['discount'])) value="{{ $productdata['discount'] }}" @else value"{{ old('discount') }}" @endif >
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-md-6 col-6">
              <div class="form-group">
                  <label for="productCode">Product Weight</label>
                  <input type="text" class="form-control" name="weight" id="code" placeholder="Product weight" @if(!empty($productdata['weight'])) value="{{ $productdata['weight'] }}" @else value"{{ old('weight') }}" @endif >
              </div>
            </div>
            <div class="col-md-6 col-6">

              <div class="form-group">
                <label for="Image">Product Image</label>
                 <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image" id="image">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                    <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                  </div>
                </div>
              </div>
                <!-- @if(!empty($productdata['image']))
                <div class="productImageDiv">
                  <img class="productImg" src="{{ asset('images/images/'.$productdata['image']) }}" alt="">
                  &nbsp;
                  <a class="confirmDelete" href="javascript:void(0)" record="product-image" recordid="{{ $productdata['id'] }}" <?php /*href=" {{ url('admin/delete-product-image/'.$productdata['id']) }}" */?> >Delete Image</a>

                </div>
                  @endif -->
                </div>
            </div>
            <!-- /.col -->
          <!-- /.row -->

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="Video">Product Video</label>
                 <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="video" id="video">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                    <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                    </div>
                </div>
                <!-- @if(!empty($productdata['video']))
                <div class="productImageDiv">
                  <img class="productImg" src="{{ asset('videos/videos/'.$productdata['video']) }}" alt="">
                  &nbsp;
                  <a class="confirmDelete" href="javascript:void(0)" record="product-video" recordid="{{ $productdata['id'] }}" <?php /*href=" {{ url('admin/delete-product-video/'.$productdata['id']) }}" */?> >Delete Video</a>

                </div>
                  @endif -->
                </div>
              </div>
              <div class="col-md-6 col-6">
              <div class="form-group">
                <label for="productDescription">Product Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter ...">@if(!empty($productdata['description'])) {{ $productdata['description'] }} @else {{ old('description') }} @endif</textarea>
              </div>
            </div>
          </div>
            <!-- /.col -->
            <div class="row">
            <div class="col-md-6 col-6">
              <div class="form-group">
                <label for="metaDescription">Meta Description</label>
                <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter ...">@if(!empty($productdata['meta_description'])) {{ $productdata['meta_description'] }} @else {{ old('meta_description') }} @endif</textarea>
              </div>
            </div>
            <div class="col-md-6 col-6">
              <div class="form-group">
                <label for="productDescription">Meta Title</label>
                <textarea class="form-control" name="meta_title" id="meta_title" rows="3" placeholder="Enter ...">@if(!empty($productdata['meta_title'])) {{ $productdata['meta_title'] }} @else {{ old('meta_title') }} @endif</textarea>
              </div>
            </div>
          </div>

            <div class="row">
            <div class="col-md-6 col-6">
              <div class="form-group">
                <label for="metaKeywords">Meta Keywords</label>
                <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter ...">@if(!empty($productdata['meta_keywords'])) {{ $productdata['meta_keywords'] }} @else {{ old('meta_keywords') }} @endif</textarea>
              </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="form-group">
              <label for="Featured">Featured Item</label>
              <input type="checkbox" name="is_featured" id="is_featured" value="Yes">
            </div>
          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>

    </div>
    </div>


  </section>
  <!-- /.content -->
</div>

@endsection
<script type="text/javascript">
$(".alert").fadeOut(5000);
</script>
