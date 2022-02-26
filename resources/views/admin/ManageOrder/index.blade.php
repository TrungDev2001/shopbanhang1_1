@extends('layouts.admin')
@section('title')
    Manage Oder
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/index.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/manageOder/show/show.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/sweetalert2Message/sweetalert2Message.css') }}">
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />

@endsection
@section('content')
<div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
    List Oder
</div>
<div class="row w3-res-tb">
    <div class="col-sm-5 m-b-xs">
    {{-- <select class="input-sm form-control w-sm inline v-middle">
        <option value="0">Bulk action</option>
        <option value="1">Delete selected</option>
        <option value="2">Bulk edit</option>
        <option value="3">Export</option>
    </select>
    <button class="btn btn-sm btn-default">Apply</button>                 --}}
    </div>
    <div class="col-sm-4">
    </div>
    <div class="col-sm-3">
    <div class="input-group">
        {{-- <input type="text" class="input-sm form-control" placeholder="Search">
        <span class="input-group-btn">
        <button class="btn btn-sm btn-default" type="button">Go!</button>
        </span> --}}
    </div>
    <!-- Button trigger modal -->
        {{-- <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#addProductModal">Add</button> --}}
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped b-t b-light">
    <thead>
        <tr>
        <th>TT</th>
        <th>Customer name</th>
        <th>Total Oder</th>
        <th>Payment</th>
        <th>Status</th>
        <th>Date</th>
        <th style="width:30px;"></th>
        </tr>
    </thead>
    <tbody class="tbody">
        <tr style="display: none"><td colspan="6" class="text-center"><img style="width: 200px;" src="{{asset('loaderGif/YCZH.gif')}}" alt=""></td></tr>
        @include('admin.ManageOrder.component.index')
    </tbody>
    </table>
    <div class="ajax-load text-center" style="display: none">
        <p><img style="width: 150px" src="{{ asset('loaderGif/loading5.gif') }}" alt=""></p>
    </div>
    <div class="load-end text-center" style="display: none">
        <p><img style="width: 150px" src="loaderGif/theend1.gif" alt=""></p>
    </div>
</div>
    </div>
</div>

<!-- Modal add-->
{{-- @include('admin.Product.add') --}}

<!-- Modal show-->
@include('admin.ManageOrder.show')

@endsection

@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('admins/manageOder/show/show.js') }}"></script>
<script src="{{ asset('admins/manageOder/index/index.js') }}"></script>
<script src="{{asset('vendors/sweetalert2Message/sweetalert2Message.js')}}"></script>
{{-- <script src="{{ asset('admins/product/edit/edit.js') }}"></script> --}}
{{-- <script src="{{ asset('admins/deleteAjaxSweetalert.js') }}"></script> --}}
<script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
<script>


//load ảnh domo
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                console.log(e.target);
                $('.avatar1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".file-upload").on('change', function(){
        readURL(this);
    });
</script>
{{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
</script>
<script>
CKEDITOR.replace('my_editor', options);
</script> --}}
@endsection