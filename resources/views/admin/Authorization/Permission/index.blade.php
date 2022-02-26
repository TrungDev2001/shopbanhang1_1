@extends('layouts.admin')
@section('title')
    Permission
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/index/index.css') }}">
@endsection
@section('content')
<div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
    List permissions
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
        @can('permission-add')
            <a href="{{ route('PermissionController.create') }}" class="btn btn-primary">Add</a>
        @endcan
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped b-t b-light">
    <thead>
        <tr>
            <th>TT</th>
            <th>Name</th>
            <th>Description</th>
            <th style="width:30px;"></th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td><div style="display: flex;"><a href="{{ route('RoleController.edit', ['id' => $role->id]) }}" class="btn btn-sm btn-warning">Edit</a><a data-url="{{ route('RoleController.delete', ['id' => $role->id]) }}" class="btn btn-sm btn-danger delete-sweetalert">Xóa</a></div></td>
            </tr>
        @endforeach --}}
    </tbody>
    </table>

    <div>
        {{-- {{ $users->links() }} --}}
    </div>
</div>
    </div>
</div>

@endsection

@section('js')
<script src="{{asset('admins/deleteAjaxSweetalert.js')}}"></script>
<script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@endsection