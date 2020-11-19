    <footer>
      <div class="footer">
        <div class="container">
          <div class="row">
            <div class="col-sm-10 offset-sm-1 text-center">
              <p id="copyright">&copy; <?php echo date('Y'); ?> Matthew Huskey</p>
              
              <ul class="text-center">
                <li class="footer-list" id="github"><a href="https://github.com/mhuskey" target="_blank"><i class="fab fa-github"></i></a></li>
                <li class="footer-list" id="mail"><a href="mailto:matthewhuskey@me.com"><i class="fas fa-envelope"></i></a></li>
                <li class="footer-list" id="linkedin"><a href="https://www.linkedin.com/in/matthew-huskey-17258716b" target="_blank"><i class="fab fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>

<?php
  db_disconnect($db);
?>
