<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="google-signin-client_id" content="671546476176-kgp62t1kpb9ljeb2kjijg8cnpf95cl06.apps.googleusercontent.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css' ?>" />
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome-4.7.0/css/font-awesome.min.css' ?>" />
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css' ?>" />
  <?php //if($this->uri->segment(1) == "users" || $this->uri->segment(2) == "login" ): ?>
    <style>
      body {background: #d9534f;}
    </style>
  <?php //endif; ?>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="https://www.gstatic.com/firebasejs/4.13.0/firebase.js"></script>
  <script>
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyBJoh5koayNxNJtEYJO-N-o7hfrkcW-2rw",
      authDomain: "chat-fd77b.firebaseapp.com",
      databaseURL: "https://chat-fd77b.firebaseio.com",
      projectId: "chat-fd77b",
      storageBucket: "chat-fd77b.appspot.com",
      messagingSenderId: "511348448002"
    };
    firebase.initializeApp(config);
  </script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <?php if($this->uri->segment(1) != 'users' ): ?>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url(); ?>">LOGO</a>
      <?php endif; ?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <?php if($this->session->userdata('userSessId') ): ?>
          <li>
            <div class="dropdown">
              <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown">Login as <strong id="loginAs"><?php echo $this->session->userdata('userSessId'); ?></strong>
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-lock"></i> Account</a></li>
                <li><div class="divider"></div></li>
                <li><a href="javascript:void(0);" onclick="signOut();"><i class="fa fa-power-off"></i> Logout</a></li>
              </ul>
            </div>
          </li>
        <?php else: ?>
          <?php if($this->uri->segment(1) != "users" && $this->uri->segment(2) != "login"): ?>
            <li><a href="<?php echo base_url().'users/login' ?>" id="mustLogin">Login</a></li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>