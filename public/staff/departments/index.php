<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  $department_set = find_all_departments();
?>

<?php $page_title = 'Employee Departments'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="main">
      <h1>Employee Departments</h1>
      
      <div class="actions">
        <a class="action" href="<?php echo url_for('/staff/departments/new.php'); ?>">Create New Department</a>
      </div>
      
      <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th class="text-center">Position</th>
            <th class="text-center">Department Name</th>
            <th class="text-center">Employees</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        
        <tbody>
          <?php while ($department = mysqli_fetch_assoc($department_set)) { ?>
            <?php $employee_count = count_active_profiles_by_department_id($department['id']); ?>
            <tr>
              <td class="text-center"><?php echo h($department['position']); ?></td>
              <td class="text-center"><?php echo h($department['department_name']); ?></td>
              <td class="text-center"><?php echo $employee_count; ?></td>
              <td class="text-center"><a class="action" href="<?php echo url_for('/staff/departments/show.php?id=' . h(u($department['id']))); ?>">View</a></td>
              <td class="text-center"><a class="action" href="<?php echo url_for('/staff/departments/edit.php?id=' . h(u($department['id']))); ?>">Edit</a></td>
              <td class="text-center"><a class="action" href="<?php echo url_for('/staff/departments/delete.php?id=' . h(u($department['id']))); ?>">Delete</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      
      <?php
        mysqli_free_result($department_set);
      ?>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
