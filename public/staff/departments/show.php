<?php
  require_once('../../../private/initialize.php');
  
  $id = $_GET['id'] ?? '1';
  
  $department  = find_department_by_id($id);
  $profile_set = find_profiles_by_department_id($id);
?>

<?php $page_title = 'Show Department'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="main">
      <a class="back-link" href="<?php echo url_for('/staff/departments/index.php'); ?>">&laquo; Back to List</a>
      
      <h1>Department: <?php echo h($department['department_name']); ?></h1>
      
      <dl>
        <dt>Department Name</dt>
        <dd><?php echo h($department['department_name']); ?></dd>
      </dl>
      
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($department['position']); ?></dd>
      </dl>
          
      <hr />
      
      <div>
        <h2>Profiles</h2>
        
        <a href="<?php echo url_for('/staff/profiles/new.php?department_id=' . h(u($department['id']))); ?>">Create New Employee Profile</a>
        
        <table>
          <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Employee Number</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
          
          <?php while ($profile = mysqli_fetch_assoc($profile_set)) { ?>
            <?php $department = find_department_by_id($profile['department_id']); ?>
            <tr>
              <td><?php echo h($profile['id']); ?></td>
              <td><?php echo h($profile['first_name']); ?></td>
              <td><?php echo h($profile['last_name']); ?></td>
              <td><?php echo h($profile['employee_number']); ?></td>
              <td><a href="<?php echo url_for('/staff/profiles/show.php?id=' . h(u($profile['id']))); ?>">View</a></td>
              <td><a href="<?php echo url_for('/staff/profiles/edit.php?id=' . h(u($profile['id']))); ?>">Edit</a></td>
              <td><a href="<?php echo url_for('/staff/profiles/delete.php?id=' . h(u($profile['id']))); ?>">Delete</a></td>
            </tr>
          <?php } ?>
        </table>
        
        <?php
          mysqli_free_result($profile_set);
        ?>
      </div>
    </div>
