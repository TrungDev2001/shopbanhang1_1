@extends('layouts.admin')
@section('title')
    User
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
            Edit user
        </div>
        <div class="row w3-res-tb" style="background: #ffffff; border-radius: 15px; padding: 15px; margin: auto; margin-top: 15px; width: 980px; padding: 55px;">
            <form action="{{ route('UserController.update', ['id' => $user->id]) }}" id="productAdd" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control" name="nameAdd"  id="title"  data-validation="required" data-validation-error-msg="Name không được để trống" placeholder="Enter name" value={{ $user->name }}>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="text" class="form-control" name="emailAdd"  id="Email"  data-validation="required" data-validation-error-msg="Email không được để trống" placeholder="Enter email" value={{ $user->email }}>
                </div>
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control" name="passwordAdd"  id="Password"  placeholder="Enter password">
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="roleUserAdd[]" class="form-control-file" id="select2insidemodal" multiple="multiple" data-validation="required" data-validation-error-msg="Role không được để trống">
                        @foreach ($roles as $role)
                            <option {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }} value="{{$role->id}}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" style="float: right;" class="btn btn-success">Edit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('admins/product/add/add.js') }}"></script>
<script src="{{ asset('admins/deleteAjaxSweetalert.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
<script src="{{ asset('vendors/ckeditor/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('vendors/validator/validator.min.js') }}"></script>
<script>
    $.validate({
        modules : 'file',
    });
</script>


@endsection