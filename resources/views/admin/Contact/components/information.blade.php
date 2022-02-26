@extends('layouts.admin')
@section('title')
    Setiing Information
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/validator/validator.css') }}">
@endsection

@section('content')
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Setting Information Shop
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
        <div class="table-responsive">
            <div class="row">
                <div class="col-md-12" style="padding: 10px 40px;">
                    <form action="{{ route('contact.update') }}" id="form_contact" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone</label>
                            <input type="number" class="form-control" name="phone" value="{{ isset($contact) ? $contact->phone : '' }}" id="exampleInputEmail1" data-validation="required" data-validation-error-msg="Phone không được để trống" placeholder="Enter email">
                            <small id="phoneError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Email</label>
                            <input type="text" class="form-control" name="email"  value="{{ isset($contact) ? $contact->email_link : '' }}" id="exampleInputEmail2" data-validation="required" data-validation-error-msg="Email không được để trống" placeholder="Enter email">
                            <small id="emailError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Link facebook</label>
                            <input type="text" class="form-control" name="facebook_link"  value="{{ isset($contact) ? $contact->fb_link : '' }}" id="exampleInputEmail3" data-validation="required" data-validation-error-msg="Link facebook không được để trống" placeholder="Enter email">
                            <small id="facebook_linkError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Fanpage facebook</label>
                            <input type="text" class="form-control" name="fb_fanpage"  value="{{ isset($contact) ? $contact->fb_fanpage : '' }}" id="exampleInputEmail3" data-validation="required" data-validation-error-msg="Link facebook không được để trống" placeholder="Enter email">
                            <small id="facebook_linkError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail4">Link twitter</label>
                            <input type="text" class="form-control" name="twitter_link" value="{{ isset($contact) ? $contact->twitter_link : '' }}" id="exampleInputEmail4" data-validation="required" data-validation-error-msg="Link twitter không được để trống" placeholder="Enter email">
                            <small id="twitter_linkError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail5">Link youtube</label>
                            <input type="text" class="form-control" name="youtube_link" value="{{ isset($contact) ? $contact->twitter_link : '' }}" id="exampleInputEmail5" data-validation="required" data-validation-error-msg="Link youtube không được để trống" placeholder="Enter email">
                            <small id="youtube_linkError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail6">Iframe ggmap</label>
                            <input type="text" class="form-control" name="iframe_ggmap" value="{{ isset($contact) ? $contact->ifream_ggmap : '' }}" id="exampleInputEmail6" data-validation="required" data-validation-error-msg="Iframe ggmap không được để trống" placeholder="Enter email">
                            <small id="iframe_ggmapError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail7">Info shop</label>
                            <textarea id="my_editor1" name="info_shop" class="form-control">{!! isset($contact) ? $contact->info_shop : 'Nhập info shop' !!}</textarea>
                            <small id="info_shopError" class="form-text text-danger"></small>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;">Ok</button>
                    </form>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-7 text-right text-center-xs phantrang">
                    
                </div>
            </div>
        </footer>
    </div>
</div>




@endsection

@section('js')

    <script src="{{ asset('vendors/validator/validator.min.js') }}"></script>

    <script src="{{ asset('vendors/ckeditor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('my_editor1');
    </script>


    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.validate({
            modules : 'file',
        });
    </script>
@endsection