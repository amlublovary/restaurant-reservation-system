<?php

/**
 * autoload.php
 *
 * This is the main autoload file which includes the minimal necessary files for our application to work properly.
 *
 * @package    restaurant-reservation-system
 * @author     Ana-Maria Lublovary <anamaria.lublovary@gmail.com>
 * @copyright  2026 datikothechef.com
 * @license    https://opensource.org/license/GPL-3.0 GNU General Public License v3.0
 * @version    1.0
 * @link       https://github.com/amlublovary/restaurant-reservation-system
 */

// Load these necessary files below, if they cannot be found we will throw an error and stop the execution of our application.
require_once('config.php');
require_once('error.php');
require_once('db.php');
?>