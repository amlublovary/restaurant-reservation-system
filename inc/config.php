<?php
// Display errors on the screen (needed during development only)
//ini_set('display_errors', '1');
//error_reporting(E_ALL ^ E_DEPRECATED);

// Connect to database
try {
	$db = mysqli_connect('db', 'datikothechef', 'AuJ7k68cXCTnpPSX', 'datikothechef');
} catch (mysqli_sql_exception $error) {
	die($error);
}

// Set our time zone which might be different from the server's time zone
date_default_timezone_set('Asia/Tbilisi');
?>