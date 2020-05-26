<?php
  require_once('../../../private/initialize.php');
  
  if(is_post_request()) {
    $profiles = [];
    $profiles['department_id'] = $_POST['department_id'] ?? '';
    $profiles['first_name']    = $_POST['first_name']    ?? '';
    $profiles['last_name']     = $_POST['last_name']     ?? '';
    $profiles['status']        = $_POST['status']        ?? '';
  }
?>
