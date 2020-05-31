<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  $admin_set = find_all_admins();
?>

<?php $page_title = 'Admins' ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="main">
      <h1>Admins</h1>
      
      <a href="<?php echo url_for('/staff/admins/new.php'); ?>">Create New Admin</a>
      
      <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center">First Name</th>
            <th class="text-center">Last Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Username</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
          
        <tbody>
          <?php while ($admin = mysqli_fetch_assoc($admin_set)) { ?>
            <tr>
              <td class="text-center"><?php echo h($admin['id']); ?></td>
              <td class="text-center"><?php echo h($admin['first_name']); ?></td>
              <td class="text-center"><?php echo h($admin['last_name']); ?></td>
              <td class="text-center"><?php echo h($admin['email']); ?></td>
              <td class="text-center"><?php echo h($admin['username']); ?></td>
              <td class="text-center"><a href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($admin['id']))); ?>">View</a></td>
              <td class="text-center"><a href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin['id']))); ?>">Edit</a></td>
              <td class="text-center"><a href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>">Delete</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      
      <?php
        mysqli_free_result($admin_set);
      ?>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
