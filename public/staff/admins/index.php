<?php
  require_once('../../../private/initialize.php');
  
  $admin_set = find_all_admins();
?>

<?php $page_title = 'Admins' ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="main">
      <h1>Admins</h1>
      <a class="back-link" href="<?php echo url_for('/staff/index.php'); ?>">&laquo; Back to Staff Area</a><br /><br />
      
      <a href="<?php echo url_for('/staff/admins/new.php'); ?>">Create New Admin</a>
      
      <table>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Username</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
        
        <?php while ($admin = mysqli_fetch_assoc($admin_set)) { ?>
          <tr>
            <td><?php echo h($admin['id']); ?></td>
            <td><?php echo h($admin['first_name']); ?></td>
            <td><?php echo h($admin['last_name']); ?></td>
            <td><?php echo h($admin['email']); ?></td>
            <td><?php echo h($admin['username']); ?></td>
            <td><a href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($admin['id']))); ?>">View</a></td>
            <td><a href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin['id']))); ?>">Edit</a></td>
            <td><a href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>">Delete</a></td>
          </tr>
        <?php } ?>
      </table>
      
      <?php
        mysqli_free_result($admin_set);
      ?>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
