<?php
session_start();
if (isset($_SESSION["user"])) {
  header("location:user-admin.php");
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Log in</title>
  <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
  <style>
    body {
      background: url(../../img/login-bg.jpg) center center;
      background-size: cover;
    }

    .logo{
      border-radius:50%
    }
    .login-panel {
      width: 320px;

    }
    .login {
    position: relative;
    z-index: 1;
    padding: 3px;
  }

  .login::before {
    content: "";
    position: absolute;
    top: 0; 
    left: 0;
    width: 100%; 
    height: 100%;  
    opacity: .4; 
    z-index: -1;
    background: #000000;
    border-radius: 5px;
  }
  .login h1{
    color: #ffffff;
  }


    .floating-top .form-control {
      border-radius: .375rem .375rem 0 0;
    }

    .form-control:focus {
      position: relative;
      z-index: 1;
    }

    .form-floating>label {
      z-index: 2;
    }

    .floating-bottom .form-control {
      border-top: none;
      border-radius: 0 0 .375rem .375rem;
    }
  </style>
</head>

<body>
  <div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="login-panel text-center">
      <img class="logo mb-3" src="https://picsum.photos/70/70" alt="">
      <div class="login"><h1>後台管理登入</h1></div>
      <form action="user-doLogin.php" method="post">
        <div class="text-start mt-3">
          <div class="form-floating floating-top">
            <input type="text" class="form-control" id="admin_account" placeholder="Account" name="admin_account">
            <label for="admin_account">帳號</label>
          </div>
          <div class="form-floating floating-bottom">
            <input type="password" class="form-control" id="admin_password" placeholder="Password" name="admin_password">
            <label for="admin_password">密碼</label>
          </div>

        </div>
        <div class="py-3 d-flex justify-content-center">
          <div class="form-check">
            <input class="form-check-input " type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Remember me
            </label>
          </div>

        </div>
        <div class="d-grid mb-3">
          <button class="btn btn-outline-secondary text-white border border-3" type="submit">Sign in</button>
        </div>
      </form>

    </div>

    <div>

    </div>
  </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
  </script>
</body>

</html>