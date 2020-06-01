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
              <div class="col-sm-10 offset-sm-1">
                <h1>Admin: <?php echo h($admin['username']); ?></h1>
                
                <a href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>"><button type="button" class="btn btn-outline-danger">Delete</button></a>
                <a href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin['id']))); ?>"><button type="button" class="btn btn-outline-primary">Edit</button></a>
                
                <dl>
                  <dt>First Name</dt>
                  <dd><?php echo h($admin['first_name']); ?></dd>
                </dl>
                
                <dl>
                  <dt>Lase Name</dt>
                  <dd><?php echo h($admin['last_name']); ?></dd>
                </dl>
                
                <dl>
                  <dt>Email Address</dt>
                  <dd><?php echo h($admin['email']); ?></dd>
                </dl>
                
                <dl>
                  <dt>Username</dt>
                  <dd><?php echo h($admin['username']); ?></dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
