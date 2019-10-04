<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reset Password</title>
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
    <a href="<?php echo base_url();?>"><b>SISTEM</b>RESET PASS</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Masukan Password</p>
    <span id='message'></span>
    <form action="<?php echo base_url()."Login/Ubah_pass";?>" method="post" autocomplete='off'>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password Baru" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password_konfirmasi" id="password_konfirmasi" placeholder="Konfirmasi" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-5">
          <a href="<?php echo base_url().$this->session->userdata('link');?>"><button type="button" class="btn btn-danger btn-block btn-flat">Batal</button></a>
          
        </div>
        <div class="col-xs-2"></div>
        <div class="col-xs-5">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="klik" name="klik">Reset</button>
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
  $('#password, #password_konfirmasi').on('keyup', function () {
  if ($('#password').val() == $('#password_konfirmasi').val()) {
    $('#message').html('Matching').css('color', 'green');
    document.getElementById("klik").disabled = false;
  } else {
    $('#message').html('Not Matching').css('color', 'red');
    document.getElementById("klik").disabled = true;
  }
     
  });
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
