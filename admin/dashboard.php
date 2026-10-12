<?php
/**
 * dashboard.php
 *
 * Admin dashboard
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

// Check if user is authenticated and has got a user ID in the current session, or redirect back to the login page.
if( !isset($_SESSION['aid']) || strlen($_SESSION['aid'])==0 ) { 
  header('location:/admin/');
  die();
}

// Get the total amount of users from the database (privilege 0 is a visitor, 1 is the admin, any higher number is a user)
$num_users = $dbo->fetch("SELECT COUNT(ID) FROM Admin WHERE Privilege > 0");

// Get the total amount of bookings from the database.
$num_bookings = $dbo->fetch("SELECT COUNT(ID) FROM Reservation");

// Get the total amount of NEW bookings from the database.
$num_new_bookings = $dbo->fetch("SELECT COUNT(ID) FROM Reservation WHERE (Status is null || Status='')");

// Get the total amount of ACCEPTED bookings from the database.
$num_accepted_bookings = $dbo->fetch("SELECT COUNT(ID) FROM Reservation WHERE (Status='Accepted')");

// Get the total amount of REJECTED bookings from the database.
$num_rejected_bookings = $dbo->fetch("SELECT COUNT(ID) FROM Reservation WHERE (Status='Rejected')");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Restaurant Reservation System | Dashboard</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include_once('./includes/navbar.php');?>
<?php include_once('./includes/sidebar.php');?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">             
                <h3><?php echo $num_new_bookings; ?></h3>
                <p>New Bookings</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="new-bookigs.php" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $num_accepted_bookings; ?></h3>
                <p>Accepted Bookings</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="accepted-bookings.php" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $num_rejected_bookings; ?></h3>
                <p>Rejected Bookings</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="rejected-bookings.php" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo $num_bookings; ?></h3>
                <p>All bookings</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="all-bookings.php" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
<?php 
// Show user count only to the admin.
if( $_SESSION['utype']==1 ):
?>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $num_users; ?></h3>
                <p>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="manage-subadmins.php" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
<?php endif;?>
          <hr />
        </div>
      </div>
    </section>
  </div>
<?php include_once('./includes/footer.php');?>
</div>
<script src="../plugins/jquery/jquery.min.js" type="text/javascript"></script>
<script src="../plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="../plugins/chart.js/Chart.min.js" type="text/javascript"></script>
<script src="../plugins/sparklines/sparkline.js" type="text/javascript"></script>
<script src="../plugins/jqvmap/jquery.vmap.min.js" type="text/javascript"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="../plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script>
<script src="../plugins/moment/moment.min.js" type="text/javascript"></script>
<script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js" type="text/javascript"></script>
<script src="../plugins/summernote/summernote-bs4.min.js" type="text/javascript"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js" type="text/javascript"></script>
<script src="../dist/js/adminlte.js" type="text/javascript"></script>
<script src="../dist/js/demo.js" type="text/javascript"></script>
<script src="../dist/js/pages/dashboard.js" type="text/javascript"></script>
</body>
</html>