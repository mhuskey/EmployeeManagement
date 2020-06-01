<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  $id = $_GET['id'] ?? '1';
  
  $department  = find_department_by_id($id);
  $active_profile_set = find_active_profiles_by_department_id($id);
  $inactive_profile_set = find_inactive_profiles_by_department_id($id);
?>

<?php $page_title = 'Show Department'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Department: <?php echo h($department['department_name']); ?></h1>
                
                <a href="<?php echo url_for('/staff/departments/delete.php?id=' . h(u($department['id']))); ?>"><button type="button" class="btn btn-outline-danger">Delete</button></a>
                <a href="<?php echo url_for('/staff/departments/edit.php?id=' . h(u($department['id']))); ?>"><button type="button" class="btn btn-outline-primary">Edit</button></a>
                
                <dl>
                  <dt>Department Name</dt>
                  <dd><?php echo h($department['department_name']); ?></dd>
                </dl>
                
                <dl>
                  <dt>Position</dt>
                  <dd><?php echo h($department['position']); ?></dd>
                </dl>
                    
                <hr />
                
                <div>
                  <h2>Profiles</h2>
                  
                  <a href="<?php echo url_for('/staff/profiles/new.php?department_id=' . h(u($department['id']))); ?>">Create New Employee Profile</a><br /><br />
                  
                  <h3>Active Employees</h3>
                  
                  <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">First Name</th>
                        <th class="text-center">Last Name</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      <?php while ($profile = mysqli_fetch_assoc($active_profile_set)) { ?>
                        <tr>
                          <td class="text-center"><?php echo h($profile['id']); ?></td>
                          <td class="text-center"><?php echo h($profile['first_name']); ?></td>
                          <td class="text-center"><?php echo h($profile['last_name']); ?></td>
                          <td class="text-center"><a href="<?php echo url_for('/staff/profiles/show.php?id=' . h(u($profile['id']))); ?>">View</a></td>
                          <td class="text-center"><a href="<?php echo url_for('/staff/profiles/edit.php?id=' . h(u($profile['id']))); ?>">Edit</a></td>
                          <td class="text-center"><a href="<?php echo url_for('/staff/profiles/delete.php?id=' . h(u($profile['id']))); ?>">Delete</a></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  
                  <?php if($inactive_profile_set) { ?>
                    <h3>Inactive Employees</h3>
                    
                    <table class="table table-striped table-bordered table-hover">
                      <thead class="thead-dark">
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">First Name</th>
                          <th class="text-center">Last Name</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        <?php while ($profile = mysqli_fetch_assoc($inactive_profile_set)) { ?>
                          <tr>
                            <td class="text-center"><?php echo h($profile['id']); ?></td>
                            <td class="text-center"><?php echo h($profile['first_name']); ?></td>
                            <td class="text-center"><?php echo h($profile['last_name']); ?></td>
                            <td class="text-center"><a href="<?php echo url_for('/staff/profiles/show.php?id=' . h(u($profile['id']))); ?>">View</a></td>
                            <td class="text-center"><a href="<?php echo url_for('/staff/profiles/edit.php?id=' . h(u($profile['id']))); ?>">Edit</a></td>
                            <td class="text-center"><a href="<?php echo url_for('/staff/profiles/delete.php?id=' . h(u($profile['id']))); ?>">Delete</a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  <?php } ?>
                  
                  <?php
                    mysqli_free_result($active_profile_set);
                    if($inactive_profile_set) {
                      mysqli_free_result($inactive_profile_set);
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
