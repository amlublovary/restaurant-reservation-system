<?php

/**
 * index.php
 *
 * Admin home page
 *
 * @package    restaurant-reservation-system
 * @author     Ana-Maria Lublovary <anamaria.lublovary@gmail.com>
 * @copyright  2026 datikothechef.com
 * @license    https://opensource.org/license/GPL-3.0 GNU General Public License v3.0
 * @version    1.0
 * @link       https://github.com/amlublovary/restaurant-reservation-system
 */

// Include necessary files such as configuration, error handling, database connection, etc.
require_once('../inc/autoload.php');

// Start the session to manage user authentication and session variables
session_start();

// Check if the user is requesting a new login and has provided a username and password.
if( isset($_POST['login']) && isset($_POST['username']) && isset($_POST['inputpwd']) ) {

  // Save the username and MD5 encrypted password into a variable for further processing.
  $Username = $dbo->escape( $_POST['username'] );
  $Password = $dbo->escape( md5($_POST['inputpwd']) );

  // Check in the database if the login credentials are valid and show a message if they aren't.
  $dbo->query("SELECT ID, Username, Privilege FROM Admin WHERE Username='$Username' && Password='$Password'");
  $result = $dbo->fetch();
  if( $result ) {
    $_SESSION['aid'] = $result['ID'];
    $_SESSION['uname'] = $result['Username'];
    $_SESSION['utype'] = $result['Privilege'];
    header('location:dashboard.php');
  } else {
    echo '<script type="text/javascript">alert("Wrong username or password!");</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Restaurant Reservation System | Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../index.php" class="h1"><b>Admin</b> | RRS</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Please sign in below</p>
      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="inputpwd"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
          </div>
        </div>
      </form>
      <p class="mb-1">
        <a href="password-recovery.php">Forgot your password?</a>
      </p>
    </div>
  </div>
</div>
<script src="../plugins/jquery/jquery.min.js" type="text/javascript"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="../dist/js/adminlte.min.js" type="text/javascript"></script>
</body>
</html>
