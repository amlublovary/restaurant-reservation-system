<?php
/**
 * reservation-search.php
 *
 * Reservation status search page
 *
 * @package    restaurant-reservation-system
 * @author     Ana-Maria Lublovary <anamaria.lublovary@gmail.com>
 * @copyright  2026 datikothechef.com
 * @license    https://opensource.org/license/GPL-3.0 GNU General Public License v3.0
 * @version    1.0
 * @link       https://github.com/amlublovary/restaurant-reservation-system
 */

// Include necessary files such as configuration, error handling, database connection, etc.
require_once('./inc/autoload.php');

// Check if the visitor tried to check status using a booking or phone number.
if( isset($_POST['submit']) && isset($_POST['search_no']) && !empty($_POST['search_no']) ) {

	// Save the visitor's data into variables and escape it to prevent SQL injections and other possible issues.
	$search_no = str_replace(' ', '', $_POST['search_no']);	// Remove any spaces from booking or phone number
	$search_no = str_replace('+', '00', $search_no);		// Replace + symbol with 00
	$search_no = preg_replace("/[^0-9 ]/", '', $search_no);	// Remove everything but numbers
	$search_no = $dbo->escape( $search_no );

	// Search the database for requested booking or phone number.
	$result = $dbo->fetchAll("SELECT * FROM Reservation WHERE Number='$search_no' OR Phone='$search_no' ORDER BY ID Desc");
	if( !$result ) {
		// Show a message if we couldn't find any reservations.
		echo '<script type="text/javascript">alert("Sorry could not find any reservation with number \n'.$search_no.'");</script>';
	}
}

// If we didn't query the database successfully then redirect visitor back to the previous page.
if( !isset($result) || empty($result) ) {
	echo '<script type="text/javascript">document.location = "reservation.php";</script>';
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="keywords" content="check reservation, check booking"/>
	<title>Reservation Status</title>
	<link rel="stylesheet" type="text/css" href="plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="dist/css/adminlte.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css" media="all" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>
<body>
  <section class="content-header" style="background-color:white;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1>Reservation for <?php echo $search_no; ?></h1>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table id="reservations" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Booking Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
<?php
$i = 0;
foreach($result as $row) {
	$i++;
?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['Number']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Phone']; ?></td>
                    <td><?php echo $row['Adults']; ?></td>
                    <td><?php echo $row['Children']; ?></td>
                    <td><?php echo $row['BookingDate']; ?> <?php echo $row['BookingTime']; ?></td>
                    <th><a href="reservation-details.php?no=<?php echo $row['Number']; ?>" title="Details" class="btn btn-primary btn-xm" target="blank">Details</a></th>
				  </tr>
<?php } ?>
				</tbody>
			  </table>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </section>
	<div class="appointment-w3">
		<form action="reservation.php" method="post">
			<div class="btnn">
				<input type="submit" value="Back" name="back">
			</div>
		</form>
	</div>
<script src="plugins/jquery/jquery.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script src="plugins/jszip/jszip.min.js" type="text/javascript"></script>
<script src="plugins/pdfmake/pdfmake.min.js" type="text/javascript"></script>
<script src="plugins/pdfmake/vfs_fonts.js" type="text/javascript"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js" type="text/javascript"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js" type="text/javascript"></script>
<script src="dist/js/adminlte.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(function() {
    $("#reservations").DataTable({
      "responsive": true,
	  "lengthChange": false,
	  "autoWidth": true,
      "paging": true,
	  "pageLength": 50,
      "searching": false,
      "ordering": true,
      "info": true,
      "buttons": ["copy", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#reservations_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>