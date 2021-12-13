@php
    $base_url = 'http://localhost:8000/';
@endphp
@extends('layouts.admin')
@section('title')
    Product
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/index.css') }}">
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/validator/validator.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/sweetalert2Message/sweetalert2Message.css') }}" rel="stylesheet" />
    {{-- @livewireStyles --}}
    <style>
        .form-group-file.tags {
            margin-top: 25px;
        }
    </style>
@endsection
@section('content')
<div class="table-agile-info">
    <div>
        <div class="panel-heading">
            Edit product
        </div>
        <div class="row w3-res-tb" style="background: #ffffff; border-radius: 15px; padding: 15px; margin: auto; margin-top: 15px; width: 980px; padding: 55px;">
        <form action="{{ route('products.update_cover', ['id' => $product->id]) }}" id="productEdit" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control nameEdit" name="nameEdit" id="title" value="{{ $product->name }}" onkeyup="ChangeToSlug();" data-validation="required" data-validation-error-msg="Name không được để trống" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="Name">Slug</label>
                <input type="text" class="form-control slugEdit" name="slugEdit" id="slug" value="{{ $product->slug }}" data-validation="required" data-validation-error-msg="Slug không được để trống" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="Name">Price</label>
                <input type="number" class="form-control" name="priceEdit" value="{{ $product->price }}" data-validation="required" data-validation-error-msg="Price không được để trống" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="Name">Quantity product</label>
                <input type="number" class="form-control" name="quantityProductEdit" value="{{ $product->quantity_product }}" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                {{-- <input type="text" class="form-control" name="descriptionEdit" id="descriptionEdit" placeholder="Enter description"> --}}
                <textarea name="descriptionEdit" id="contentEdit2" class="form-control" data-validation="required" data-validation-error-msg="Image không được để trống">{!! $product->description !!}</textarea>
            </div>
            <div class="form-group">
                <label for="statusEdit">Status</label>
                <select class="form-control" name="statusEdit" id="statusEdit">
                    <option {{ $product->active==0 ? 'selected' : '' }} value="0">Hiện</option>
                    <option {{ $product->active==1 ? 'selected' : '' }} value="1">Ẩn</option>                       
                </select>
            </div>
            <div class="form-group">
                <label for="statusAdd">Status product</label>
                <select class="form-control" name="statusProductEdit">
                    <option {{ $product->product_status==0 ? 'selected' : '' }} value="0">Hàng mới</option>
                    <option {{ $product->product_status==1 ? 'selected' : '' }} value="1">Hàng đã qua sử dụng</option>
                    <option {{ $product->product_status==2 ? 'selected' : '' }} value="2">Hàng trưng bày</option>
                    <option {{ $product->product_status==3 ? 'selected' : '' }} value="3">Hàng tồn kho</option>
                </select>
            </div>
            <div class="form-group-file">
                <label for="exampleFormControlFile1">Image product avatar</label>
                <img src="{{ $base_url.$product->feature_image_path }}" class="avatar1 img-thumbnail" alt="avatar">
                <input type="file" name="image_AvatarEdit" class="form-control-file file-upload">
            </div>

            <div class="form-group-file tags">
                <label for="exampleFormControlFile1">Image product detail</label>
                {{-- <input type="file" name="image_DetailEdit[]" class="form-control-file" multiple="multiple" data-validation="required" data-validation-error-msg="Image detail không được để trống"> --}}
                {{-- <img class="detailImage" src="" alt=""> --}}
                <input type="button" class="text-primary editImageDetail" data-toggle="modal" data-target="#exampleModalCenter" value="Edit">
                <div id="editImageDetailaJax">
                    
                </div>
                
            </div>
            <div class="form-group">
                <label for="Textarea1">Content</label>
                <textarea name="contentEdit" id="contentEdit1" class="form-control" data-validation="required" data-validation-error-msg="Content không được để trống">{!! $product->content !!}</textarea>
            </div>
            <div class="form-group">
                <label>Nhập tags cho sản phẩm</label>
                <select name="tagsProductEdit[]" class="form-control" id="select2modal" multiple="multiple" data-validation="required" data-validation-error-msg="Tags không được để trống">
                    @foreach ($tagsProductEdit as $tagProductEdit)
                        <option selected value="{{ $tagProductEdit->name }}">{{ $tagProductEdit->name }}</option>
                    @endforeach
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="parent_id_Category">Category</label>
                <select class="form-control" name="id_CategoryEdit" id="id_Category_edit" data-validation="required" data-validation-error-msg="Category không được để trống">
                    <option></option>
                    {!! $htmlOption !!}
                </select>
            </div>
            <div class="form-group">
                <label for="parent_id_Category">Brand</label>
                <select class="form-control" name="brandsEdit" id="Category_brands_edit" data-validation="required" data-validation-error-msg="Brand không được để trống">
                    <option></option>
                    @foreach($brands as $brand)
                        <option {{ $product->brand_id== $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="float: right;" class="btn btn-success">Edit</button>
        </form>
        </div>
    </div>
</div>
@include('admin.Product.editImageDetail')
@endsection

@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('admins/product/add/add.js') }}"></script>
{{-- <script src="{{ asset('admins/product/index/index.js') }}"></script> --}}
<script src="{{ asset('admins/product/edit/edit.js') }}"></script>
<script src="{{ asset('admins/deleteAjaxSweetalert.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
<script src="{{ asset('vendors/ckeditor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2Message/sweetalert2Message.js') }}"></script>
<script src="{{ asset('admins/product/components/editImageDetail/edit.js') }}"></script>

{{-- @livewireScripts --}}

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {
        // $("#table").DataTable();
        // this is need to Move Ordera accordin user wish Arrangement
        $( "#tablecontents" ).sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });
        function sendOrderToServer() {
            var order = [];
            var product_id = $('#table').attr('data-id');
            //by this function User can Update hisOrders or Move to top or under
            $('tr.row1').each(function(index,element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                });
            });
            console.log(order);
            // the Ajax Post update 
            $.ajax({
                type: "POST", 
                dataType: "json", 
                url: "{{ url('products/updateImageDetail') }}",
                data: {order: order},
                success: function(response) {
                    if (response.status == 200) {
                        window.showMessage(response.message);
                        fetchImages();
                    }
                }
            });
        }
    });
</script>

<script src="{{ asset('vendors/validator/validator.min.js') }}"></script>
<script>
    $.validate({
        modules : 'file',
    });
</script>

<script>
    CKEDITOR.replace( 'contentEdit1' );
    CKEDITOR.replace( 'contentEdit2' );
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