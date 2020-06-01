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
          $_SESSION['message'] = 'Login successful!';
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

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Log In</h1>
                
                <?php echo display_errors($errors); ?>
                
                <form action="login.php" method="post">
                  <div class="form-group">
                    <label for="loginInputUsername">Username</label>
                    <input type="text" class="form-control" name="username" autofocus />
                  </div>
                  
                  <div class="form-group">
                    <label for="loginInputPassword">Password</label>
                    <input type="password" class="form-control" name="password" />
                  </div>
                  
                  <button type="submit" class="btn btn-primary no-margin">Log In</button><br /><br />
                </form>
                
                <p>Not a member? <a href="<?php echo url_for('/staff/signup.php'); ?>">Sign up here</a>.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
