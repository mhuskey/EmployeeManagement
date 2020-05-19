<?php
  /* Admins
  -------------------------*/
  
  
  
  /* Employee Departments
  -------------------------*/
  function find_all_employee_departments() {
    global $db;
    
    $sql  = "SELECT * FROM employee_departments ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }
  
  
  /* Employee Profiles
  -------------------------*/
  function find_all_employee_profiles() {
    global $db;
    
    $sql  = "SELECT * FROM employee_profiles ";
    $sql .= "ORDER BY department_id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }
  
  function count_employee_profiles_by_department_id($department_id) {
    global $db;
    
    $sql  = "SELECT COUNT(id) FROM employee_profiles ";
    $sql .= "WHERE department_id='" . db_escape($db, $department_id) . "' ";
    $sql .= "ORDER BY id ASC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $row = mysqli_fetch_row($result);
    mysqli_free_result($result);
    $count = $row[0];
    
    return $count;
  }
  
?>