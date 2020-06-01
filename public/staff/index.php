<?php require_once('../../private/initialize.php'); ?>

<?php require_login(); ?>

<?php $page_title = 'Staff Menu'; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>
  
    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <h1>Employee Management Staff Area</h1>
                
                <a href="<?php echo url_for('/staff/admins/index.php'); ?>"><button type="button" class="btn btn-outline-info no-left-margin">Admins</button></a>
                <a href="<?php echo url_for('/staff/departments/index.php'); ?>"><button type="button" class="btn btn-outline-primary">Departments</button></a>
                <a href="<?php echo url_for('/staff/profiles/index.php'); ?>"><button type="button" class="btn btn-outline-success">Profiles</button></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
