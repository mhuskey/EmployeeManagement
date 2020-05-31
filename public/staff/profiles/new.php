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

    <div id="main">
      
      <h1>Create Employee Profile</h1>
      
      <?php echo display_errors($errors); ?>
      
      <form action="<?php echo url_for('/staff/profiles/new.php'); ?>" method="post">
        <dl>
          <dt>First Name</dt>
          <dd><input type="text" name="first_name" value="<?php echo h($profile['first_name']); ?>" autofocus /></dd>
        </dl>
        
        <dl>
          <dt>Last Name</dt>
          <dd><input type="text" name="last_name" value="<?php echo h($profile['last_name']); ?>"></dd>
        </dl>
        
        <dl>
          <dt>Department</dt>
          <dd>
            <select name="department_id">
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
          </dd>
        </dl>
        
        <dl>
          <dt>Employment Status</dt>
          <dd>
            <select name="status">
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
          </dd>
        </dl>
        
        <div>
          <input type="submit" value="Create Profile">
        </div>
      </form>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
