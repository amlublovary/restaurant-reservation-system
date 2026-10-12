<?php
/**
 * index.php
 *
 * Home page
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

// Set a constant 'HP' that helps to identify that the home page was loaded
define('HP', true);

// Check if the visitor tried to book a table and sent data are not empty.
if( isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['bookingdate']) && isset($_POST['bookingtime']) && isset($_POST['adults']) && isset($_POST['children']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['bookingdate']) && !empty($_POST['bookingtime']) && !empty($_POST['adults']) && !empty($_POST['children']) ) {

	// Generate a random booking number.
	$booking_no = mt_rand(100000000, 9999999999);

	// Save the visitor's data into variables and escape each data to prevent SQL injections and other possible issues.
	$name = $dbo->escape($_POST['name']);
	$email = $dbo->escape( str_replace(' ', '', $_POST['email']) );
	
	$phone = str_replace(' ', '', $_POST['phone']);	// Remove any spaces from phone number
	$phone = str_replace('+', '00', $phone);		// Replace + symbol with 00
	$phone = preg_replace("/[^0-9 ]/", '', $phone);	// Remove everything but numbers
	$phone = $dbo->escape($phone);

	$bookingdate = $dbo->escape( str_replace(' ', '', $_POST['bookingdate']) );
	$bookingtime = $dbo->escape( str_replace(' ', '', $_POST['bookingtime']) );
	$adults = intval( str_replace(' ', '', $_POST['adults']) );
	$children = intval( str_replace(' ', '', $_POST['children']) );

	// Save the visitor's booking details into the database.
	if( $dbo->query("INSERT INTO Reservation (Number, Name, Email, Phone, BookingDate, BookingTime, Adults, Children) VALUES ('$booking_no', '$name', '$email', '$phone', '$bookingdate', '$bookingtime', '$adults', '$children')") ) {
		echo '<script type="text/javascript">alert("Your order has been taken, confirmation sent to \n'.$email.'.\nPlease save your booking number "+"'.$booking_no.'");</script>';
		echo '<script type="text/javascript">document.location = "/";</script>';
	} else {
		echo '<script type="text/javascript">alert("Sorry something went wrong. Please try again.");</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="keywords" content="table reservation, table booking, restaurant reservation, dinner reservation"/>
	<title>Table Reservation</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css" media="all" />
	<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="./css/wickedpicker.css" media="all" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>
<body>
	<h1 class="header-w3ls">Table Reservation</h1>
	<div class="appointment-w3">
		<form action="#" method="post">
			<div class="personal">
				<div class="main">
					<div class="form-left-w3l">
						<input type="text" class="top-up" name="name" placeholder="Name" required="">
					</div>
					<div class="form-left-w3l">
						<input type="email" name="email" placeholder="Email" required="">
					</div>
					<div class="form-right-w3ls ">
						<input class="buttom" type="text" name="phone" placeholder="Phone Number" required="">
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="information">
				<div class="main">
					<div class="form-left-w3l">
						<input type="date" id="datepicker" name="bookingdate" placeholder="Booking Date &" required="">
						<input type="text" id="timepicker" name="bookingtime" placeholder="Time" required="" class="timepicker form-control hasWickedpicker" onkeypress="return false;">
						<div class="clear"></div>
					</div>
				</div>
				<div class="main">
					<div class="form-left-w3l">
						<select class="form-control" name="adults" required="">
							<option value="">Number of Adults</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
					</div>
					<div class="form-right-w3ls">
						<select class="form-control" name="children" required="">
							<option value="">Number of Children</option>
							<option value="1">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
					</div>
				</div>
			</div>
			<div class="btnn">
				<input type="submit" value="Reserve a Table" name="submit">
			</div>
			<div class="copy">
				<p><a href="reservation.php">Check your Reservation</a></p>
			</div>
		</form>
	</div>
</body>
<script type="text/javascript" src="./js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="./js/jquery-ui.js"></script>
<script type="text/javascript" src="./js/wickedpicker.js"></script>
<script type="text/javascript">
	function hideURLbar() {
		window.scrollTo(0,1);
	}
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);

	$('.timepicker,.timepicker1').wickedpicker({ twentyFour: true });

	$(function() {
		$("#datepicker").datepicker({
			dateFormat: "yy-mm-dd",
			minDate: 0
		});
	});
</script>
</html>