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
                <h1 class="text-center">Employee Management Staff Area</h1>
                
                <div class="row">
                  <div class="col-sm-10 offset-sm-1">
                    <div class="card border-info mb-3">
                      <div class="card-body text-center">
                        <h5 class="card-title">Admins</h5>
                        <p class="card-text">View and edit Employee Management admins.</p>
                        <a href="<?php echo url_for('/staff/admins/index.php'); ?>" class="btn btn-info">Admins</a>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-sm-10 offset-sm-1">
                    <div class="card border-primary mb-3">
                      <div class="card-body text-center">
                        <h5 class="card-title">Departments</h5>
                        <p class="card-text">View and edit Employee Management departments, as well as the employees that comprise them.</p>
                        <a href="<?php echo url_for('/staff/departments/index.php'); ?>" class="btn btn-primary">Departments</a>
                      </div>
                    </div>
                  </div>
                                  
                  <div class="col-sm-10 offset-sm-1">
                    <div class="card border-success mb-3">
                      <div class="card-body text-center">
                        <h5 class="card-title">Profiles</h5>
                        <p class="card-text">View and edit all Employee Management profiles.</p>
                        <a href="<?php echo url_for('/staff/profiles/index.php'); ?>" class="btn btn-success">Profiles</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
