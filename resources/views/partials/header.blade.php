<header class="header fixed-top clearfix" style="top: 0px">
    <!--logo start-->
    <div class="brand">
        <a href="web/index.html" class="logo">
            PShop
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <!--logo end-->
    <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
            <!-- settings start -->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <i class="fa fa-tasks"></i>
                    <span class="badge bg-success">8</span>
                </a>
                <ul class="dropdown-menu extended tasks-bar">
                    <li>
                        <p class="">You have 8 pending tasks</p>
                    </li>
                    <li>
                        <a href="#">
                            <div class="task-info clearfix">
                                <div class="desc pull-left">
                                    <h5>Target Sell</h5>
                                    <p>25% , Deadline 12 June’13</p>
                                </div>
                                <span class="notification-pie-chart pull-right" data-percent="45">
                                    <span class="percent"></span>
                                </span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="task-info clearfix">
                                <div class="desc pull-left">
                                    <h5>Product Delivery</h5>
                                    <p>45% , Deadline 12 June’13</p>
                                </div>
                                <span class="notification-pie-chart pull-right" data-percent="78">
                                    <span class="percent"></span>
                                </span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="task-info clearfix">
                                <div class="desc pull-left">
                                    <h5>Payment collection</h5>
                                    <p>87% , Deadline 12 June’13</p>
                                </div>
                                <span class="notification-pie-chart pull-right" data-percent="60">
                                    <span class="percent"></span>
                                </span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="task-info clearfix">
                                <div class="desc pull-left">
                                    <h5>Target Sell</h5>
                                    <p>33% , Deadline 12 June’13</p>
                                </div>
                                <span class="notification-pie-chart pull-right" data-percent="90">
                                    <span class="percent"></span>
                                </span>
                            </div>
                        </a>
                    </li>

                    <li class="external">
                        <a href="#">See All Tasks</a>
                    </li>
                </ul>
            </li>
            <!-- settings end -->
            <!-- inbox dropdown start-->
            <li id="header_inbox_bar" class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-important">4</span>
                </a>
                <ul class="dropdown-menu extended inbox">
                    <li>
                        <p class="red">You have 4 Mails</p>
                    </li>
                    <li>
                        <a href="#">
                            <span class="photo"><img alt="avatar" src="web/images/3.png"></span>
                            <span class="subject">
                                <span class="from">Jonathan Smith</span>
                                <span class="time">Just now</span>
                            </span>
                            <span class="message">
                                Hello, this is an example msg.
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="photo"><img alt="avatar" src="web/images/1.png"></span>
                            <span class="subject">
                                <span class="from">Jane Doe</span>
                                <span class="time">2 min ago</span>
                            </span>
                            <span class="message">
                                Nice admin template
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="photo"><img alt="avatar" src="web/images/3.png"></span>
                            <span class="subject">
                                <span class="from">Tasi sam</span>
                                <span class="time">2 days ago</span>
                            </span>
                            <span class="message">
                                This is an example msg.
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="photo"><img alt="avatar" src="web/images/2.png"></span>
                            <span class="subject">
                                <span class="from">Mr. Perfect</span>
                                <span class="time">2 hour ago</span>
                            </span>
                            <span class="message">
                                Hi there, its a test
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">See all messages</a>
                    </li>
                </ul>
            </li>
            <!-- inbox dropdown end -->
            <!-- notification dropdown start-->
            <li id="header_notification_bar" class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-warning">3</span>
                </a>
                <ul class="dropdown-menu extended notification">
                    <li>
                        <p>Notifications</p>
                    </li>
                    <li>
                        <div class="alert alert-info clearfix">
                            <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                            <div class="noti-info">
                                <a href="#"> Server #1 overloaded.</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="alert alert-danger clearfix">
                            <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                            <div class="noti-info">
                                <a href="#"> Server #2 overloaded.</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="alert alert-success clearfix">
                            <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                            <div class="noti-info">
                                <a href="#"> Server #3 overloaded.</a>
                            </div>
                        </div>
                    </li>

                </ul>
            </li>
            <!-- notification dropdown end -->
        </ul>
        <!--  notification end -->
    </div>
    <div class="top-nav clearfix">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <li>
                <input type="text" class="form-control search" placeholder=" Search">
            </li>
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    @if(Auth::user()->path_image_avatar == '')
                    <img alt="" src="{{ asset('web/images/unnamed.png') }}">
                    @else
                    <img alt="" src="uploads/AvatarUser/{{Auth::user()->id}}/{{Auth::user()->path_image_avatar}}">
                    @endif
                    <span class="username">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="#" data-toggle="modal" data-target="#profileModal"><i class=" fa fa-suitcase"></i>Profile</a></li>
                    <li><a href="{{ route('home.SettingsProfile') }}"><i class="fa fa-cog"></i> Settings</a></li>
                    
                    <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        <i class="fa fa-key"></i>{{ __('Logout') }}</a><li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </li>
            <!-- user login dropdown end -->

        </ul>
        <!--search & user info end-->
    </div>


</header>

<style>
    body{padding-top:30px;}
    .glyphicon {  margin-bottom: 10px;margin-right: 10px;}
    small {
    display: block;
    line-height: 1.428571429;
    color: #999;
    }
</style>
    <!-- Modal profile -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        @if(Auth::user()->path_image_avatar == '')
                        <img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" />
                        @else
                        <img src="uploads/AvatarUser/{{Auth()->id()}}/{{Auth::user()->path_image_avatar}}" alt="" class="img-rounded img-responsive" />
                        @endif
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h4>
                        <small><cite title="San Francisco, USA">{{ Auth::user()->location }}<i class="glyphicon glyphicon-map-marker"></i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i>{{ Auth::user()->email }}
                            <br />
                            <i class="fa fa-phone-square" aria-hidden="true"></i>&nbsp; &nbsp;{{ Auth::user()->phone}}
                            <br />
                            @if(Auth::user()->gender == 0)
                            <i class="fa fa-venus-mars" aria-hidden="true"></i>&nbsp;&nbsp;Nam
                            @else
                            <i class="fa fa-venus-mars" aria-hidden="true"></i>  Nữ
                            @endif
                            <br />
                            <i class="glyphicon glyphicon-globe"></i><a href="http://www.jquery2dotnet.com">www.jquery2dotnet.com</a>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>{{ Auth::user()->dateBirth }}</p>
                        <!-- Split button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">
                                Social</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span><span class="sr-only">Social</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Twitter</a></li>
                                <li><a href="https://plus.google.com/+Jquery2dotnet/posts">Google +</a></li>
                                <li><a href="https://www.facebook.com/jquery2dotnet">Facebook</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Github</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
