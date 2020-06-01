<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  if(is_post_request()) {
    $admin = [];
    $admin['first_name']       = $_POST['first_name'] ?? '';
    $admin['last_name']        = $_POST['last_name'] ?? '';
    $admin['email']            = $_POST['email'] ?? '';
    $admin['username']         = $_POST['username'] ?? '';
    $admin['password']         = $_POST['password'] ?? '';
    $admin['confirm_password'] = $_POST['confirm_password'] ?? '';
  
    $result = insert_admin($admin);
    if($result === true) {
      $new_id = mysqli_insert_id($db);
      $_SESSION['message'] = 'The admin was created successfully.';
      redirect_to(url_for('/staff/admins/show.php?id=' . $new_id));
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

<?php $page_title = 'Create Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Create Admin</h1>
                
                <?php echo display_errors($errors); ?>
                
                <form action="<?php echo url_for('/staff/admins/new.php'); ?>" method="post">
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
                  
                  <button type="submit" class="btn btn-primary no-left-margin">Create Admin</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
