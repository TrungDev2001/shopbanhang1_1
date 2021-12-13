@extends('layouts.admin')
@section('title')
    Brands
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('admins/category/index.css') }}">
<link rel="stylesheet" href="{{ asset('admins/brand/index.css') }}">
@endsection

@section('content')
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách Brands
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
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="float: right;">Add</button>
                </div>
            </div>

        </div>
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
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    
                </thead>
                
                <tbody>
                    <tr>
                        <td colspan="6" id="ajax-load" >
                            <div class="text-center" >
                                <img style="width: 50px" src="{{ asset('loaderGif\loading4.gif') }}" alt="">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-7 text-right text-center-xs phantrang">
                    
                </div>
            </div>
        </footer>
    </div>
</div>

<!--Show Modal-->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Show Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Name: <span id="showName"></span></p>
        <p>Description: <span id="showDescription"></span></p></p>
        <p>Status: <span id="showStatus"></span></p></p>
        <p>Date created: <span id="showDatecreated"></span></p></p>
        <p>Date update: <span id="showDateupdate"></span></p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--Add Modal -->
@include('admin.Brands.add')
<!--Edit Modal -->
@include('admin.Brands.edit')
@endsection

@section('js')
<script type="text/javascript">

    function fetchBrand(){
        $.ajax({
        type: "GET",
        url: "/brands/fetchBrands",
        beforeSend: function() {
            $('#ajax-load').show();
        },
        success: function (response) {
            $('#ajax-load').hide();
            $('tbody').html('');
            $.each(response.brands.data, function (key, item) {
                $brandsHtml = '';
                $brandsHtml += `<tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td class="" data-url="" id="">`+item.name+`</td>
                    <td id="">`+item.description+`</td>`;
                    if(item.active == 0){
                        $brandsHtml += `<td data-url="" id="" class=""><i class='fa fa-circle'></i></td>`;
                    }else{
                        $brandsHtml += `<td data-url="" id="" class=""><i class='fa fa-circle-o'></i></td>`;
                    }
                    $brandsHtml += `
                    <td id="">`+item.created_at+`</td>
                    <td>
                        <a><i class="fa fa-eye view-brand" data-toggle="modal" data-target="#showModal" data-url="/brands/show/`+item.id+`" aria-hidden="true"></i>
                            <i data-url="/brands/edit/`+item.id+`" data-toggle="modal" data-target="#editModal" class="fa fa-pencil-square-o text-success text-active edit-form "></i>
                            <i data-url="/brands/delete/`+item.id+`" class="fa fa-times text-danger text delete-sweetalert"></i>
                        </a>
                    </td>
                </tr>`;
                $('tbody').append($brandsHtml);
            });
            $('#parent_id_CategoryAdd').html(response.htmlOption);
            $('#parent_id_CategoryEdit').html(response.htmlOption);
        }
    });
    };
    fetchBrand();

    function loadBrandsDate(page){
        $.ajax({
            type: "get",
            url: "/brands/fetchBrands?page=" + page,
            success: function (response) {
                if(response.brands.data == ""){
                    $('#ajax-load').html('<h2>End</h2>');
                    return;
                }else{

                    $.each(response.brands.data, function (key, item) {
                    $brandsHtmlPage = '';
                    $brandsHtmlPage += `<tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td class="" data-url="" id="">`+item.name+`</td>
                        <td id="">`+item.description+`</td>`;
                        if(item.active == 0){
                            $brandsHtmlPage += `<td data-url="" id="" class=""><i class='fa fa-circle'></i></td>`;
                        }else{
                            $brandsHtmlPage += `<td data-url="" id="" class=""><i class='fa fa-circle-o'></i></td>`;
                        }
                        $brandsHtmlPage += `
                        <td id="">`+item.created_at+`</td>
                        <td>
                            <a><i class="fa fa-eye view-brand" data-toggle="modal" data-target="#showModal" data-url="/brands/show/`+item.id+`" aria-hidden="true"></i>
                                <i data-url="/brands/edit/`+item.id+`" data-toggle="modal" data-target="#editModal" class="fa fa-pencil-square-o text-success text-active edit-form "></i>
                                <i data-url="/brands/delete/`+item.id+`" class="fa fa-times text-danger text delete-sweetalert"></i>
                            </a>
                        </td>
                    </tr>`;
                    $('tbody').append($brandsHtmlPage);
                });
                }
            }
        });
    }

    var page = 1;
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() >= $(document).height()){
            page++;
            loadBrandsDate(page);
        }
    });

//show brand
    $(document).on('click', '.view-brand', function(e){
        e.preventDefault();
        var url = $(this).attr('data-url'); 
        $.ajax({
            type: "get",
            url: url,
            success: function (response) {
                $('#showName').html(response.brand.name);
                $('#showDescription').html(response.brand.description);
                if(response.brand.active == 0){
                    $('#showStatus').html('Hoạt động');
                }else{
                    $('#showStatus').html('Không hoạt động');
                }
                $('#showDatecreated').html(response.brand.created_at);
                $('#showDateupdate').html(response.brand.updated_at);
            }
        });
    });
//add brand
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.btn-add', function(e){
        e.preventDefault();
        var data = {
            'nameAdd': $('#nameAdd').val(),
            'descriptionAdd': $('#descriptionAdd').val(),
            'statusAdd': $('#statusAdd').val(),
            'category_idAdd': $('#parent_id_CategoryAdd').val(),
        };
        $.ajax({
            type: "post",
            url: "/brands/store",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 400){
                    $('#nameAddError').html(response.errors.nameAdd);
                    $('#descriptionAddError').html(response.errors.descriptionAdd);
                    $('#id_CategoryAddError').html(response.errors.category_idAdd);
                }else{
                    $('#addModal').find('input').val('');
                    $('#addModal').modal('hide');
                    fetchBrand();
                    //loadBrandsDate(page);
                    toastr.success(response.message);
                }
                
            }
        });
    });
//edit form brand
    $(document).on('click', '.edit-form', function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        console.log(url);
        $.ajax({
            type: "get",
            url: url,
            success: function (response) {
                $('#nameEdit').val(response.brand.name);
                $('#descriptionEdit').val(response.brand.description);
                $('#statusEdit').val(response.brand.active);
                $('#parent_id_CategoryEdit').val(response.brand.category_id);
                $('.edit-update').attr('data-url', '{{asset('/brands/update/')}}/'+response.brand.id);
            }
        });
    });
//edit updated brand
    
    $(document).on('click', '.edit-update', function(e){
        e.preventDefault();
        console.log('aaa');
        var url = $(this).attr('data-url');
        var data = {
            'nameEdit': $('#nameEdit').val(),
            'descriptionEdit': $('#descriptionEdit').val(),
            'statusEdit': $('#statusEdit').val(),
            'id_CategoryEdit': $('#parent_id_CategoryEdit').val(),
        };
        console.log(data);
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (response) {
                $('#editModal').modal('hide');
                fetchBrand();
                toastr.success(response.message);
            }
        });
    });
</script>
<script src="{{asset('admins/deleteAjaxSweetalert.js')}}"></script>
<script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
@endsection