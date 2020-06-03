<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Employee Management <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/44ea90186f.js" crossorigin="anonymous"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" media="all" href="<?php echo url_for('/assets/stylesheets/main.css'); ?>" />
  </head>
  
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="<?php echo url_for('/staff/index.php'); ?>">Employee Managment</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link link" href="<?php echo url_for('/staff/login.php'); ?>">User: <?php echo $_SESSION['username'] ?? ''; ?></a>
          <div class="dropdown-divider"></div>
          <a class="nav-item nav-link" href="<?php echo url_for('/staff/departments/index.php'); ?>">Departments</a>
          <a class="nav-item nav-link" href="<?php echo url_for('/staff/profiles/index.php'); ?>">Profiles</a>
          <a class="nav-item nav-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">Admins</a>
          <div class="dropdown-divider"></div>
          <a class="nav-item nav-link" href="<?php echo url_for('/staff/logout.php'); ?>">Logout</a>
        </div>
      </div>
    </nav>
    
    <div class="container">
      <div class="row">
        <div class="col-sm-10 offset-sm-1 text-center message">
          <?php echo display_session_message(); ?>
        </div>
      </div>
    </div>
    