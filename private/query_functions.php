<?php
  /* Admins
  -------------------------*/
  function find_all_admins() {
    global $db;
    
    $sql  = "SELECT * FROM admins ";
    // sorted last_name, then first_name
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }
  
  function find_admin_by_id($id) {
    global $db;
    
    $sql  = "SELECT * FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    
    // returns an associative array
    return $admin;
  }
  
  function find_admin_by_username($username) {
    global $db;
    
    $sql  = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    
    return $admin;
  }
  
  function validate_admin($admin, $options=[]) {
    $errors = [];
    
    $password_required = $options['password_required'] ?? true;
    
    // first_name
    if(is_blank($admin['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif(!has_length($admin['first_name'], ['min' => 1, 'max' => 255])) {
      $errors[] = "First name must be between 1 and 255 characters.";
    }
    
    // last_name
    if(is_blank($admin['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif(!has_length($admin['last_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }
    
    // email
    if(is_blank($admin['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif(!has_length($admin['email'], ['max' => 255])) {
      $errors[] = "Email must be less than 255 characters.";
    } elseif(!has_valid_email_format($admin['email'])) {
      $errors[] = "Email must be a valid format.";
    }
    
    // username
    if(is_blank($admin['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif(!has_length($admin['username'], ['min' => 5, 'max' => 255])) {
      $errors[] = "Username must be between 5 and 255 characters.";
    } elseif(!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
      $errors[] = "Username already in use. Try another.";
    }
    
    if($password_required) {
      // password
      if(is_blank($admin['password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif(!has_length($admin['password'], ['min' => 6])) {
        $errors[] = "Password must contain 6 or more characters.";
      } elseif(!preg_match('/[A-Z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter.";
      } elseif(!preg_match('/[a-z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter.";
      } elseif(!preg_match('/[0-9]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 number";
      } elseif(!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 symbol.";
      }
      
      // confirm_password
      if(is_blank($admin['confirm_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif($admin['password'] !== $admin['confirm_password']) {
        $errors[] = "Passwords do not match. Try again.";
      }
    }
    
    return $errors;
  }
  
  function insert_admin($admin) {
    global $db;
    
    $errors = validate_admin($admin);
    if(!empty($errors)) {
      return $errors;
    }
    
    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);
    
    $sql  = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['last_name'])  . "',";
    $sql .= "'" . db_escape($db, $admin['email'])      . "',";
    $sql .= "'" . db_escape($db, $admin['username'])   . "',";
    $sql .= "'" . db_escape($db, $hashed_password)     . "'";
    $sql .= ")";
    
    $result = mysqli_query($db, $sql);
    
    // For INSERT statements, $result is true or false
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function update_admin($admin) {
    global $db;
    
    $password_sent = !is_blank($admin['password']);
    
    $errors = validate_admin($admin, ['password_required' => $password_sent]);
    if(!empty($errors)) {
      return $errors;
    }
    
    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);
    
    $sql  = "UPDATE admins SET ";
    $sql .= "first_name='"        . db_escape($db, $admin['first_name']) . "', ";
    $sql .= "last_name='"         . db_escape($db, $admin['last_name'])  . "', ";
    $sql .= "email='"             . db_escape($db, $admin['email'])      . "', ";
    if($password_sent) {
      $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "username='"          . db_escape($db, $admin['username'])   . "' ";
    $sql .= "WHERE id='"          . db_escape($db, $admin['id'])         . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    
    // For UPDATE statements, $result is true or false
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function delete_admin($id) {
    global $db;
    
    $sql  = "DELETE FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    
    // For DELETE statements, $result is true or false
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  
  /* Employee Departments
  -------------------------*/
  function find_all_departments() {
    global $db;
    
    $sql  = "SELECT * FROM departments ";
    $sql .= "ORDER BY position ASC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }
  
  function find_department_by_id($id) {
    global $db;
    
    $sql  = "SELECT * FROM departments ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $department = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    
    // returns an associative array
    return $department;
  }
  
  function validate_department($department) {
    $errors = [];
    
    // department_name
    if(is_blank($department['department_name'])) {
      $errors[] = "Department Name cannot be blank.";
    } elseif(!has_length($department['department_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Department Name must be between 2 and 255 charcters.";
    }
    
    // position
    // Make sure we are working with an integer
    $position_int = (int)$department['position'];
    if($position_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($position_int > 999) {
      $errors[] = "Position must be less than 999.";
    }
    
    return $errors;
  }
  
  function insert_department($department) {
    global $db;
    
    $errors = validate_department($department);
    if(!empty($errors)) {
      return $errors;
    }
    
    shift_department_positions(0, $department['position']);
    
    $sql  = "INSERT INTO departments ";
    $sql .= "(department_name, position) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $department['department_name']) . "',";
    $sql .= "'" . db_escape($db, $department['position']) . "'";
    $sql .= ")";
    
    $result = mysqli_query($db, $sql);
    
    // For INSERT statements, $result is true or false
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function update_department($department) {
    global $db;
    
    $errors = validate_department($department);
    if(!empty($errors)) {
      return $errors;
    }
    
    $old_department = find_department_by_id($department['id']);
    $old_position   = $old_department['position'];
    shift_department_positions($old_position, $department['position'], $department['id']);
    
    $sql  = "UPDATE departments SET ";
    $sql .= "department_name='" . db_escape($db, $department['department_name']) . "', ";
    $sql .= "position='"        . db_escape($db, $department['position'])        . "' ";
    $sql .= "WHERE id='"        . db_escape($db, $department['id'])              . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    
    // For UPDATE statements, $result is true or false
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function delete_department($id) {
    global $db;
    
    $old_department = find_department_by_id($id);
    $old_position   = $old_department['position'];
    shift_department_positions($old_position, 0, $id);
    
    $sql  = "DELETE FROM departments ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    
    // For DELETE statements, $result is true or false
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function shift_department_positions($start_pos, $end_pos, $current_id=0) {
    global $db;
    
    if($start_pos == $end_pos) { return; }
    
    $sql = "UPDATE departments ";
    if($start_pos == 0) {
      // new item, +1 to items greater than $end_pos
      $sql .= "SET position = position + 1 ";
      $sql .= "WHERE position >= '" . db_escape($db, $end_pos) . "' ";
      
    } elseif($end_pos == 0) {
      // delete item, -1 from items greater than $start_pos
      $sql .= "SET position = position - 1 ";
      $sql .= "WHERE position > '" . db_escape($db, $start_pos) . "' ";
      
    } elseif($start_pos < $end_pos) {
      // move later, -1 from items between (including $end_pos)
      $sql .= "SET position = position - 1 ";
      $sql .= "WHERE position > '" . db_escape($db, $start_pos) . "' ";
      $sql .= "AND position <= '" . db_escape($db, $end_pos) . "' ";
      
    } elseif($start_pos > $end_pos) {
      // move earlier, +1 to items between (including $end_pos)
      $sql .= "SET position = position + 1 ";
      $sql .= "WHERE position >= '" . db_escape($db, $end_pos) . "' ";
      $sql .= "AND position < '" . db_escape($db, $start_pos) . "' ";
    }
    
    // Exclude the current_id in the SQL WHERE clause
    $sql .= "AND id != '" . db_escape($db, $current_id) . "' ";

    $result = mysqli_query($db, $sql);
    
    // For UPDATE statements, $result is true or false
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  
  /* Employee Profiles
  -------------------------*/
  function find_all_profiles() {
    global $db;
    
    $sql  = "SELECT * FROM profiles ";
    $sql .= "ORDER BY department_id ASC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }
  
  function find_profile_by_id($id) {
    global $db;
    
    $sql  = "SELECT * FROM profiles ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $profile = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    
    // returns an associative array
    return $profile;
  }
  
  function validate_profile($profile) {
    $errors = [];
    
    // department_id
    if(is_blank($profile['department_id'])) {
      $errors[] = "Department cannot be blank.";
    }
    
    // first_name
    if(is_blank($profile['first_name'])) {
      $errors[] = "First Name cannot be blank.";
    } elseif(!has_length($profile['first_name'], ['min' => 1, 'max' => 100])) {
      $errors[] = "First Name must be between 1 and 100 characters.";
    }
    
    // last_name
    if(is_blank($profile['last_name'])) {
      $errors[] = "Last Name cannot be blank.";
    } elseif(!has_length($profile['last_name'], ['min' => 2, 'max' => 100])) {
      $errors[] = "Last Name must be between 2 and 100 characters.";
    }
    
    // status
    // Make sure we are working with an integer
    $status_int = (int)$profile['status'];
    if($status_int <= 0) {
      $errors[] = "Status must be greater than zero.";
    }
    if($status_int > 99) {
      $errors[] = "Status must be less than 99.";
    }
    if(is_blank($profile['status'])) {
      $errors[] = "Status cannot be blank.";
    }
    
    return $errors;
  }
  
  function insert_profile($profile) {
    global $db;
    
    $errors = validate_profile($profile);
    if(!empty($errors)) {
      return $errors;
    }
    
    $sql  = "INSERT INTO profiles ";
    $sql .= "(department_id, first_name, last_name, status) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $profile['department_id'])   . "', ";
    $sql .= "'" . db_escape($db, $profile['first_name'])      . "', ";
    $sql .= "'" . db_escape($db, $profile['last_name'])       . "', ";
    $sql .= "'" . db_escape($db, $profile['status'])          . "'";
    $sql .= ")";
    
    $result = mysqli_query($db, $sql);
    
    // For INSERT statements, $result is true or false
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function update_profile($profile) {
    global $db;
    
    $errors = validate_profile($profile);
    if(!empty($errors)) {
      return $errors;
    }
    
    $sql  = "UPDATE profiles SET ";
    $sql .= "department_id='"   . db_escape($db, $profile['department_id'])   . "', ";
    $sql .= "first_name='"      . db_escape($db, $profile['first_name'])      . "', ";
    $sql .= "last_name='"       . db_escape($db, $profile['last_name'])       . "', ";
    $sql .= "status='"          . db_escape($db, $profile['status'])          . "' ";
    $sql .= "WHERE id='"        . db_escape($db, $profile['id'])              . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    
    // For UPDATE statements, $result is true or false
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function delete_profile($id) {
    global $db;
    
    $sql  = "DELETE FROM profiles ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    
    // For DELETE statements, $result is true or false
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function find_profiles_by_department_id($department_id) {
    global $db;
    
    $sql  = "SELECT * FROM profiles ";
    $sql .= "WHERE department_id='" . db_escape($db, $department_id) . "' ";
    $sql .= "ORDER BY id";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }
  
  function find_active_profiles_by_department_id($department_id) {
    global $db;
    
    $sql  = "SELECT * FROM profiles ";
    $sql .= "WHERE department_id='" . db_escape($db, $department_id) . "' ";
    $sql .= "AND status = 1 ";
    $sql .= "ORDER BY id";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }
  
  function find_inactive_profiles_by_department_id($department_id) {
    global $db;
    
    $sql  = "SELECT * FROM profiles ";
    $sql .= "WHERE department_id='" . db_escape($db, $department_id) . "' ";
    $sql .= "AND NOT status = 1 ";
    $sql .= "ORDER BY id";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    // Check for inactive profiles
    $row_count = mysqli_num_rows($result);
    if($row_count == 0) {
      $empty = true;
    } else {
      $empty = false;
    }
    
    // If no inactive profiles, return `false`
    if($empty) {
      return false;
    } else {
      return $result;
    }
  }
  
  function count_profiles_by_department_id($department_id) {
    global $db;
    
    $sql  = "SELECT COUNT(id) FROM profiles ";
    $sql .= "WHERE department_id='" . db_escape($db, $department_id) . "' ";
    $sql .= "ORDER BY id ASC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $row = mysqli_fetch_row($result);
    mysqli_free_result($result);
    
    $count = $row[0];
    
    return $count;
  }
  
  function count_active_profiles_by_department_id($department_id) {
    global $db;
    
    $sql  = "SELECT COUNT(id) FROM profiles ";
    $sql .= "WHERE department_id='" . db_escape($db, $department_id) . "' ";
    $sql .= "AND status = 1 ";
    $sql .= "ORDER BY id ASC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $row = mysqli_fetch_row($result);
    mysqli_free_result($result);
    
    $count = $row[0];
    
    return $count;
  }
  
?>
