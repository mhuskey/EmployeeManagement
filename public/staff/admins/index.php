<?php
  require_once('../../../private/initialize.php');
  
  require_login();
  
  $admin_set = find_all_admins();
?>

<?php $page_title = 'Admins' ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <!-- Main Content -->
    <main role="main">
      <section>
        <div class="main-content">
          <div class="container min-vh-100">
            <div class="row">
              <div class="col-sm-10 offset-sm-1 text-center">
                <h1>Admins</h1>
                
                <a href="<?php echo url_for('/staff/admins/new.php'); ?>"><button type="button" class="btn btn-primary no-margin">Create Admin</button></a>
                
                <table class="table table-striped table-bordered table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th class="text-center align-middle">ID</th>
                      <th class="text-center align-middle">First Name</th>
                      <th class="text-center align-middle">Last Name</th>
                      <th class="text-center align-middle">Email</th>
                      <th class="text-center align-middle">Username</th>
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
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
