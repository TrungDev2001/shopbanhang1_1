@php
    $base_url = config('base_url.url_fontend.url');
@endphp

@extends('layouts.admin')

@section('title')
Home Admin
@endsection

@section('content')

<!-- //market-->
<div class="market-updates">
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-2">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-eye"> </i>
            </div>
            <div class="col-md-8 market-update-left">
                <h4>Visitors</h4>
                <h3>{{ $visitor_year }}</h3>
                <p>Lượng khách hàng truy cập 1 năm</p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-1">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-users"></i>
            </div>
            <div class="col-md-8 market-update-left">
                <h4>Users</h4>
                <h3>{{ $count_User }}</h3>
                <p>Tổng số user của hệ thống</p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-3">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-usd"></i>
            </div>
            <div class="col-md-8 market-update-left">
                <h4>Sales</h4>
                <h3>{{ $count_Product }}</h3>
                <p>Tổng số lượng sản phẩm đang bán</p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-4">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
            <div class="col-md-8 market-update-left">
                <h4>Orders</h4>
                <h3>{{ $count_Oder }}</h3>
                <p>Tổng số lượng đơn hàng</p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="clearfix"> </div>
</div>

<div class="row">
    <div class="col-md-6">
        <canvas id="myChart1" width="400" height="400"></canvas>
    </div>
    <style>
        .product_Topview, .post_Topview {
            color: black;
        }
        .product_Topview:hover {
            color:rgb(255, 255, 255);
        }
        .post_Topview:hover {
            color:rgb(255, 255, 255);
        }
    </style>
    <div class="col-md-3" style="display: grid">
        <b>Các sản phẩm xem nhiều nhất</b>
        @foreach ($products as $product)
            <a class="product_Topview" href="{{ $base_url.'product/detail/'.$product->id.'/'.$product->slug }}" >{{ Str::words($product->name,4) }} <span style="color: rgb(92, 60, 19);">{{ $product->view_count }}</span></a>
        @endforeach
    </div>
    <div class="col-md-3" style="display: grid">
        <b>Các bài viết xem nhiều nhất</b>
        @foreach ($posts as $post)
            <a class="post_Topview" target="_blank" href="{{ $base_url.'blog/detail/'.$post->id.'/'.$post->slug }}" >{{ Str::words($post->title,4) }} <span style="color: rgb(92, 60, 19);">{{ $post->view_count }}</span></a>
        @endforeach
    </div>
</div>

{{-- <div class="row">
    <div class="col-md-12">
        <header class="agileits-box-header clearfix">
            <h3>Thống kê truy cập</h3>
            <div class="toolbar">


            </div>
        </header>
        <div id="myChart2" style=" height: 500px; background-color: #eef9f0;"></div>
    </div>
</div> --}}
<!-- //market-->
<div class="row">
    <div class="panel-body">
        <div class="col-md-12 w3ls-graph">
            <!--agileinfo-grap-->
            <div class="agileinfo-grap">
                <div class="agileits-box">
                    <header class="agileits-box-header clearfix">
                        <h3>Thông kê truy cập</h3>
                        <div class="toolbar">


                        </div>
                    </header>
                    <div class="agileits-box-body clearfix">
                        <div id="hero-area"></div>
                    </div>
                </div>
            </div>
            <!--//agileinfo-grap-->

        </div>
    </div>
</div>
<div class="agil-info-calendar">
    <!-- //calendar -->
    {{-- <div class="col-md-6 w3agile-notifications">
        <div class="notifications">
            <!--notification start-->

            <header class="panel-heading">
                Notification
            </header>
            <div class="notify-w3ls">
                <div class="alert alert-info clearfix">
                    <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
                    <div class="notification-info">
                        <ul class="clearfix notification-meta">
                            <li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span> send you a mail </li>
                            <li class="pull-right notification-time">1 min ago</li>
                        </ul>
                        <p>
                            Urgent meeting for next proposal
                        </p>
                    </div>
                </div>
                <div class="alert alert-danger">
                    <span class="alert-icon"><i class="fa fa-facebook"></i></span>
                    <div class="notification-info">
                        <ul class="clearfix notification-meta">
                            <li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span> mentioned you in a post </li>
                            <li class="pull-right notification-time">7 Hours Ago</li>
                        </ul>
                        <p>
                            Very cool photo jack
                        </p>
                    </div>
                </div>
                <div class="alert alert-success ">
                    <span class="alert-icon"><i class="fa fa-comments-o"></i></span>
                    <div class="notification-info">
                        <ul class="clearfix notification-meta">
                            <li class="pull-left notification-sender">You have 5 message unread</li>
                            <li class="pull-right notification-time">1 min ago</li>
                        </ul>
                        <p>
                            <a href="#">Anjelina Mewlo, Jack Flip</a> and <a href="#">3 others</a>
                        </p>
                    </div>
                </div>
                <div class="alert alert-warning ">
                    <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
                    <div class="notification-info">
                        <ul class="clearfix notification-meta">
                            <li class="pull-left notification-sender">Domain Renew Deadline 7 days ahead</li>
                            <li class="pull-right notification-time">5 Days Ago</li>
                        </ul>
                        <p>
                            Next 5 July Thursday is the last day
                        </p>
                    </div>
                </div>
                <div class="alert alert-info clearfix">
                    <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
                    <div class="notification-info">
                        <ul class="clearfix notification-meta">
                            <li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span> send you a mail </li>
                            <li class="pull-right notification-time">1 min ago</li>
                        </ul>
                        <p>
                            Urgent meeting for next proposal
                        </p>
                    </div>
                </div>

            </div>

            <!--notification end-->
        </div>
    </div> --}}
    <div class="clearfix"> </div>
</div>
<!-- tasks -->
<div class="agile-last-grids">
    <div class="col-md-4 agile-last-left">
        <div class="agile-last-grid">
            <div class="area-grids-heading">
                <h3>Hàng tháng</h3>
            </div>
            <div id="graph7"></div>
            <script>
                // This crosses a DST boundary in the UK.
                var monthlyChartArea = Morris.Area({
                    element: 'graph7',
                    parseTime: false,
                    xkey: 'date',
                    ykeys: ['sales', 'profit', 'oder_quantity'],
                    labels: ['Doanh thu', 'Lợi nhuận', 'Số đơn hàng']
                });
            </script>

        </div>
    </div>
    <div class="col-md-4 agile-last-left agile-last-middle">
        <div class="agile-last-grid">
            <div class="area-grids-heading">
                <h3>Hàng ngày</h3>
            </div>
            <div id="graph8"></div>
            <script>
                var daily_chart_area = Morris.Bar({
                    element: 'graph8',
                    xkey: 'date',
                    ykeys: ['sales', 'profit', 'oder_quantity'],
                    labels: ['Doanh thu', 'Lợi nhuận', 'Số lượng đơn hàng'],
                    xLabelAngle: 60
                });
            </script>
        </div>
    </div>
    <div class="col-md-4 agile-last-left agile-last-right">
        <div class="agile-last-grid">
            <div class="area-grids-heading">
                <h3>Hàng năm</h3>
            </div>
            <div id="graph9"></div>
            <script>
                var yearly_chart_area = Morris.Line({
                    element: 'graph9',
                    parseTime: false,
                    xkey: 'date',
                    ykeys: ['sales', 'profit', 'oder_quantity'],
                    labels: ['Doanh thu', 'Lợi nhuận', 'Số lượng đơn hàng'],
                    parseTime: false
                });
            </script>

        </div>
    </div>
    <div class="clearfix"> </div>
</div>
<!-- //tasks -->
{{-- <div class="agileits-w3layouts-stats">
    <div class="col-md-4 stats-info widget">
        <div class="stats-info-agileits">
            <div class="stats-title">
                <h4 class="title">Browser Stats</h4>
            </div>
            <div class="stats-body">
                <ul class="list-unstyled">
                    <li>GoogleChrome <span class="pull-right">85%</span>
                        <div class="progress progress-striped active progress-right">
                            <div class="bar green" style="width:85%;"></div>
                        </div>
                    </li>
                    <li>Firefox <span class="pull-right">35%</span>
                        <div class="progress progress-striped active progress-right">
                            <div class="bar yellow" style="width:35%;"></div>
                        </div>
                    </li>
                    <li>Internet Explorer <span class="pull-right">78%</span>
                        <div class="progress progress-striped active progress-right">
                            <div class="bar red" style="width:78%;"></div>
                        </div>
                    </li>
                    <li>Safari <span class="pull-right">50%</span>
                        <div class="progress progress-striped active progress-right">
                            <div class="bar blue" style="width:50%;"></div>
                        </div>
                    </li>
                    <li>Opera <span class="pull-right">80%</span>
                        <div class="progress progress-striped active progress-right">
                            <div class="bar light-blue" style="width:80%;"></div>
                        </div>
                    </li>
                    <li class="last">Others <span class="pull-right">60%</span>
                        <div class="progress progress-striped active progress-right">
                            <div class="bar orange" style="width:60%;"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8 stats-info stats-last widget-shadow">
        <div class="stats-last-agile">
            <table class="table stats-table ">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>PRODUCT</th>
                        <th>STATUS</th>
                        <th>PROGRESS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Lorem ipsum</td>
                        <td><span class="label label-success">In progress</span></td>
                        <td>
                            <h5>85% <i class="fa fa-level-up"></i></h5>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Aliquam</td>
                        <td><span class="label label-warning">New</span></td>
                        <td>
                            <h5>35% <i class="fa fa-level-up"></i></h5>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Lorem ipsum</td>
                        <td><span class="label label-danger">Overdue</span></td>
                        <td>
                            <h5 class="down">40% <i class="fa fa-level-down"></i></h5>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Aliquam</td>
                        <td><span class="label label-info">Out of stock</span></td>
                        <td>
                            <h5>100% <i class="fa fa-level-up"></i></h5>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Lorem ipsum</td>
                        <td><span class="label label-success">In progress</span></td>
                        <td>
                            <h5 class="down">10% <i class="fa fa-level-down"></i></h5>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>Aliquam</td>
                        <td><span class="label label-warning">New</span></td>
                        <td>
                            <h5>38% <i class="fa fa-level-up"></i></h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="clearfix"> </div>


</div> --}}
<div class="agil-info-calendar">
        <!-- calendar -->
    <div class="col-md-12 agile-calendar">
        <div class="calendar-widget">
            <div class="panel-heading ui-sortable-handle">
                <span class="panel-icon">
                    <i class="fa fa-calendar-o"></i>
                </span>
                <span class="panel-title"> Calendar Widget</span>
            </div>
            <!-- grids -->
            <div class="agile-calendar-grid">
                <div class="page">

                    <div class="w3l-calendar-left">
                        <div class="calendar-heading">

                        </div>
                        <div class="monthly" id="mycalendar"></div>
                    </div>

                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    {{-- <script>
        var lineChart_thongketruycap = new Morris.Area({
            element: 'myChart2',
            lineColors: ['red', 'green'],
            fillOpacity: 0.7,
            parseTime: false,
            xkey: 'year',
            ykeys: ['value', 'returning_visitors'],
            labels: ['Số lượng khách truy cập', 'Khách quay lại']
        });
    </script> --}}

    <script>
        // function area_thongketruycap(){
        //     $.ajax({
        //         type: "get",
        //         url: "{{ route('chart_data_truycap') }}",
                
        //         success: function (response) {
        //             lineChart_thongketruycap.setData(response.chart_data);
        //         }
        //     });
        // }
        function chart_data_area_doanhthu_daily(){
            $.ajax({
                type: "get",
                url: "{{ route('chart_data_area_doanhthu_daily') }}",
                success: function (response) {
                    daily_chart_area.setData(response.chart_data);
                }
            });
        }
        function chart_data_area_doanhthu_month(){
            $.ajax({
                type: "get",
                url: "{{ route('chart_data_area_doanhthu_month') }}",
                success: function (response) {
                    monthlyChartArea.setData(response.chart_data);
                }
            });
        }
        function chart_data_area_doanhthu_yearly(){
            $.ajax({
                type: "get",
                url: "{{ route('chart_data_area_doanhthu_yearly') }}",
                success: function (response) {
                    yearly_chart_area.setData(response.chart_data);
                }
            });
        }
        // area_thongketruycap();
        chart_data_area_doanhthu_daily();
        chart_data_area_doanhthu_month();
        chart_data_area_doanhthu_yearly();
    </script>

    <script>
        const data = {
            labels: [
                'Product',
                'Post',
                'Video',
                'User'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [<?php echo($count_Product) ?>, <?php echo($count_Post) ?>, <?php echo($count_Video) ?>, <?php echo($count_User) ?>],
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(81, 252, 226)',
                ],
                hoverOffset: 4
            }]
        };

        const config1 = {
            type: 'doughnut',
            data: data,
            options: {}
        };
        const myChart = new Chart(
            document.getElementById('myChart1'),
            config1,
            
        );
    </script>

@endsection