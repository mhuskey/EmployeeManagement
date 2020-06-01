<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/departments/index.php'));
  }
  $id = $_GET['id'];
  
  if(is_post_request()) {
    $result = delete_department($id);
    $_SESSION['message'] = 'The department was deleted successfully.';
    redirect_to(url_for('/staff/departments/index.php'));
  } else {
    $department = find_department_by_id($id);
  }
?>

<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Delete Department</h1>
                
                <p>Are you sure you want to delete this department?</p>
                
                <p><?php echo h($department['department_name']); ?></p>
                
                <form action="<?php echo url_for('/staff/departments/delete.php?id=' . h(u($department['id']))); ?>" method="post">
                  <a href="<?php echo url_for('/staff/departments/index.php?id=' . h(u($department['id']))); ?>"><button type="button" class="btn btn-secondary">Cancel</button></a>
                  <button type="submit" class="btn btn-danger" name="commit">Delete Department</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
