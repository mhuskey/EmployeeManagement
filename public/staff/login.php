<?php
  require_once('../../private/initialize.php');
  
  $errors = [];
  $username = '';
  $password = '';
  
  if(is_post_request()) {
    
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // username and password validations
    if(is_blank($username)) {
      $errors[] = "Username cannot be blank.";
    }
    if(is_blank($password)) {
      $errors[] = "Password cannot be blank.";
    }
    
    // If no errors, try to log in
    if(empty($errors)) {
      // Using one variable ensures message is same
      $login_failure_msg = "Username or password is incorrect.";
      
      $admin = find_admin_by_username($username);
      
      if($admin) {
        if(password_verify($password, $admin['hashed_password'])) {
          // password matches
          log_in_admin($admin);
          redirect_to(url_for('/staff/index.php'));
        } else {
          // username found, but password does not match
          $errors[] = $login_failure_msg;
        }
        
      } else {
        // no username found
        $errors[] = $login_failure_msg;
      }
    }
  }
?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">
  <h1>Log In</h1>
  
  <?php echo display_errors($errors); ?>
  
  <form action="login.php" method="post">
    Username:<br />
    <input type="text" name="username" value="<?php echo h($username); ?>" autofocus /><br /><br />
    
    Password:<br />
    <input type="password" name="password" value="" /><br /><br />
    
    <input type="submit" name="submit" value="Submit" /><br /><br />
  </form>
  
  <p>Not a member? <a href="<?php echo url_for('/staff/signup.php'); ?>">Sign up here</a>.</p>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
