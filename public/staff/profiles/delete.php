<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
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

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Delete Profile</h1>
                
                <p>Are you sure you want to delete this profile?</p>
                
                <p><?php echo h($profile['first_name'] . ' ' . $profile['last_name']); ?></p>
                
                <form action="<?php echo url_for('/staff/profiles/delete.php?id=' . h(u($profile['id']))); ?>" method="post">
                  <a href="<?php echo url_for('/staff/profiles/show.php?id=' . h(u($profile['id']))); ?>"><button type="button" class="btn btn-secondary">Cancel</button></a>
                  <button type="submit" class="btn btn-danger" name="commit">Delete Profile</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
