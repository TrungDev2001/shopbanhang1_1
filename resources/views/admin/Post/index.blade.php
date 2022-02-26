@extends('layouts.admin')
@section('title')
    Post
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/index.css') }}">
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <style>
        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }
    </style>
@endsection
@section('content')
<div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
    List post
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
        @can('post-add')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVoucherModal"><a style="color: white" href="{{route('Post.create')}}">Add</a></button>
        @endcan
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped b-t b-light">
    <thead>
        <tr>
            <th>Id</th>
            <th id="test">Title</th>
            <th>Avatar</th>
            <th>Description</th>
            <th>Category post</th>
            <th>Status</th>
            <th>Date</th>
            <th style="width:30px;"></th>
        </tr>
    </thead>
    <tbody>
        @include('admin.Post.data')
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
{{-- @include('admin.Voucher.add') --}}
<!-- Modal edit-->
{{-- @include('admin.Post.edit') --}}

@endsection

@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
{{-- <script src="{{ asset('admins/voucher/add/add.js') }}"></script> --}}
<script src="{{ asset('admins/post/index/index.js') }}"></script>
{{-- <script src="{{ asset('admins/post/edit/edit.js') }}"></script> --}}
<script src="{{ asset('admins/deleteAjaxSweetalert.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
<script src="{{ asset('admins/sweetalert2Message.js') }}"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script src="{{asset('vendors/validator/validator.min.js')}}"></script>
<script>
    $.validate({
        modules : 'file',
    });
</script>
@endsection