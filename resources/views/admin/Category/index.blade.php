@extends('layouts.admin')

@section('title')
Category
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/category/index.css') }}">
@endsection

@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách danh mục
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
                        <button class="btn btn-sm btn-default" type="button">Search</button>
                    </span>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
        @can('category-add')
            <button type="button" class="btn btn-primary float-md-right m-3 btnadd" data-toggle="modal" data-target="#addModal" style="float: right;">
                Add
            </button>
        @endcan

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
                        <th>Status</th>
                        {{-- <th>Danh mục cha</th> --}}
                        <th>Date</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <div id="category-data">
                        @include('admin.Category.data')
                    </div>
                </tbody>
            </table>
                <div class="ajax-load text-center" style="display: none">
                    <p><img style="width: 50px" src="{{ asset('loaderGif/loading4.gif') }}" alt=""></p>
                </div>
        </div>

        <form action="{{ route('category.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".xlsx"><br>
            <input type="submit" value="Import excel" name="import_excel" class="btn btn-warning">
        </form>
        <form action="{{ route('category.export') }}" method="POST">
            @csrf
            <input type="submit" value="Export excel" name="export_excel" class="btn btn-success">
        </form>

        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-7 text-right text-center-xs">
                    {{-- {{$categorys->links()}} --}}
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- Modal add-->
@include('admin.Category.add')
<!-- Modal edit-->
@include('admin.Category.edit')

@endsection

@section('js')
<script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
{{-- deleteCategory --}}
<script src="{{asset('admins/deleteAjaxSweetalert.js')}}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{asset('admins/category/index/index.js')}}"></script>
<script src="{{asset('admins/category/edit/edit.js')}}"></script>
<script src="{{asset('admins/category/add/add.js')}}"></script>
@endsection