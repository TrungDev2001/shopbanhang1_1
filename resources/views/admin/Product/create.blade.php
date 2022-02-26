@extends('layouts.admin')
@section('title')
    Product
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
            Add product
        </div>
        <div class="row w3-res-tb" style="background: #ffffff; border-radius: 15px; padding: 15px; margin: auto; margin-top: 15px; width: 980px; padding: 55px;">
            <form action="{{ route('products.store') }}" id="productAdd" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control nameAdd" name="nameAdd" id="title" onkeyup="ChangeToSlug();" data-validation="required" data-validation-error-msg="Name không được để trống" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="Name">Slug</label>
                    <input type="text" class="form-control slugAdd" name="slugAdd" id="slug" data-validation="required" data-validation-error-msg="Slug không được để trống" placeholder="Enter slug">
                </div>
                <div class="form-group">
                    <label for="Name">Price Original</label>
                    <input type="text" class="form-control format_money" name="original_priceAdd" data-validation="required" data-validation-error-msg="Price original không được để trống" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="Name">Price</label>
                    <input type="text" class="form-control format_money" name="priceAdd" data-validation="required" data-validation-error-msg="Price không được để trống" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="Name">Price promotional</label>
                    <input type="text" class="form-control format_money" name="promotional_priceAdd">
                </div>
                <div class="form-group">
                    <label for="Name">Quantity product</label>
                    <input type="number" class="form-control" name="quantityProductAdd" placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea id="my_editor1" class="form-control" name="descriptionAdd" rows="10" cols="80" data-validation="required" data-validation-error-msg="Description không được để trống">Description</textarea>
                    {{-- <input type="text" id="my_editor1" class="form-control" name="descriptionAdd" data-validation="required" data-validation-error-msg="Description không được để trống" placeholder="Enter description"> --}}
                </div>
                <div class="form-group">
                    <label for="statusAdd">Status</label>
                    <select class="form-control" name="statusAdd">
                        <option value="0">Hiện</option>
                        <option value="1">Ẩn</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="statusAdd">Status product</label>
                    <select class="form-control" name="statusProductAdd">
                        <option value="0">Hàng mới</option>
                        <option value="1">Hàng đã qua sử dụng</option>
                        <option value="2">Hàng trưng bày</option>
                        <option value="3">Hàng tồn kho</option>
                    </select>
                </div>

                <div class="form-group-file">
                    <label for="exampleFormControlFile1">Image product avatar</label>
                    <img src="{{ asset('web\images\85090667-product-word-cloud-collage-business-concept-background.jpg') }}" class="avatar1 img-thumbnail" alt="avatar">
                    <input type="file" accept="image/*" name="image_AvatarAdd" class="form-control-file file-upload" data-validation="required" data-validation-error-msg="Image không được để trống">
                </div>

                <div class="form-group-file tags" style="margin-top: 20px;">
                    <label for="exampleFormControlFile1">Image product detail</label>
                    <input type="file" accept="image/*" name="image_DetailAdd[]" class="form-control-file" multiple="multiple" data-validation="required" data-validation-error-msg="Image không được để trống">
                </div>

                <div class="form-group-file" style="margin-top: 20px;">
                    <label for="exampleFormControlFile1">Document</label>
                    <input type="file" name="documentAdd[]" class="form-control-file" multiple>
                </div>

                <div class="form-group">
                    <label for="Textarea1">Content</label>
                    <textarea id="my_editor" name="contentAdd" class="form-control" rows="10" cols="80" data-validation="required" data-validation-error-msg="Image không được để trống">Content</textarea>
                </div>

                <div class="form-group">
                    <label>Nhập tags cho sản phẩm</label>
                    <select name="tagsProductAdd[]" class="form-control-file" id="select2insidemodal" multiple="multiple" data-validation="required" data-validation-error-msg="Tags không được để trống">
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="parent_id_Category">Category</label>
                    <select class="form-control" name="id_CategoryAdd" id="parent_id_Category" data-validation="required" data-validation-error-msg="Category không được để trống">
                        <option></option>
                        {!! $htmlOption !!}
                    </select>
                </div>
                <div class="form-group">
                    <label for="parent_id_Category">Brand</label>
                    <select class="form-control" name="Category_brandsAdd" id="Category_brands" data-validation="required" data-validation-error-msg="Brand không được để trống">
                        <option></option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" style="float: right;" class="btn btn-success">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('admins/product/add/add.js') }}"></script>
<script src="{{ asset('admins/product/index/index.js') }}"></script>
<script src="{{ asset('admins/product/edit/edit.js') }}"></script>
<script src="{{ asset('admins/deleteAjaxSweetalert.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
<script src="{{ asset('vendors/ckeditor/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('vendors/validator/validator.min.js') }}"></script>
<script>
    $.validate({
        modules : 'file',
    });
</script>

<script>
    CKEDITOR.replace( 'my_editor' );
    CKEDITOR.replace( 'my_editor1' );
</script>

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

<script language="javascript">
    function ChangeToSlug()
    {
        var title, slug;

        //Lấy text từ thẻ input title 
        title = document.getElementById("title").value;

        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('slug').value = slug;
    }
</script>

@endsection