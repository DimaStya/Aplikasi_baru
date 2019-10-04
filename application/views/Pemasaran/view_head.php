
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NEW SISTEM</title>
  <link rel="shortcut icon" href="<?php echo base_url('img/icon.ico');?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url('plugins/datatables/dataTables.bootstrap.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/datepicker/datepicker3.css'); ?>">

  <link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('dist/css/skins/_all-skins.min.css');?>">

  <link rel="stylesheet" href="<?php echo base_url('plugins/iCheck/all.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/select2/select2.min.css');?>">
  <script type = "text/javascript" >
    function preventBack(){
      window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
  </script>
  <style type="text/css">
      #notifications {
        cursor: pointer;
        position: fixed;
        right: 0px;
        z-index: 9999;
        top: 110px;
        margin-bottom: 22px;
        margin-right: 15px;
        min-width: 300px; 
        max-width: 800px;
      }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url().'Pemasaran';?>" class="logo">
      <span class="logo-mini"><b>M</b>DT</span>
      <span class="logo-lg"><b>SISTEM </b>MDT</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('dist/img/user.jpeg');?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('username'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo base_url('dist/img/user.jpeg');?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('username'); ?><br><?php echo$this->session->userdata('siapa').' '. $this->session->userdata('alamat'); ?>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url().$this->session->userdata('link')."/Ubah_pass";?>" class="btn btn-default btn-flat">Ubah Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url()."Login/out";?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>