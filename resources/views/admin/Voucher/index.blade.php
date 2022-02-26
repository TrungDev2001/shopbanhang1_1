@extends('layouts.admin')
@section('title')
    Voucher
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/index.css') }}">
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }
    </style>
@endsection
@section('content')
<div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
    List voucher
</div>
<div class="row w3-res-tb">
    <div class="col-sm-5 m-b-xs">
    {{-- <select class="input-sm form-control w-sm inline v-middle">
        <option value="0">Bulk action</option>
        <option value="1">Delete selected</option>
        <option value="2">Bulk edit</option>
        <option value="3">Export</option>
    </select>
    <button class="btn btn-sm btn-default">Apply</button>                 --}}
    </div>
    <div class="col-sm-4">
    </div>
    <div class="col-sm-3">
    <div class="input-group">
        {{-- <input type="text" class="input-sm form-control" placeholder="Search">
        <span class="input-group-btn">
        <button class="btn btn-sm btn-default" type="button">Go!</button>
        </span> --}}
    </div>
    <!-- Button trigger modal -->
    @can('voucher-add')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVoucherModal1">Add</button>
    @endcan
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped b-t b-light">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Code</th>
            {{-- <th>Type</th> --}}
            <th>Number</th>
            <th>NumberMax</th>
            <th>Quantity</th>
            <th>Use/user</th>
            <th>Date start</th>
            <th>Date end</th>
            <th>Expiry</th>
            <th>Status</th>
            <th>Gift</th>
            <th style="width:30px;"></th>
        </tr>
    </thead>
    <tbody>
        <tr><td colspan="6" class="text-center"><img style="width: 200px;" src="{{asset('loaderGif/YCZH.gif')}}" alt=""></td></tr>
    </tbody>
    </table>
    <div class="ajax-load text-center" style="display: none">
        <p><img style="width: 150px" src="{{ asset('loaderGif/loading5.gif') }}" alt=""></p>
    </div>
    <div class="load-end text-center" style="display: none">
        <p><img style="width: 150px" src="loaderGif/theend1.gif" alt=""></p>
    </div>
</div>
    </div>
</div>

<!-- Modal add-->
@include('admin.Voucher.add')
<!-- Modal edit-->
@include('admin.Voucher.edit')

@endsection

@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('admins/voucher/add/add.js') }}"></script>
<script src="{{ asset('admins/voucher/index/index.js') }}"></script>
<script src="{{ asset('admins/voucher/edit/edit.js') }}"></script>
<script src="{{ asset('admins/deleteAjaxSweetalert.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
<script src="{{ asset('admins/sweetalert2Message.js') }}"></script>
<script src="{{ asset('vendors/formatFrice') }}"></script>


<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#datepicker1, #datepicker2, #datepicker3, #datepicker4" ).datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "dd-mm-yy",
            dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration: "slow"
        });
    } );

    $(document).on('change', '.typeVoucher', function () {
        if ($(this).val() == 0) {
            $('#numberMaxVoucher, #numberMaxVoucherE').fadeIn(1000);
        } else {
            $('#numberMaxVoucher, #numberMaxVoucherE').fadeOut(1000);
        }
    })
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection