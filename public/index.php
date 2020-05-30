<?php
  require_once('../private/initialize.php');
?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

    <div id="main">
      <h1>Employee Management</h1>
      
      <h2><a class="action" href="<?php echo url_for('/staff/login.php'); ?>">Sign In</a></h2>
      <h2>Not a member? <a class="action" href="<?php echo url_for('/staff/signup.php'); ?>">Sign up here</a>.</h2>
    </div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
