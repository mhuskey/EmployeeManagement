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

    <div id="main">
      
      <h1>Delete Admin</h1>
      
      <p>Are you sure you want to delete this admin?</p>
      
      <p><?php echo h($admin['first_name'] . ' ' . $admin['last_name']); ?></p>
      
      <form action="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>" method="post">
        <input type="submit" name="commit" value="Delete Admin" />
      </form>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
