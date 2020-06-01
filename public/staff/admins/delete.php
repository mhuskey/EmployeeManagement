<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/admins/index.php'));
  }
  $id = $_GET['id'];
  
  if(is_post_request()) {
    $result = delete_admin($id);
    $_SESSION['message'] = 'The admin was deleted successfully.';
    redirect_to(url_for('/staff/admins/index.php'));
  } else {
    $admin = find_admin_by_id($id);
  }
?>

<?php $page_title = 'Delete Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Delete Admin</h1>
                
                <p>Are you sure you want to delete this admin?</p>
                
                <p><?php echo h($admin['first_name'] . ' ' . $admin['last_name']); ?></p>
                
                <form action="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>" method="post">
                  <a href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($admin['id']))); ?>"><button type="button" class="btn btn-secondary no-left-margin">Cancel</button></a>
                  <button type="submit" class="btn btn-danger" name="commit">Delete Admin</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
