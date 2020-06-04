<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  $department_set = find_all_departments();
?>

<?php $page_title = 'Employee Departments'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1 text-center align-middle">
                <h1>Employee Departments</h1>
                
                <div>
                  <a href="<?php echo url_for('/staff/departments/new.php'); ?>"><button type="button" class="btn btn-primary no-margin">Create Department</button></a>
                </div>
                
                <table class="table table-striped table-bordered table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th class="text-center align-middle">Position</th>
                      <th class="text-center align-middle">Department Name</th>
                      <th class="text-center align-middle">Employees</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php while ($department = mysqli_fetch_assoc($department_set)) { ?>
                      <?php $employee_count = count_active_profiles_by_department_id($department['id']); ?>
                      <tr>
                        <td class="text-center align-middle"><?php echo h($department['position']); ?></td>
                        <td class="text-center align-middle"><?php echo h($department['department_name']); ?></td>
                        <td class="text-center align-middle"><?php echo $employee_count; ?></td>
                        <td class="text-center align-middle"><a class="action" href="<?php echo url_for('/staff/departments/show.php?id=' . h(u($department['id']))); ?>"><button type="button" class="btn btn-info no-margin">View</button></a></td>
                        <td class="text-center align-middle"><a class="action" href="<?php echo url_for('/staff/departments/edit.php?id=' . h(u($department['id']))); ?>"><button type="button" class="btn btn-primary no-margin">Edit</button></a></td>
                        <td class="text-center align-middle"><a class="action" href="<?php echo url_for('/staff/departments/delete.php?id=' . h(u($department['id']))); ?>"><button type="button" class="btn btn-danger no-margin">Delete</button></a></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                
                <?php
                  mysqli_free_result($department_set);
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
