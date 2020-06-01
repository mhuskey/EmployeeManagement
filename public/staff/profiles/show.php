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
              <div class="col-sm-10 offset-sm-1">
                <h1>Profile: <?php echo h($profile['first_name']) . ' ' . h($profile['last_name']); ?></h1>
                
                <a href="<?php echo url_for('/staff/profiles/delete.php?id=' . h(u($profile['id']))); ?>"><button type="button" class="btn btn-outline-danger">Delete</button></a>
                <a href="<?php echo url_for('/staff/profiles/edit.php?id=' . h(u($profile['id']))); ?>"><button type="button" class="btn btn-outline-primary">Edit</button></a>
                
                <dl>
                  <dt>Employee ID</dt>
                  <dd><?php echo $profile['id']; ?></dd>
                </dl>
                
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
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
