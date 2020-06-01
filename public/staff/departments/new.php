<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  $department_set   = find_all_departments();
  $department_count = mysqli_num_rows($department_set) + 1;
  
  mysqli_free_result($department_set);
  
  if(is_post_request()) {
    $department = [];
    $department['department_name'] = $_POST['department_name'] ?? '';
    $department['position']        = $_POST['position']        ?? '';
    
    $result = insert_department($department);
    if($result === true) {
      $new_id = mysqli_insert_id($db);
      $_SESSION['message'] = 'The department was created successfully.';
      redirect_to(url_for('/staff/departments/show.php?id=' . $new_id));
    } else {
      $errors = $result;
    }
    
  } else {
    // Display the blank form
    $department = [];
    $department['department_name'] = '';
    $department['position']        = $department_count;
  }
?>

<?php $page_title = 'Create Employee Department'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Create Employee Department</h1>
                
                <?php echo display_errors($errors); ?>
                
                <form action="<?php echo url_for('/staff/departments/new.php'); ?>" method="post">
                  <div class="form-group">
                    <label for="inputDepartmentName">Department Name</label>
                    <input type="text" class="form-control" name="department_name" autofocus />
                  </div>
                  
                  <div class="form-group">
                    <label for="selectPosition">Position</label>
                    <select class="custom-select" name="position">
                      <?php
                        for($i = 1; $i <= $department_count; $i++) {
                          echo "<option value=\"{$i}\"";
                          if($department["position"] == $i) {
                            echo " selected";
                          }
                          echo ">{$i}</option>";
                        }
                      ?>
                    </select>
                  </div>
                  
                  <div>
                    <button type="submit" class="btn btn-primary no-margin">Create Department</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
