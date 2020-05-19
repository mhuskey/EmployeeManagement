<?php
  require_once('../../../private/initialize.php');
?>

<?php $page_title = 'Create Employee Department'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="main">
      <h1>Create Employee Department</h1>
      <a class="back-link" href="<?php echo url_for('/staff/employee_departments/index.php'); ?>">&laquo; Back to List</a>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
