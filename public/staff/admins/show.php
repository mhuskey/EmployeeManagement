<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  $id = $_GET['id'];
  
  $admin = find_admin_by_id($id);
?>

<?php $page_title = 'Show Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1 text-center">
                <h1>Admin: <?php echo h($admin['username']); ?></h1>
                
                <!-- Admin Card -->
                <div class="col-sm-10 offset-sm-1">
                  <div class="card border-dark mb-3 text-center">
                    <h5 class="card-header">First Name</h5>
                    <div class="card-body">
                      <h5 class="card-text"><?php echo h($admin['first_name']); ?></h5>
                    </div>
                    
                    <h5 class="card-header">Last Name</h5>
                    <div class="card-body">
                      <h5 class="card-text"><?php echo h($admin['last_name']); ?></h5>
                    </div>
                    
                    <h5 class="card-header">Email Address</h5>
                    <div class="card-body">
                      <h5 class="card-text"><?php echo h($admin['email']); ?></h5>
                    </div>
                    
                    <h5 class="card-header">Username</h5>
                    <div class="card-body">
                      <h5 class="card-text"><?php echo h($admin['username']); ?></h5>
                    </div>
                  </div>
                </div>
                <br />
                
                <a href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>"><button type="button" class="btn btn-outline-danger">Delete</button></a>
                <a href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin['id']))); ?>"><button type="button" class="btn btn-outline-primary">Edit</button></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
