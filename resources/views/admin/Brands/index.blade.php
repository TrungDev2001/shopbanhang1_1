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
                @can('brand-add')
                    <div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="float: right;">Add</button>
                    </div>
                @endcan
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th style="width:20px;"></th>
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
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('admins/brand/index/index.js') }}"></script>
<script src="{{ asset('admins/brand/add/add.js') }}"></script>
<script src="{{ asset('admins/brand/edit/edit.js') }}"></script>
<script src="{{asset('admins/deleteAjaxSweetalert.js')}}"></script>
<script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
@endsection