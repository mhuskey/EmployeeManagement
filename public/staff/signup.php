<?php
  require_once('../../private/initialize.php');
  
  if(is_post_request()) {
    $admin = [];
    $admin['first_name']       = $_POST['first_name'] ?? '';
    $admin['last_name']        = $_POST['last_name'] ?? '';
    $admin['email']            = $_POST['email'] ?? '';
    $admin['username']         = $_POST['username'] ?? '';
    $admin['password']         = $_POST['password'] ?? '';
    $admin['confirm_password'] = $_POST['confirm_password'] ?? '';
    
    // Log out in case alreay logged in
    log_out_admin();
  
    $result = insert_admin($admin);
    if($result === true) {
      $admin['id'] = mysqli_insert_id($db);
      log_in_admin($admin);
      $_SESSION['message'] = 'Sign up successful!';
      redirect_to(url_for('/staff/index.php'));
    } else {
      $errors = $result;
    }
    
  } else {
    // display the blank form
    $admin = [];
    $admin['first_name']         = '';
    $admin['last_name']          = '';
    $admin['email']              = '';
    $admin['username']           = '';
    $admin['password']           = '';
    $admin['confirm_password']   = '';
  }
?>

<?php $page_title = 'Sign Up'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Sign Up</h1>
                
                <?php echo display_errors($errors); ?>
                
                <form action="<?php echo url_for('/staff/signup.php'); ?>" method="post">
                  <div class="form-group">
                    <label for="inputFirstName">First Name</label>
                    <input type="text" class="form-control" name="first_name" autofocus />
                  </div>
                  
                  <div class="form-group">
                    <label for="inputLastName">Last Name</label>
                    <input type="text" class="form-control" name="last_name" />
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail">Email Address</label>
                    <input type="email" class="form-control" name="email" />
                  </div>
                  
                  <div class="form-group">
                    <label for="inputUsername">Username</label>
                    <input type="text" class="form-control" name="username" />
                  </div>
                  
                  <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" name="password" />
                  </div>
                  
                  <div class="form-group">
                    <label for="inputPassword">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" />
                  </div>
                  
                  <p>
                    Passwords must be at least 6 characters, and include at least one uppercase letter, lowercase letter, number, and symbol.
                  </p>
                  <br />
                  
                  <button type="submit" class="btn btn-primary no-margin">Sign Up</button>
                </form>
                
                <br />
                <p>Already a member? <a href="<?php echo url_for('/staff/login.php'); ?>">Log in here</a>.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
