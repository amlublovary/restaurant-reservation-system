<?php
/**
 * logout.php
 *
 * Logout page
 *
 * @package    restaurant-reservation-system
 * @author     Ana-Maria Lublovary <anamaria.lublovary@gmail.com>
 * @copyright  2026 datikothechef.com
 * @license    https://opensource.org/license/GPL-3.0 GNU General Public License v3.0
 * @version    1.0
 * @link       https://github.com/amlublovary/restaurant-reservation-system
 */

// Delete the currently active session and all of the login credentials saved within.
session_start(); 
session_destroy();

// Redirect user to the homepage.
header('location:/admin/');
?>