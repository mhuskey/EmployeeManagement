<?php
  require_once('../private/initialize.php');
?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Employee Management</h1>
                
                <a href="<?php echo url_for('/staff/login.php'); ?>"><button type="button" class="btn btn-primary no-left-margin">Log In</button></a>
                <a href="<?php echo url_for('/staff/signup.php'); ?>"><button type="button" class="btn btn-outline-secondary">Sign Up</button></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
