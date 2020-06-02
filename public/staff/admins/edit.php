<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/admins/index.php'));
  }
  $id = $_GET['id'];
  
  if(is_post_request()) {
    $admin                     = [];
    $admin['id']               = $id;
    $admin['first_name']       = $_POST['first_name']         ?? '';
    $admin['last_name']        = $_POST['last_name']          ?? '';
    $admin['email']            = $_POST['email']              ?? '';
    $admin['username']         = $_POST['username']           ?? '';
    $admin['password']         = $_POST['password']           ?? '';
    $admin['confirm_password'] = $_POST['confirm_password']   ?? '';
    
    $result = update_admin($admin);
    if($result) {
      $_SESSION['message'] = 'The admin was updated succesfully.';
      redirect_to(url_for('/staff/admins/show.php?id=' . $id));
    } else {
      $errors = $result;
    }
    
  } else {
    $admin = find_admin_by_id($id);
  }
?>

<?php $page_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Edit Admin</h1>
                
                <?php echo display_errors($errors); ?>
                
                <form action="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($id))); ?>" method="post">
                  <div class="form-group">
                    <label for="inputFirstName">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="<?php echo h($admin['first_name']); ?>" />
                  </div>
                    
                  <div class="form-group">
                    <label for="inputLastName">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="<?php echo h($admin['last_name']); ?>" />
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail">Email Address</label>
                    <input type="email" class="form-control" name="email" value="<?php echo h($admin['email']); ?>" />
                  </div>
                  
                  <div class="form-group">
                    <label for="inputUsername">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo h($admin['username']); ?>" />
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
                  
                  <a href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($admin['id']))); ?>"><button type="button" class="btn btn-secondary no-left-margin">Cancel</button></a>
                  <button type="submit" class="btn btn-primary">Edit Admin</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
