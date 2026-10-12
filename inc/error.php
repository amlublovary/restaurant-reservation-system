<?php

/**
 * error.php
 *
 * OOP: This is a class for handling errors on screen and/or logging errors to a file.
 * By default we will hide errors on screen and log them to a file instead, unless 
 * the constant SHOW_ERROR and LOG_ERROR were set otherwise in our main configuration file.
 * Displaying errors on the screen can mess up the design of our application and reveal 
 * sensitive information, therefore it is recommended to keep errors hidden on the screen 
 * and log them to a file instead.
 *
 * @package    restaurant-reservation-system
 * @author     Ana-Maria Lublovary <anamaria.lublovary@gmail.com>
 * @copyright  2026 datikothechef.com
 * @license    https://opensource.org/license/GPL-3.0 GNU General Public License v3.0
 * @version    1.0
 * @link       https://github.com/amlublovary/restaurant-reservation-system
 */

class Errors {

    // Global variables are available within this class and everywhere else in our code.
    static $show_error;         // Variable that tells if we should show errors on screen or not.
    static $log_error;          // Variable that tells if we should log errors to a file or not.

    // This is the constructor which will run automatically every time we use this class.
	public function __construct($show = false, $log = true) {

        // The constant SHOW_ERROR can help us to check if we should show errors on screen or not throughout our application.
        if( !defined('SHOW_ERROR') ) {
            define('SHOW_ERROR', $show);
        } elseif ( SHOW_ERROR == true ) {
            $show = true;
        } else {
            $show = false;
        }

        // If the variable $show has been set to true then display errors on the screen
        if( $show ) {
            error_reporting(E_ALL ^ E_DEPRECATED);
            ini_set('display_errors', '1');
            self::$show_error = true;
        } else {
            error_reporting(0);
            ini_set('display_errors', '0');
            self::$show_error = false;
        }

        // The constant LOG_ERROR can help us to check if we should log errors or not throughout our application.
        if( !defined('LOG_ERROR') ) {
            define('LOG_ERROR', $log);
        } elseif ( LOG_ERROR == false ) {
            $log = false;
        } else {
            $log = true;
        }

        // If the variable $log has been set to true then log errors into a file
        if( $log ) {
            self::$log_error = true;
        } else {
            self::$log_error = false;
        }
	}

}

// Initialize the error class and save it into a variable so we can use it throughout our application.
$error = new Errors();
?>