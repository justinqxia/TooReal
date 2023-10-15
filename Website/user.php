<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login</title>
  <?php
  require 'assets/head.inc.php';
  ?>
</head>

<body>
  <?php
  require 'assets/navbar.inc.php';
  ?>
  <main id="main" class="main">
    <div class="container px-4 py-5" id="featured-3">
      <?php
      if ($loggedIn) {
        ?>
        <p>You're logged in as <b>
            <?= $_SESSION['userUID'] ?>
          </b></p>
        <a href="backend/accounts/logout.inc.php" class="btn btn-danger">Logout</a>
        <?php
      } else {
        ?>

        <h1 class="pb-2 border-bottom">Login</h1>
        <form action="backend/accounts/login.inc.php" method="post">
          <div class="mb-1">
            <div class="form-floating">
              <input class="form-control" type="text" name="mailuid" placeholder="Username" class="nav-username-password"
                autofocus required>
              <label> Username</label>
            </div>
          </div>
          <div class="mb-1">
            <div class="form-floating">
              <input class="form-control" type="password" name="pwd" placeholder="Password" class="nav-username-password"
                required>
              <label> Password</label>
            </div>
          </div>
          <button type="submit" name="login-submit" class="btn btn-primary login-btn">Login</button>
        </form><br>
        </form>
        <h1>Signup! </h1>
        <form method="post" action="backend/accounts/signup.inc.php">
          <div class="mb-1">
            <div class="form-floating">
              <input class="form-control" type="text" name="uid" placeholder="Username" class="nav-username-password"
                required>
              <label> Username</label>
            </div>
          </div>
          <div class="mb-1">
            <div class="form-floating">
              <input class="form-control" type="email" name="mail" placeholder="Email" class="nav-username-password"
                required>
              <label> Email</label>
            </div>
          </div>
          <div class="mb-1">
            <div class="form-floating">
              <input class="form-control" type="password" name="pwd" placeholder="Password" class="nav-username-password"
                required>
              <label> Password</label>
            </div>
          </div>
          <div class="mb-1">
            <div class="form-floating">
              <input class="form-control" type="password" name="pwdRepeat" placeholder="Password"
                class="nav-username-password" required>
              <label> Repeat Password</label>
            </div>
          </div>
          <button type="submit" name="login-submit" class="btn btn-primary login-btn">Login</button>
        </form><br>
        </form>
      <?php } ?>