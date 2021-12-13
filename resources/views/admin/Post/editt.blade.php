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

<div class="panel-heading">
    Add post
</div>
<div class="table-responsive" style="background: #ffffff; border-radius: 15px;
    padding: 15px; margin-top: 15px;">
    <form action="{{route('Post.store')}}" method="POST" enctype="multipart/form-data" style="width: 880px; margin: auto">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control titlePostAdd" name="titlePostAdd" id="title" onkeyup="ChangeToSlug();" data-validation="length" data-validation-length="min1" data-validation-error-msg="Title không được để trống" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" name="SlugPostAdd" id="slug" data-validation="length" data-validation-length="min1" data-validation-error-msg="Slug không được để trống" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="DescriptionPostAdd" id="description" data-validation="length" data-validation-length="min1" data-validation-error-msg="Description không được để trống" placeholder="Enter description">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            {{-- <textarea id="my_editor" name="PostAdd" id="content" class="form-control"></textarea> --}}
            <textarea name="ContentPostAdd" id="editor1" rows="10" cols="80" data-validation="required" data-validation-error-msg="Content không được để trống">Content</textarea>
        </div>
        <div class="form-group">
            <label>Tags</label>
            <select name="PostTagsAdd[]" class="form-control-file" id="select2insidemodal" multiple="multiple"  data-validation="required" data-validation-error-msg="Tags không được để trống">
                @foreach ($tags as $tag)
                    <option selected="selected">$tag->name</option>
                @endforeach
            </select>
        </div>
        <div class="form-group-file">
            <label for="exampleFormControlFile1">Image post avatar</label>
            <img src="{{ asset('web\images\85090667-product-word-cloud-collage-business-concept-background.jpg') }}" class="avatar1 img-thumbnail" alt="avatar">
            <input type="file" name="FileImagePostAdd" class="form-control-file file-upload" data-validation="required" data-validation-error-msg="Image post avatar không được để trống" data-validation="mime size" data-validation-allowing="jpg, png, gif" data-validation-max-size="2M">
        </div>
        <div class="form-group">
            <label for="parent_id_Category">Category post</label>
            <select name="CategoryPostAdd" class="form-control Select2_CategoryPost" id="" data-validation="required" data-validation-error-msg="Category post không được để trống">
                <option value=""></option>
                @foreach ($categoryPosts as $categoryPost)
                    <option value="{{ $categoryPost->id }}">{{ $categoryPost->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="statusAdd">Status</label>
            <select class="form-control" name="StatusPostAdd">
                <option value="0">Hiện</option>
                <option value="1">Ẩn</option>
            </select>
            
        </div>
        <button class="btn btn-success" style="float: right;" type="submit">Add</button>
    </form>
</div>
@endsection

@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
{{-- <script src="{{ asset('admins/voucher/add/add.js') }}"></script> --}}
{{-- <script src="{{ asset('admins/voucher/index/index.js') }}"></script> --}}
{{-- <script src="{{ asset('admins/product/edit/edit.js') }}"></script> --}}
<script src="{{ asset('admins/deleteAjaxSweetalert.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
<script src="{{ asset('admins/sweetalert2Message.js') }}"></script>
<script src="{{asset('vendors/validator/validator.min.js')}}"></script>
<script>
    $.validate({
        modules : 'file',
    });
</script>


<script src="{{ asset('vendors/ckeditor/ckeditor/ckeditor.js') }}"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1' );
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

<script>
    $(".Select2_CategoryPost").select2({
        placeholder: "Select a category post",
        allowClear: true
    });

    $("#select2insidemodal").select2({
        tags: true,
        tokenSeparators: [',']
    })
</script>
@endsection