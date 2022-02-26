<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('web/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('web/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('web/css/font.css')}}" type="text/css" />
    <link href="{{asset('')}}web/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('web/css/morris.css')}}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('web/css/monthly.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('web/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('web/js/raphael-min.js')}}"></script>
    <script src="{{asset('web/js/morris.js')}}"></script>
    {{-- toastr ajax --}}
    <link rel="stylesheet" href="{{ asset('vendors/ajaxToastr/toastr.css') }}">
    
    @yield('css')
</head>

<body>
    <section id="container">
        <!--header start-->
        @include('partials.header')
        <!--header end-->
        <!--sidebar start-->
        @include('partials.sidebar')
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                @yield('content')
            </section>

            <!-- footer -->
            @include('partials.footer')
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{asset('web/js/bootstrap.js')}}"></>
    <script src="{{asset('web/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('web/js/scripts.js')}}"></script>
    <script src="{{asset('web/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('web/js/jquery.nicescroll.js')}}"></script>

    <script src="{{asset('vendors/formatFrice/Auto-Format-Currency-With-jQuery/simple.money.format.js')}}"></script>
    <script>
        function test() {
            $('.format_money').simpleMoneyFormat();;
        }
        test();
    </script>

    // toastr ajax
    <script src="{{ asset('vendors/ajaxToastr/toastr.min.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{asset('web/js/flot-chart/excanvas.min.js')}}"></script><![endif]-->
    <script src="web/js/jquery.scrollTo.js"></script>
    <!-- morris JavaScript -->
    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            var graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                parseTime: false,
                fillOpacity: 0.85,
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'year',
                redraw: true,
                ykeys: ['value', 'returning_visitors'],
                labels: ['Số lượng khách truy cập', 'Khách quay lại'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });
            function area_thongketruycap(){
                $.ajax({
                    type: "get",
                    url: "{{ route('chart_data_truycap') }}",
                    
                    success: function (response) {
                        graphArea2.setData(response.chart_data);
                    }
                });
            }
            area_thongketruycap();

        });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="{{asset('web/js/monthly.js')}}"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>
    
    @yield('js')
</body>

</html>