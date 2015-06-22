<!DOCTYPE html>
<!-- saved from url=(0051)http://dichotaigia.com/themes/edirectory/index.html -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title><?php echo site_title; ?>-<?php echo $title; ?></title>
<meta name="description" content="">
<meta name="author" content="cuongv">
<meta name="robots" content="index, follow">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS styles -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/waitMe.css">
<!-- JS Libs -->
<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/validate.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.bootstrap-growl.js"></script>
<script src="<?php echo base_url();?>assets/js/message.js"></script>
<script src="<?php echo base_url();?>assets/js/waitMe.js"></script>
</head>
<body>
<!-- Main page container -->
<div id="top-bar">
  <div class="container">
    <div class="row">
      <div class="col-md-12"> <a class="brand pull-left" href="<?php echo base_url();?>"><img class="img-responsive" src="<?php echo base_url();?>/assets/img/ateneo_logo.png"></a>
        <!--<ul class="nav nav-pills pull-right">
         
          <?php if($this->session->userdata('user_id') =="") { ?>
          <li><a href="<?php echo base_url();?>auth"><i class="icon-user icon-white"></i> Sign In</a></li>
          <?php } else { ?>
          <li><a href="<?php echo base_url().''.$this->session->userdata('name');?>">My Account</a></li>
          <li><a href="<?php echo base_url();?>auth/logout">Logout</a></li>
          <?php } ?>
        </ul>-->
      </div>
    </div>
  </div>
</div>
<div class="navbar bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>
    <!--<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li <?php if($this->uri->segment(2) == '' or $this->uri->segment(2) == 'index') { ?>class="active" <?php } ?>><a href="<?php echo base_url();?>home/">Home</a></li>
        <li <?php if($this->uri->segment(2) == 'employee') { ?>class="active" <?php } ?>><a href="<?php echo base_url();?>home/employee">Find Employee</a></li>
        <li <?php if($this->uri->segment(2) == 'find_job') { ?>class="active" <?php } ?>><a href="<?php echo base_url();?>home/job-list">Find Job</a></li>
      </ul>
    </nav>-->
  </div>
</div>
<div class="container">
  <div class="row">
  
    <div class="col-md-9">
     
      <?php echo $template['body'] ?> 
    </div>
    
  </div>
</div>
<!--<div id="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h4 class="">Information</h4>
        <ul>
          <li><a href="<?php echo base_url();?>about">About Us</a></li>
          <li><a href="<?php echo base_url();?>terms">Terms &amp; Conditions</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h4>My Account</h4>
        <ul>
          <li><a href="<?php echo base_url();?>auth/login">My Account</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h4>Connect with us</h4>
        
        <a href="https://www.facebook.com/pages/Phonlinejobs/1417577171885516" target="_blank"><img src="<?php echo base_url();?>img/facebook.png" alt="Facebook"></a> <a href="http://dichotaigia.com/themes/edirectory/index.html#"><img src="<?php echo base_url();?>img/twitter.png" alt="Twitter"></a> </div>
    </div>
  </div>
</div>-->
<!-- /Main page container -->

</body>
</html>