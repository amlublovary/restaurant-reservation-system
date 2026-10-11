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

// Set a constant 'HP' that helps to identify that the home page was loaded
define('HP', 'true');

// Include the configuration file for database connection and other settings
include_once('./inc/config.php');

if (isset($_POST['submit'])) {
	$fname = $_POST['name'];
	$emailid = $_POST['email'];
	$phonenumber = $_POST['phonenumber'];
	$bookingdate = $_POST['bookingdate'];
	$bookingtime = $_POST['bookingtime'];
	$noadults = $_POST['noadults'];
	$nochildrens = $_POST['nochildrens'];
	$bno = mt_rand(100000000,9999999999);

	//Code for Insertion
	$query = mysqli_query($db, "insert into Reservation(Number,Name,Email,Phone,BookingDate,BookingTime,Adults,Children) values('$bno','$fname','$emailid','$phonenumber','$bookingdate','$bookingtime','$noadults','$nochildrens')");
	if ($query) {
		echo '<script type="text/javascript">alert("Your order has been sent successfully. Your booking number is "+"'.$bno.'");</script>';
		echo '<script type="text/javascript">document.location = "index.php";</script>';
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
	<script type="text/javascript">
		addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar() { window.scrollTo(0,1); }
	</script>
	<link rel="stylesheet" type="text/css" href="./css/style.css" media="all" />
	<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="./css/wickedpicker.css" media="all" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Elms+Sans:ital,wght@0,100..900;1,100..900&display=swap" />
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
						<input class="buttom" type="text" name="phonenumber" placeholder="Phone Number" required="">
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
						<select class="form-control" name="noadults" required>
							<option value="">Number of Adults</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
						</select>
					</div>
					<div class="form-right-w3ls">
						<select class="form-control" name="nochildrens" required>
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
						</select>
					</div>
				</div>
			</div>
			<div class="btnn">
				<input type="submit" value="Reserve a Table" name="submit">
			</div>
			<div class="copy">
				<p><a href="check-status.php" target="_blank">Check your Booking</a></p>
			</div>
			<div class="copy">
				<p><a href="admin/" target="_blank">Admin Panel</a></p>
			</div>
		</form>
	</div>
</body>
<script type="text/javascript" src="./js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="./js/jquery-ui.js"></script>
<script type="text/javascript" src="./js/wickedpicker.js"></script>
<script type="text/javascript">
	$('.timepicker,.timepicker1').wickedpicker({ twentyFour: false });
	$(function() {
		$("#datepicker").datepicker({
			dateFormat: "yy-mm-dd",
			minDate: 0
		});
	});
</script>
</html>