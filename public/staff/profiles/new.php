<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  if(is_post_request()) {
    $profile = [];
    $profile['department_id'] = $_POST['department_id'] ?? '';
    $profile['first_name']    = $_POST['first_name']    ?? '';
    $profile['last_name']     = $_POST['last_name']     ?? '';
    $profile['status']        = $_POST['status']        ?? '';
    
    $result = insert_profile($profile);
    if($result === true) {
      $new_id = mysqli_insert_id($db);
      $_SESSION['message'] = 'The profile was created successfully.';
      redirect_to(url_for('/staff/profiles/show.php?id=' . $new_id));
    } else {
      $errors = $result;
    }
    
  } else {
    // Display the blank form
    $profile = [];
    $profile['department_id'] = $_GET['department_id'] ?? '1';
    $profile['first_name']    = '';
    $profile['last_name']     = '';
    $profile['status']        = '';
  }
?>

<?php $page_title = 'Create Employee Profile'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Create Employee Profile</h1>
                
                <?php echo display_errors($errors); ?>
                
                <form action="<?php echo url_for('/staff/profiles/new.php'); ?>" method="post">
                  <div class="form-group">
                    <label for="inputFirstName">First Name</label>
                    <input type="text" class="form-control" name="first_name" autofocus />
                  </div>
                    
                  <div class="form-group">
                    <label for="inputLastName">Last Name</label>
                    <input type="text" class="form-control" name="last_name" />
                  </div>
                  
                  <div class="form-group">
                    <label for="selectDepartment">Department</label>
                    <select class="custom-select" name="department_id">
                    <?php
                      $department_set = find_all_departments();
                      while($department = mysqli_fetch_assoc($department_set)) {
                        echo "<option value=\"" . h($department['id']) . "\"";
                        if($profile['department_id'] == $department['id']) {
                          echo " selected";
                        }
                        echo ">" . h($department['department_name']) . "</option>";
                      }
                      mysqli_free_result($department_set);
                    ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="selectEmploymentStatus">Employment Status</label>
                    <select class="custom-select" name="status">
                    <?php
                      for($i = 1; $i <= 4; $i++) {
                        echo "<option value=\"{$i}\"";
                        if($profile['status'] == $i) {
                          echo " selected";
                        }
                        if($i == 1) {
                          echo ">Active</option>";
                        } elseif($i == 2) {
                          echo ">Resigned</option>";
                        } elseif($i == 3) {
                          echo ">Terminated</option>";
                        } elseif($i == 4) {
                          echo ">Leave of Absence</option>";
                        }
                      }
                    ?>
                    </select>
                  </div>
                  
                  <div>
                    <button type="submit" class="btn btn-primary no-margin">Create Profile</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
