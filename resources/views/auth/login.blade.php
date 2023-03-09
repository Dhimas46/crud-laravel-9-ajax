<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('template')}}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{asset('template')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('template')}}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Login</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form id="login-form" method="post">
     <div id="errors-list"></div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
          @if ($errors->has('email'))
             <span class="text-danger">{{ $errors->first('email') }}</span>
          @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          @if ($errors->has('password'))
              <span class="text-danger">{{ $errors->first('password') }}</span>
          @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" id="login-btn" class="btn btn-login btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>
        <br>
        <center>
          <a href="{{url('register')}}">Sign up</a>
        </center>

    </div>
  </div>
</div>
<script src="{{asset('template')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('template')}}/dist/js/adminlte.min.js"></script>
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

<script>

$(document).ready(function() {
// submit form data using AJAX
$("#login-form").submit(function(event) {
  // stop form from submitting normally
  event.preventDefault();

  // get form data
  var formData = {
    email: $("#email").val(),
    password: $("#password").val()
  };

  // submit form data using AJAX
  $.ajax({
    type: "POST",
    url: "{{url('api/login')}}",  // replace with your backend endpoint
    data: formData,
    dataType: "json",
    encode: true,
    success: function(data) {
      // handle successful login
       localStorage.setItem("token", data.token);
       window.location.href = "{{ url('products') }}";
    },
    error: function(response) {
      Swal.fire({
        icon: 'error',
        type: 'error',
        title: 'Gagal!',
        text: response.responseJSON.message
      });
      // handle login error
      // console.error("Login error: " + xhr.responseText);
    }
  });

});

});

</script>
