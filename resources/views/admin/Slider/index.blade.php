@extends('layouts.admin')
@section('title')
    Sider
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/index/index.css') }}">
@endsection
@section('content')
<div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
    List  slider
</div>
<div class="row w3-res-tb">
    <div class="col-sm-5 m-b-xs">
    <select class="input-sm form-control w-sm inline v-middle">
        <option value="0">Bulk action</option>
        <option value="1">Delete selected</option>
        <option value="2">Bulk edit</option>
        <option value="3">Export</option>
    </select>
    <button class="btn btn-sm btn-default">Apply</button>                
    </div>
    <div class="col-sm-4">
    </div>
    <div class="col-sm-3">
    <div class="input-group">
        <input type="text" class="input-sm form-control" placeholder="Search">
        <span class="input-group-btn">
        <button class="btn btn-sm btn-default" type="button">Go!</button>
        </span>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSliderModal">Add</button>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped b-t b-light">
    <thead>
        <tr>
        <th style="width:20px;">
            <label class="i-checks m-b-none">
            <input type="checkbox"><i></i>
            </label>
        </th>
        <th>Name</th>
        <th>Description</th>
        <th>Status</th>
        <th>Image</th>
        <th>Date</th>
        <th style="width:30px;"></th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
    </table>
    <div class="ajax-load text-center" style="display: none">
        <p><img style="width: 50px" src="{{ asset('loaderGif/loading4.gif') }}" alt=""></p>
    </div>
</div>
    </div>
</div>

<!-- Modal add-->
@include('admin.Slider.add')
<!-- Modal edit-->
@include('admin.Slider.edit')
@endsection

@section('js')
{{-- lấy data, paginate,  --}}
<script src="admins/slider/index/index.js"></script>
{{-- add slider --}}
<script src="admins/slider/add/add.js"></script>
{{-- edit slider --}}
<script src="admins/slider/edit/edit.js"></script>
{{-- delete slider --}}
<script src="{{asset('admins/deleteAjaxSweetalert.js')}}"></script>
<script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>

<script>
//load ảnh domo
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.avatar1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".file-upload").on('change', function(){
        readURL(this);
    });
</script>

@endsection