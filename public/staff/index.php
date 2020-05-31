<?php require_once('../../private/initialize.php'); ?>

<?php require_login(); ?>

<?php $page_title = 'Staff Menu'; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>
  
  <div id="main">
    <h1>Employee Management Staff Area</h1>
    
    <h2><a class="action" href="<?php echo url_for('/staff/admins/index.php'); ?>">Admins</a></h2>
    
    <h2><a class="action" href="<?php echo url_for('/staff/departments/index.php'); ?>">Employee Departments</a></h2>
  </div>
  
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
