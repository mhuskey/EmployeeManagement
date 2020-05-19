<?php
  require_once('../../../private/initialize.php');
  
  $department_set = find_all_employee_departments();
?>

<?php $page_title = 'Employee Departments'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="main">
      <h1>Employee Departments</h1>
      <a class="back-link" href="<?php echo url_for('/index.php'); ?>">&laquo; Back to Employee Management Index</a><br /><br />
      
      <div class="actions">
        <a class="action" href="<?php echo url_for('/staff/employee_departments/new.php'); ?>">Create New Department</a>
      </div>
      
      <table class="list">
        <tr>
          <th>ID</th>
          <th>Department Name</th>
          <th>Position</th>
          <th>Employees</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
        
        <?php while ($department = mysqli_fetch_assoc($department_set)) { ?>
          <?php $employee_count = count_employee_profiles_by_department_id($department['id']); ?>
          <tr>
            <td><?php echo h($department['id']); ?></td>
            <td><?php echo h($department['department_name']); ?></td>
            <td><?php echo h($department['position']); ?></td>
            <td><?php echo $employee_count; ?></td>
            <td><a class="action" href="<?php echo url_for('/staff/employee_departments/show.php?id=' . h(u($department['id']))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/employee_departments/edit.php?id=' . h(u($department['id']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/employee_departments/delete.php?id=' . h(u($department['id']))); ?>">Delete</a></td>
          </tr>
        <?php } ?>
      </table>
      
      <?php
        mysqli_free_result($department_set);
      ?>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
