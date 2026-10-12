<?php

/**
 * config.php
 *
 * This is the main configuration file.
 * It contains all the settings and parameters needed to connect our database and to set up our application.
 * We are saving all settings into constants to be unchangeable and make them available throughout our application.
 *
 * @package    restaurant-reservation-system
 * @author     Ana-Maria Lublovary <anamaria.lublovary@gmail.com>
 * @copyright  2026 datikothechef.com
 * @license    https://opensource.org/license/GPL-3.0 GNU General Public License v3.0
 * @version    1.0
 * @link       https://github.com/amlublovary/restaurant-reservation-system
 */

define('SHOW_ERROR', true);					// If set to true then display errors on the screen (recommended only during development)
define('LOG_ERROR', false);					// If set to true then log errors to a file
define('DB_SERVER', 'db');					// Name of our database server (usually localhost)
define('DB_USERNAME', 'datikothechef');		// Username for our database
define('DB_PASSWORD', 'AuJ7k68cXCTnpPSX');	// Password for our database
define('DB_NAME', 'datikothechef');			// Name of our database
date_default_timezone_set('Asia/Tbilisi');	// Set our time zone which might be different from the server's time zone

// Connect to database !!! THIS WILL BE REPLACED WITH OUR OOP CLASS LATER IN OUR MAIN CODE !!!
try {
	$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
} catch (mysqli_sql_exception $error) {
	die($error);
}
?>