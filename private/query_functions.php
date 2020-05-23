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
  
  function find_admin_by_username($username) {
    global $db;
    
    $sql  = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $admin = mysqli_fetch_assoc($result);
    
    // returns an associative array
    return $admin;
  }
  
  function validate_admin($admin) {
    // TODO: admins validations
    return;
  }
  
  function insert_admin($admin) {
    global $db;
    
    $errors = validate_admin($admin);
    if(!empty($errors)) {
      return $errors;
    }
    
    // TODO: password_hash()
    
    $sql  = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['last_name'])  . "',";
    $sql .= "'" . db_escape($db, $admin['email'])      . "',";
    $sql .= "'" . db_escape($db, $admin['username'])   . "',";
    $sql .= "'" . db_escape($db, $hashed_password)     .  "'";
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
    
    // TODO: password_hash()
    
    $sql  = "UPDATE admins SET ";
    $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
    $sql .= "last_name='"  . db_escape($db, $admin['last_name'])  . "', ";
    $sql .= "email='"      . db_escape($db, $admin['email'])      . "', ";
    if($password_sent) {
      $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "username='"   . db_escape($db, $admin['username'])   . "' ";
    $sql .= "WHERE id='"   . db_escape($db, $admin['id'])         . "' ";
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
  
  function delete_admin($admin) {
    global $db;
    
    $sql  = "DELETE FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
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
    // TODO: department validations
    return;
  }
  
  function insert_department($department) {
    global $db;
    
    $errors = validate_department($department);
    if(!empty($errors)) {
      return $errors;
    }
    
    // TODO: shift_department_positions();
    
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
    
    // TODO: shift_department_positions();
    
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
    
    // TODO: shift_department_positions();
    
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
    $sql .= "WHERE ID='" . db_escape($db, $id) . "'";
    
    $result = mysqli_query($db, $id);
    confirm_result_set($result);
    
    $profile = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    
    // returns an associative array
    return $profile;
  }
  
  function validate_profile($profile) {
    // TODO: profile validations
    return;
  }
  
  function insert_profile($profile) {
    global $db;
    
    $errors = validate_profile($profile);
    if(!empty($errors)) {
      return $errors;
    }
    
    // TODO: shift_profile_positions()
    
    $sql  = "INSERT INTO profiles ";
    $sql .= "(department_id, first_name, last_name, employee_number, status) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $profile['department_id'])   . "', ";
    $sql .= "'" . db_escape($db, $profile['first_name'])      . "', ";
    $sql .= "'" . db_escape($db, $profile['last_name'])       . "', ";
    $sql .= "'" . db_escape($db, $profile['employee_number']) . "', ";
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
    
    // TODO: shift_profile_positions()
    
    $sql  = "UPDATE profiles SET ";
    $sql .= "department_id='"   . db_escape($db, $profile['department_id'])   . "', ";
    $sql .= "first_name='"      . db_escape($db, $profile['first_name'])      . "', ";
    $sql .= "last_name='"       . db_escape($db, $profile['last_name'])       . "', ";
    $sql .= "employee_number='" . db_escape($db, $profile['employee_number']) . "', ";
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
    
    // TODO: shift_profile_positions()
    
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
    $sql .= "ORDER BY employee_number";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }
  
  function find_active_profiles_by_department_id($department_id) {
    global $db;
    
    $sql  = "SELECT * FROM profiles ";
    $sql .= "WHERE department_id='" . db_escape($db, $department_id) . "' ";
    $sql .= "AND status = 1 ";
    $sql .= "ORDER BY employee_number";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }
  
  function find_inactive_profiles_by_department_id($department_id) {
    global $db;
    
    $sql  = "SELECT * FROM profiles ";
    $sql .= "WHERE department_id='" . db_escape($db, $department_id) . "' ";
    $sql .= "AND NOT status = 1 ";
    $sql .= "ORDER BY employee_number";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }
  
  function count_profiles_by_department_id($department_id) {
    global $db;
    
    $sql  = "SELECT COUNT(id) FROM profiles ";
    $sql .= "WHERE department_id='" . db_escape($db, $department_id) . "' ";
    $sql .= "ORDER BY employee_number ASC";
    
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
    $sql .= "ORDER BY employee_number ASC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $row = mysqli_fetch_row($result);
    mysqli_free_result($result);
    
    $count = $row[0];
    
    return $count;
  }
  
?>
