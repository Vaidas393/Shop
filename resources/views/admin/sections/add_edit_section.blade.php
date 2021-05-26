@extends('layouts.admin_layout.admin_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

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
    <form name="sectionFrom" id="SectionForm" @if(empty($sectiondata['id'])) action="{{ url('admin/add-edit-section')}}" @else action="{{ url('admin/add-edit-section/'.$sectiondata['id']) }}" @endif method="post">@csrf
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
            <div class="col-md-12">
              <div class="form-group">
                  <label for="sectionName">Section Name</label>
                  <input type="text" class="form-control" name="section_name" id="section_name" placeholder="Section name" required @if(!empty($sectiondata['name'])) value="{{ $sectiondata['name'] }}" @else value"{{ old('name') }}" @endif>
              </div>
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
@endsection
<script type="text/javascript">
$(".alert").fadeOut(5000);
</script>
