<!DOCTYPE html>

<?php
include './php/common.php';
links("Log-in");
title("Log-in");

?>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/style_log.css" />

  <title>Sign in & Sign up Form</title>

</head>

<body>

  <div class="container">

    <video autoplay muted loop plays-inline class='backvid'>
      <source src='./assests/video/cms_vid.mp4' type='video/mp4' />
    </video>

    <div class="forms-container">
      <div class="signin-signup">
        <form action="#" class="sign-in-form">
          <span id="check-2"></span>
          <img class="form__image" src="./assests/Images/keymaster_circle.png" />
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" id="username-signin"/>
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" id="Password-signin"/>
          </div>
          <a href="../cms/CMS.html">
            <input type='button' class="btn" value="Sign in" id="submit" action="../cms/CMS.html"/>
          </a>
        </form>
        <form action="#" class="sign-up-form">
          <span id="check"></span>
  
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>ADMIN LOG IN FOR KEYMASTER</h3>

          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="./Assests/Images/cms.png" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        
        <img src="./Assests/Images/sign_up.png" class="image" alt="" />
      </div>
    </div>

  </div>

  <script src="./js/app.js"></script>
  <script src="js/log_in_sorting.js"></script>
  <!-- Back to Homepage box overflow  -->
  <a href="./index.php" class="gotobottom"><i class="fas fa fa-home"></i></a>

</body>

</html>