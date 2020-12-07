<?php
  function url_for($script_path) {
    // add the leading '/' if not present
    if($script_path[0] != '/') {
      $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
  }
  
  function u($string="") {
    return urlencode($string);
  }
  
  function raw_u($string="") {
    return rawurlencode($string);
  }
  
  function h($string="") {
    return htmlspecialchars($string);
  }
  
  function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }
  
  function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }
  
  function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
  }
  
  function display_errors($errors = array()) {
    $output = '';
    
    if(!empty($errors)) {
      $output .= '<div class="alert alert-danger" id="message" role="alert">';
      $output .= '<h5 class="alert-heading">Please fix the following errors:</h5>';
      $output .= '<ul>';
      
      foreach ($errors as $error) {
        $output .= "<li>" . h($error) . "</li>";
      }
      
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
  }
  
  function get_and_clear_session_message() {
    if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
      $msg = $_SESSION['message'];
      unset($_SESSION['message']);
      return $msg;
    }
  }
  
  function display_session_message() {
    $msg = get_and_clear_session_message();
    if(!is_blank($msg)) {
      return '<div class="alert alert-success alert-dismissible fade show" id="message" role="alert">' . h($msg) .
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    }
  }
?>
