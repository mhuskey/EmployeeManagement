<?php
  if(!isset($page_title)) {
    $page_title = 'Staff Area';
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Employee Management - <?php echo $page_title ?></title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('/assets/stylesheets/staff.css'); ?>">
  </head>
  
  <body>
    <header>
      <h1>Employee Management Staff Area</h1>
    </header>
    
    <?php echo display_session_message(); ?>
    