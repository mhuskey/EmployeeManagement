<?php
  require_once('../../../private/initialize.php');
  
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

    <div id="main">
      <a class="back-link" href="<?php echo url_for('/staff/departments/index.php'); ?>">&laquo; Back to Employee Departments</a>
      
      <h1>Create Employee Department</h1>
      
      <?php echo display_errors($errors); ?>
      
      <form action="<?php echo url_for('/staff/departments/new.php') ?>" method="post">
        <dl>
          <dt>Menu Name</dt>
          <dd><input type="text" name="department_name" value="" /></dd>
        </dl>
        
        <dl>
          <dt>Position</dt>
          <dd>
            <select name="position">
              <?php
                for ($i = 1; $i <= $department_count; $i++) { 
                  echo "<option value=\"{$i}\"";
                  if($department['position'] == $i) {
                    echo " selected";
                  }
                  echo ">{$i}</option>";
                }
              ?>
            </select>
          </dd>
        </dl>
        
        <div>
          <input type="submit" value="Create Department">
        </div>
      </form>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
