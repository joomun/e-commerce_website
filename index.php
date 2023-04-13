<!DOCTYPE html>


<!-- fetch css links & title format -->
<?php
include './php/common.php';
links("Homepage");
title("Homepage");
?>


<body>
  <div class="hero">
    <section>
      <!-- fetch background video  -->
      <?php
      video_back('./assests/video/keymaster_v5.mp4')
      ?>

    <?php
      nav_bar();
    ?>
        
    </nav>

  </section>
  </div>

    <!-- Script to run owl carousel  -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="./js/server.js"></script>
  </div>

  <!-- Back to Homepage box overflow  -->
  <a href="#" class="gotobottom"><i class="fas fa-arrow-up"></i></a>
</body>

<?php
footer_function();
?>