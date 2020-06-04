<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  $id = $_GET['id'] ?? '1';
  
  $profile    = find_profile_by_id($id);
  $department = find_department_by_id($profile['department_id']);
?>

<?php $page_title = 'Show Profile'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1 text-center">
                <h1>Profile: <?php echo h($profile['first_name']) . ' ' . h($profile['last_name']); ?></h1>
                
                <!-- Profile Card -->
                <div class="col-sm-10 offset-sm-1">
                  <div class="card border-dark mb-3 text-center">
                    <h5 class="card-header">Employee ID</h5>
                    <div class="card-body">
                      <h5 class="card-text"><?php echo h($profile['id']); ?></h5>
                    </div>
                    
                    <h5 class="card-header">First Name</h5>
                    <div class="card-body">
                      <h5 class="card-text"><?php echo h($profile['first_name']); ?></h5>
                    </div>
                    
                    <h5 class="card-header">Last Name</h5>
                    <div class="card-body">
                      <h5 class="card-text"><?php echo h($profile['last_name']); ?></h5>
                    </div>
                    
                    <h5 class="card-header">Department Name</h5>
                    <div class="card-body">
                      <h5 class="card-text"><?php echo h($department['department_name']); ?></h5>
                    </div>
                    
                    <h5 class="card-header">Employment Status</h5>
                    <div class="card-body">
                      <h5 class="card-text">
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
                      </h5>
                    </div>
                  </div>
                </div>
                <br />
                
                <!-- Delete & Edit Buttons -->
                <a href="<?php echo url_for('/staff/profiles/delete.php?id=' . h(u($profile['id']))); ?>"><button type="button" class="btn btn-outline-danger">Delete</button></a>
                <a href="<?php echo url_for('/staff/profiles/edit.php?id=' . h(u($profile['id']))); ?>"><button type="button" class="btn btn-outline-primary">Edit</button></a>
                <br /><br />
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
