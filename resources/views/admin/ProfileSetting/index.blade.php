<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
</head>


<hr>
<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-10"><h1>User name</h1></div>
    	<div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a></div>
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              

      <div class="text-center">
        @if(Auth::user()->path_image_avatar == '')
        <img src="{{ asset('web/images/avatar_2x.png') }}" class="avatar img-circle img-thumbnail" alt="avatar">
        @else
        <img src="http://localhost:8000/uploads/AvatarUser/{{Auth::user()->id}}/{{Auth::user()->path_image_avatar}}" class="avatar img-circle img-thumbnail" alt="avatar">
        @endif
        <h6>Upload a different photo...</h6>
        <form id="formAvatarImage" method="post" enctype="multipart/form-data">
            <input data-url="{{ route('AvatarProfile.update', ['id' => Auth::user()->id]) }}" type="file" name="avatarUser" class="text-center center-block file-upload">
        </form>
      </div><br>

               
          <div class="panel panel-default">
            <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="#">bootnipets.com</a></div>
          </div>
          
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
          </ul> 
               
          <div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
            	<i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div>
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                <li><a data-toggle="tab" href="#messages">Change Password</a></li>
            </ul>    
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                <form class="form" action="{{ route('SettingsProfile.update',['id' => Auth::id()]) }}" method="post" id="registrationForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="first_name"><h4>First name</h4></label>
                            <input type="text" class="form-control" name="first_name" value="{{ Auth::user()->name }}" id="first_name" placeholder="first name" title="enter your first name if any.">
                        </div>
                    </div>
                    <div class="form-group">                       
                        <div class="col-xs-6">
                        <label for="last_name"><h4>Last name</h4></label>
                            <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->lastname }}" id="last_name" placeholder="last name" title="enter your last name if any.">
                        </div>
                    </div>   
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="phone"><h4>Phone</h4></label>
                            <input type="number" class="form-control" name="phone" value="{{ Auth::user()->phone }}" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                        </div>
                    </div>       
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="email"><h4>Email</h4></label>
                            <input disabled type="email" class="form-control" value="{{ Auth::user()->email }}" id="email" placeholder="you@email.com" title="enter your email.">
                        </div>
                    </div>
                    <div class="form-group">            
                        <div class="col-xs-6">
                            <label for="location"><h4>Location</h4></label>
                            <input type="text" class="form-control" name="location" value="{{ Auth::user()->location }}" id="location" placeholder="somewhere" title="enter a location">
                        </div>
                    </div>
                    <div class="form-group">            
                        <div class="col-xs-6">
                            <label for="Avatar"><h4>Avatar</h4></label>
                            <input type="file" class="form-control" name="Avatar" value="{{ Auth::user()->path_image_avatar }}" id="Avatar" placeholder="somewhere" title="enter a location">
                        </div>
                    </div>
                    <div class="form-group"> 
                    <div class="col-xs-6">
                        <label for="password2"><h4>Date of Birth</h4></label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' value="{{ Auth::user()->dateBirth }}" name="dateBirth" class="form-control" />
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <br>
                            <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                            <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                        </div>
                    </div>
              	</form>
              
             </div><!--/tab-pane-->
             <div class="tab-pane" id="messages">
               
               <h2></h2>
               
               <hr>
                  <form class="form" action="##" method="post" id="registrationForm">
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="password"><h4>Password</h4></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="password2"><h4>Verify</h4></label>
                              <input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                      </div>
              	</form>
               
             </div><!--/tab-pane-->
             </div><!--/tab-pane-->
            
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->

<script>
    $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".file-upload").on('change', function(){
        readURL(this);
        var url = $('.file-upload').attr('data-url');
        let formData = new FormData($('#formAvatarImage')[0]);
        $.ajax({
            type: "post",
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                
            }
        });
    });
});
</script>

<script type="text/javascript">
    // $(function() {
    //     $('#datetimepicker1').datetimepicker();
    // });
    $(document).on('click', '.input-group-addon', function(){
        $('#datetimepicker1').datetimepicker();
    });
</script>


                                                      