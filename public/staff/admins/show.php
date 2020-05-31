<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  $id = $_GET['id'];
  
  $admin = find_admin_by_id($id);
?>

<?php $page_title = 'Show Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="main">
      
      <h1>Admin: <?php echo h($admin['username']); ?></h1>
      
      <a href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin['id']))) ?>">Edit</a>
      <a href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))) ?>">Delete</a>
      <br /><br />
      
      <dl>
        <dt>First Name</dt>
        <dd><?php echo h($admin['first_name']) ?></dd>
      </dl>
      
      <dl>
        <dt>Lase Name</dt>
        <dd><?php echo h($admin['last_name']) ?></dd>
      </dl>
      
      <dl>
        <dt>Email Address</dt>
        <dd><?php echo h($admin['email']) ?></dd>
      </dl>
      
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($admin['username']) ?></dd>
      </dl>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
