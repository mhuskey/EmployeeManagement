<?php
  require_once('../../../private/initialize.php');
  
  $department_set   = find_all_departments();
  $department_count = mysqli_num_rows($department_set) + 1;
  
  if(is_post_request()) {
    $department = [];
    $department['department_name'] = $_POST['department_name'];
    $department['position']        = $_POST['position'];
    
    
  }
?>

<?php $page_title = 'Create Employee Department'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="main">
      <h1>Create Employee Department</h1>
      <a class="back-link" href="<?php echo url_for('/staff/departments/index.php'); ?>">&laquo; Back to List</a>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
