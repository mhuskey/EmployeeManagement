<?php
  require_once('../../../private/initialize.php');
  
  if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/profiles/index.php'));
  }
  $id = $_GET['id'];
  
  $profile = find_profile_by_id($id);
  
  if(is_post_request()) {
    $result = delete_profile($id);
    $_SESSION['message'] = 'The profile was deleted successfully.';
    redirect_to(url_for('/staff/departments/show.php?id=' . h(u($profile['department_id']))));
  }
?>

<?php $page_title = 'Delete Employee Profile'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="main">
      <a class="back-link" href="<?php echo url_for('/staff/departments/show.php?id=' . h(u($profile['department_id']))); ?>">&laquo; Back to Employee Profiles</a>
      
      <h1>Delete Profile</h1>
      
      <p>Are you sure you want to delete this profile?</p>
      
      <p><?php echo h($profile['first_name'] . ' ' . $profile['last_name']); ?></p>
      
      <form action="<?php echo url_for('/staff/profiles/delete.php?id=' . h(u($profile['id']))); ?>" method="post">
        <input type="submit" name="commit" value="Delete Profile" />
      </form>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
