<?php
  require_once('../../../private/initialize.php');
  
  $id = $_GET['id'] ?? '1';
  
  $profile    = find_profile_by_id($id);
  $department = find_department_by_id($profile['department_id']);
?>

<?php $page_title = 'Show Profile'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="main">
      <a class="back-link" href="<?php echo url_for('/staff/departments/show.php?id=' . h(u($department['id']))); ?>">&laquo; Back to Employee Department</a>
      
      <h1>Profile: <?php echo h($profile['first_name']) . ' ' . h($profile['last_name']); ?></h1>
      
      <dl>
        <dt>First Name</dt>
        <dd><?php echo $profile['first_name']; ?></dd>
      </dl>
      
      <dl>
        <dt>Last Name</dt>
        <dd><?php echo $profile['last_name']; ?></dd>
      </dl>
      
      <dl>
        <dt>Department</dt>
        <dd><?php echo $department['department_name']; ?></dd>
      </dl>
      
      <dl>
        <dt>Employee Number</dt>
        <dd><?php echo $profile['employee_number']; ?></dd>
      </dl>
      
      <dl>
        <dt>Employment Status</dt>
        <dd>
          <?php
            if($profile['status'] == 1) {
              echo 'Active';
            } elseif ($profile['status'] == 2) {
              echo 'Resigned';
            } elseif ($profile['status'] == 3) {
              echo 'Terminated';
            } else {
              echo 'Leave of Absence';
            }
          ?>
        </dd>
      </dl>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
