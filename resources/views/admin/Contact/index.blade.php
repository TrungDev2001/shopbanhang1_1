@extends('layouts.admin')
@section('title')
    Contact
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/sweetalert2Message/sweetalert2Message.css') }}">
@endsection

@section('content')
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách liên hệ của khách hàng
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-12">
                <div>
                    @can('contact-edit')
                        <a href="{{ route('contact.edit') }}" type="button" class="btn btn-primary" style="float: right;">Setiing Information</a>
                    @endcan
                </div>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name customer</th>
                        <th>Email customer</th>
                        <th>Subject contact</th>
                        <th>Message</th>
                        <th>Reply</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                    
                </thead>
                
                <tbody>
                    @include('admin.Contact.components.data')
                </tbody>

            </table>

            <div class="text-center" >
                <img class="ajax-load" style="width: 50px; margin-left: auto; margin-right: auto; display: none;" src="{{ asset('loaderGif\loading4.gif') }}" alt="">
            </div>
            <div class="load-end text-center" style="display: none">
                <p><img style="width: 150px" src="loaderGif/theend1.gif" alt=""></p>
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

<!--information Modal -->




@endsection

@section('js')
    <script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('vendors/sweetalert2Message/sweetalert2Message.js') }}"></script>
    <script src="{{ asset('vendors/deleteAjaxSweetalert.js') }}"></script>
    <script src="{{ asset('admins/contact/data_contact_customer.js') }}"></script>
    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    @if (session()->has('success_setting_information'))
        <script>
            window.showMessage('Success setting information');
        </script>
        @php
            session()->forget('success_setting_information');
        @endphp
    @endif
@endsection