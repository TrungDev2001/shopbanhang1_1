@extends('layouts.admin')
@section('title')
    Role
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/index.css') }}">
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/validator/validator.css') }}" rel="stylesheet" />

@endsection
@section('content')
<div class="table-agile-info">
    <div>
        <div class="panel-heading">
            Edit role
        </div>
        <div class="row w3-res-tb" style="background: #ffffff; border-radius: 15px; padding: 15px; margin: auto; margin-top: 15px; width: 980px; padding: 55px;">
            <form action="{{ route('RoleController.update', ['id' => $role->id]) }}" id="productAdd" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control" name="nameAdd"  id="title"  data-validation="required" data-validation-error-msg="Name không được để trống" placeholder="Enter name" value={{ $role->name }}>
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" value={{ $role->description }} autocomplete="false" class="form-control" name="descriptionAdd"  id="Description"  data-validation="required" data-validation-error-msg="Description không được để trống">
                </div>
                
                <label for="Description">Permission</label>
                
                <style>
                    input[type=checkbox] {
                        transform: scale(1.3);
                    }
                </style>
                <div class="form-group">
                    <div>
                        <input class="form-check-input" type="checkbox" id="checkAll">
                        <label for="checkAll">Check All</label>
                    </div>
                    @foreach ($permissions as $permission)
                        <div class="card row" style="padding: 0px 6px 0 6px; border: 1px solid darkgrey; border-radius: 20px; margin: 0; margin-bottom: 28px; background-color: floralwhite;">
                            <div class="card-header col-md-12" style="background-color: rgb(240 188 180); border-radius: 20px; margin-bottom: 10px;">
                                <input class="form-check-input checkbox_cha" type="checkbox" id="inlineCheckbox00">
                                <label class="form-check-label" for="inlineCheckbox00">{{ $permission->name }}</label>
                            </div>
                            <div class="card-body">
                                <div class="row" style="padding-left: 96px;">
                                    @foreach ($permission->permissionChildren as $key => $permissionChildren_item)
                                        <div class="form-check form-check-inline col-md-3">
                                            <input class="form-check-input checkboxChildren" type="checkbox" id="inlineCheckbox" value="{{ $permissionChildren_item->id }}" {{ $role->permissions->contains('id',  $permissionChildren_item->id) ? 'checked' : '' }} name="permission[]">
                                            <label class="form-check-label" for="inlineCheckbox">{{ $permissionChildren_item->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="submit" style="float: right;" class="btn btn-success">Edit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('vendors/validator/validator.min.js') }}"></script>
<script src="{{ asset('admins/authorization/role/add.js') }}"></script>

@endsection