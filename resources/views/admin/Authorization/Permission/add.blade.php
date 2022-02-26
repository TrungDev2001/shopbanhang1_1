@extends('layouts.admin')
@section('title')
    Permission
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
            Add permissions
        </div>
        <div class="row w3-res-tb" style="background: #ffffff; border-radius: 15px; padding: 15px; margin: auto; margin-top: 15px; width: 980px; padding: 55px;">
            <form action="{{ route('PermissionController.store') }}" id="productAdd" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control" name="nameAdd"  id="Name"  data-validation="required" data-validation-error-msg="Name không được để trống" placeholder="Enter name" value={{ old('nameAdd') }}>
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" class="form-control" name="descriptionAdd"  id="Description"  data-validation="required" data-validation-error-msg="Description không được để trống" placeholder="Enter email" value={{ old('descriptionAdd') }}>
                </div>
                <div class="row" style="display: flex; justify-content: space-around;">
                    <p>Permission:</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="permission[]" value="list">
                        <label class="form-check-label" for="inlineCheckbox1">list</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="permission[]" value="add">
                        <label class="form-check-label" for="inlineCheckbox2">add</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="permission[]" value="edit">
                        <label class="form-check-label" for="inlineCheckbox3">edit</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="permission[]" value="delete">
                        <label class="form-check-label" for="inlineCheckbox3">delete</label>
                    </div>
                </div>

                <button type="submit" style="float: right;" class="btn btn-success">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('admins/deleteAjaxSweetalert.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
<script src="{{ asset('vendors/validator/validator.min.js') }}"></script>
<script>
    $.validate({
        modules : 'file',
    });
</script>

@endsection