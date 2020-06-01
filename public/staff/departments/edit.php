<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/departments/index.php'));
  }
  $id = $_GET['id'];
  
  if(is_post_request()) {
    $department                    = [];
    $department['id']              = $id;
    $department['department_name'] = $_POST['department_name'] ?? '';
    $department['position']        = $_POST['position']        ?? '';
    
    $result = update_department($department);
    if($result === true) {
      $_SESSION['message'] = 'The department was updated successfully.';
      redirect_to(url_for('/staff/departments/index.php'));
    } else {
      $errors = $result;
    }
    
  } else {
    $department = find_department_by_id($id);
  }
  
  $department_set   = find_all_departments();
  $department_count = mysqli_num_rows($department_set);
  mysqli_free_result($department_set);
?>

<?php $page_title = 'Delete Department'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Edit Department</h1>
                
                <?php echo display_errors($errors); ?>
                
                <form action="<?php echo url_for('staff/departments/edit.php?id=' . h(u($id))); ?>" method="post">
                  <dl>
                    <dt>Department Name</dt>
                    <dd><input type="text" name="department_name" value="<?php echo h($department['department_name']); ?>" /></dd>
                  </dl>
                  
                  <dl>
                    <dt>Position</dt>
                    <dd>
                      <select name="position">
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
                    </dd>
                  </dl>
                  
                  <a href="<?php echo url_for('/staff/departments/index.php?id=' . h(u($department['id']))); ?>"><button type="button" class="btn btn-secondary">Cancel</button></a>
                  <button type="submit" class="btn btn-primary">Edit Department</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
