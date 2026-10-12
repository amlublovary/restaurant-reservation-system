<?php
/**
 * reservation.php
 *
 * Check reservation status page
 *
 * @package    restaurant-reservation-system
 * @author     Ana-Maria Lublovary <anamaria.lublovary@gmail.com>
 * @copyright  2026 datikothechef.com
 * @license    https://opensource.org/license/GPL-3.0 GNU General Public License v3.0
 * @version    1.0
 * @link       https://github.com/amlublovary/restaurant-reservation-system
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="keywords" content="check reservation, check booking"/>
	<title>Reservation Status</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css" media="all" />
	<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="./css/wickedpicker.css" media="all" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>
<body>
	<h1 class="header-w3ls">Reservation Status</h1>
	<div class="appointment-w3">
		<form action="reservation-search.php" method="post">
			<div class="personal">
				<div class="main">
					<div class="form-left-w3l">
						<input type="text" class="top-up" name="search_no" placeholder="Search by booking or phone number" required="">
					</div>
			</div>
			<div class="btnn">
				<input type="submit" value="Search" name="submit">
			</div>
			<div class="copy">
				<p><a href="/">Back</a></p>
			</div>
		</form>
	</div>
</body>
<script type="text/javascript" src='js/jquery-2.2.3.min.js'></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/wickedpicker.js"></script>
<script type="text/javascript">
	function hideURLbar() {
		window.scrollTo(0,1);
	}
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);

	$('.timepicker,.timepicker1').wickedpicker({ twentyFour: false });

	$(function () {
		$("#datepicker,#datepicker1,#datepicker2,#datepicker3").datepicker();
	});
</script>
</html>