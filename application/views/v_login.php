<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <link rel="shortcut icon" href="<?php echo base_url('img/icon.ico');?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/iCheck/square/blue.css');?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url();?>"><b>SISTEM</b>LOGIN</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="<?php echo base_url().'Login/proses';?>" method="post" autocomplete='off'>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required="">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="<?php echo base_url('plugins/jQuery/jQuery-2.2.0.min.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('plugins/iCheck/icheck.min.js');?>"></script>
<script>
$(document).ready(function() {
$("#responsecontainer").load("response.php");
var refreshId = setInterval(function()
{
$("#responsecontainer").load('response.php?randval='+ Math.random());
}, 1000);
});
</script>
<div id="responsecontainer"></div>
</body>
</html>
