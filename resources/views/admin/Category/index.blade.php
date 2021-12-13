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
        <button type="button" class="btn btn-primary float-md-right m-3 btnadd" data-toggle="modal" data-target="#addModal" style="float: right;">
            Add
        </button>

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
                        <th>Danh mục cha</th>
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
//paginate
    function loadCategoryData(page)
    {
        $.ajax({
            url: '?page=' + page,
            type: 'get',
            beforeSend: function(){
                $('.ajax-load').show();
            },
            success: function (response){
                if(response.html == ""){
                    $('.ajax-load').html('<h4>Category not found.</h4>');
                    return;
                }else{
                    $('.ajax-load').hide();
                    $('tbody').append(response.html);
                };
            },
        });
    }
    var page = 1;
    $(window).scroll(function () { 
        if($(window).scrollTop() + $(window).height() >= $(document).height()){
            page ++;
            loadCategoryData(page);
            //alert('aa');
        }
    });
//edit form category
    $(document).on('click', '.edit-form', function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        console.log(url);
        $.ajax({
            type: "get",
            url: url,
            success: function (response) {
                console.log(response);
                $('#nameCategoryEdit').val(response.category.name);
                //$('#parent_id_CategoryEdit').val(response.category.parent_id);
                $('#parent_id_CategoryEdit').html(response.htmlOption);
                $('#statusCategoryEdit').val(response.category.active);
                $('.edit-update').attr('data-url', '{{ asset('/category/ajax/update/') }}/'+response.category.id);
            }
        });
    })
//edit update category
    $(document).on('click', '.edit-update', function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        var data = {
            'name': $('#nameCategoryEdit').val(),
            'active': $('#statusCategoryEdit').val(),
            'prent': $('#parent_id_CategoryEdit').val()
        };
        console.log(url);
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (response) {
                console.log(response)
                $categoryHtmlEdit = '';
                $('#name-'+response.category.id).text(response.category.name);
                if(response.category.active == 0){
                    $categoryHtmlEdit += `<td id="fa-active-on-`+response.category.id+`" data-url="/category/ajax/activeCategory/`+response.category.id+`" class="activeCategory"><i class='fa fa-circle-o'></i></td>`}
                else{$categoryHtmlEdit += `<td id="fa-active-on-`+response.category.id+`" data-url="/category/ajax/activeCategory/`+response.category.id+`" class="activeCategory"><i class='fa fa-circle'></i></td>`};
                $('#fa-active-on-'+response.category.id).html($categoryHtmlEdit);
                $('#dateCategory-'+response.category.id).text(response.category.updated_at);
                $('#editModal').modal('hide');
                toastr.success(response.message);
            }
        });
    });
//add category
    $(document).on('click', '.btn-add', function(e) {
        e.preventDefault();
        var data = {
            'name': $('#nameCategory').val(),
            'parent': $('#parent_id_Category').val(),
            'status': $('#statusCategory').val()
        };
        $.ajax({
            type: "post",
            url: "/category/store",
            data: data,
            dataType: "json",
            success: function(response) {
                //console.log(response.status); 
                $('#nameError').html("");
                $('#nameError').addClass('bg-danger');
                if(response.status == 400){
                    $('#nameError').html(response.name);
                }else{
                    
                    toastr.success(response.message)
                    $('#addModal').modal('hide');
                    $categoryHtmlAdd = '';
                    $categoryHtmlAdd += `<tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td id="name-`+response.category.id+`" class="editname" data-url="/category/ajax/nameCategory/`+response.category.id+`" contenteditable='true'>`+response.category.name+`</td>`;
                        if(response.category.active == 0){
                        $categoryHtmlAdd += `<td id="fa-active-on-`+response.category.id+`" data-url="/category/ajax/activeCategory/`+response.category.id+`" class="activeCategory"><i class='fa fa-circle-o'></i></td>`}
                        else{$categoryHtmlAdd += `<td id="fa-active-on-`+response.category.id+`" data-url="/category/ajax/activeCategory/`+response.category.id+`" class="activeCategory"><i class='fa fa-circle'></i></td>`};
                        $categoryHtmlAdd += `<td id="dateCategory-`+response.category.id+`">`+response.category.created_at+`</td>
                        <td>
                            <a><i data-url="/category/ajax/edit/`+response.category.id+`" data-toggle="modal" data-target="#editModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i><i data-url="/category/ajax/delete/`+response.category.id+`" class="fa fa-times text-danger text delete-sweetalert"></i></a>
                        </td>
                    </tr>`;
                    $('tbody').prepend($categoryHtmlAdd);
                    $('#addModal').find('input').val('');
                    window.location.reload(false);
                }
            }
        });
    });


//edit active category
    $(document).on('click', '.activeCategory', function() {
        var url = $(this).attr('data-url');
        var that = $(this);
        console.log(url);
        $.ajax({
            method: 'post',
            url: url,
            success: function(data) {
                that.html(data.activeOn);
                if(data.active == 0){
                    toastr.success(data.messageOff);
                }else{
                    toastr.success(data.messageOn);
                }
            },
        });
    });
//edit name category
    $(document).on('keyup', '.editname', function() {
        $name = $(this).text();
        var url = $(this).attr('data-url');
        console.log($name);
        console.log(url);
        $.ajax({
            method: 'post',
            url: url,
            data: {
                name: $name
            },
            success: function(data) {
                toastr.success(data.message)
            },
            error: function(error) {

            }
        });
    });
//cập nhập active lại khi edit
    $(document).on('click', '.btnadd', function(){
        console.log('aaa');
        $.ajax({
            type: "get",
            url: "/category/ajax/activeCategory",
            success: function (response) {
                //$('#parent_id_Category').html('');
                //$('#parent_id_Category').prepend(response.htmlOptionAdd);    
            }
        });
    })
</script>
@endsection