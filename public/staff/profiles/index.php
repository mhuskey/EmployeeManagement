<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  $profile_set = find_all_profiles();
?>

<?php $page_title = 'All Employee Profiles'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1 class="text-center">Employee Profiles</h1>
                
                <table class="table table-striped table-bordered table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th class="text-center align-middle">ID</th>
                      <th class="text-center align-middle">First Name</th>
                      <th class="text-center align-middle">Last Name</th>
                      <th class="text-center align-middle">Department Name</th>
                      <th class="text-center align-middle">Status</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php while ($profile = mysqli_fetch_assoc($profile_set)) { ?>
                      <?php $department = find_department_by_id($profile['department_id']); ?>
                      <tr>
                        <td class="text-center"><?php echo h($profile['id']); ?></td>
                        <td class="text-center"><?php echo h($profile['first_name']); ?></td>
                        <td class="text-center"><?php echo h($profile['last_name']); ?></td>
                        <td class="text-center"><?php echo h($department['department_name']); ?></td>
                        <td class="text-center">
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
                        </td>
                        <td class="text-center"><a href="<?php echo url_for('/staff/profiles/show.php?id=' . h(u($profile['id']))); ?>">View</a></td>
                        <td class="text-center"><a href="<?php echo url_for('/staff/profiles/edit.php?id=' . h(u($profile['id']))); ?>">Edit</a></td>
                        <td class="text-center"><a href="<?php echo url_for('/staff/profiles/delete.php?id=' . h(u($profile['id']))); ?>">Delete</a></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                
                <?php
                  mysqli_free_result($profile_set);
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
