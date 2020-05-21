gihut
<?php
  require_once('../../../private/initialize.php');
  
  if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/departments/index.php'));
  }
  $id = $_GET['id'];
  
  if(is_post_request()) {
    $result = delete_department($id);
    $_SESSION['message'] = 'The department was deleted successfully.';
    redirect_to(url_for('/staff/departments/index.php'));
  } else {
    $department = find_department_by_id($id);
  }
?>

<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="main">
      <a href="<?php echo url_for('/staff/departments/index.php'); ?>" >&laquo; Back to List</a>
      
      <h1>Delete Department</h1>
      
      <p>Are you sure you want to delete this department?</p>
      
      <p><?php echo h($department['department_name']); ?></p>
      
      <form action="<?php echo url_for('/staff/departments/delete.php?id=' . h(u($department['id']))); ?>" method="post">
        <input type="submit" value="Delete Department" />
      </form>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
