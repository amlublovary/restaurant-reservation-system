<?php

/**
 * db.php
 *
 * OOP: This is a class for MySQL database interaction.
 * It gives us a quick and easy way to connect and disconnect from the database,
 * as well as perform repetitive queries and sorting of data later in our main code,
 * all packaged within a simple to use class and object-oriented structure.
 *
 * @package    restaurant-reservation-system
 * @author     Ana-Maria Lublovary <anamaria.lublovary@gmail.com>
 * @copyright  2026 datikothechef.com
 * @license    https://opensource.org/license/GPL-3.0 GNU General Public License v3.0
 * @version    1.0
 * @link       https://github.com/amlublovary/restaurant-reservation-system
 */

class DBO {

    // Protected variables available only within this class and not in our main code.
    protected $show_error;          // Show error messages on screen or not throughout our application.
    protected $connection;          // Variable to hold our connection to the database.
	protected $query;               // Variable to hold our most recent query to the database.
    protected $query_done = true;   // Variable to check if our query has been completed or not.
    public $results = 0;            // Variable to hold the number of results we have received from our most recent query.
    public $queries = 0;            // Variable to hold the number of queries we have run so far (mostly for debug purposes).

    // This is the constructor which will run automatically every time we use this class.
	public function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpass = 'root', $dbname = '', $charset = 'utf8') {

        // The constant SHOW_ERROR can help us to check if we should show errors on screen or not throughout our application.
        if( !defined('SHOW_ERROR') ) {
            $this->show_error = false;
        } elseif ( SHOW_ERROR == true ) {
            $this->show_error = true;
        } else {
            $this->show_error = false;
        }

        // Create a new connection to the database using opbject-oriented style and check if the connection was successful or not.
        $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        // If the connection was not successful then show an error message and stop the execution of our application.
        if ($this->connection->connect_error) {
            $this->error('ERROR: Failed to connect to the database ' . $this->connection->connect_error);
        }
        $this->connection->set_charset($charset);
	}

    // This function will run our MySQL query and return the result.
    public function query($query = '') {

        // If we have a previous query that has not been completed then close it before running a new one.
        if( !$this->query_done ) {
            $this->query->close();
        }

        // Prepare our MySQL query and check if it was successful or not.
		if( $this->query = $this->connection->prepare($query) ) {

            // If we have more than one argument passed to this function then we will break up each argument into individual parameters and save them as an array.
            if( func_num_args() > 1 ) {
                $x = func_get_args();
                $args = array_slice($x, 1);
				$types = '';
                $args_ref = array();

                // Loop through each argument and determine its type (string, integer, etc.) and save it into an array.
                foreach ($args as $k => &$arg) {
					if( is_array($args[$k]) ) {
						foreach( $args[$k] as $j => &$a ) {
							$types .= $this->_gettype($args[$k][$j]);
							$args_ref[] = &$a;
						}
					} else {
	                	$types .= $this->_gettype($args[$k]);
	                    $args_ref[] = &$arg;
					}
                }

                // Add the types string as the first argument and then bind all parameters to our MySQL query.
				array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }

            // Execute our MySQL query and check if it was successful or not.
            $this->query->execute();

            // If there was an error with our MySQL query then show an error message and stop the execution of our application.
           	if( $this->query->errno ) {
				$this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
           	}

            // Set the query_done variable to false and increment the $queries variable by one.
            $this->query_done = false;
			$this->queries++;
        } else {
            $this->error('ERROR: Unable to prepare MySQL statement ' . $this->connection->error);
        }

        // Return the current query's result, so we can use that value later in our main code.
		return $this;
    }

    // This function will return all the results from our MySQL query as an array, and if we have a callback function then we will call that function and add its results to the array.
	public function fetchAll($callback = null) {
	    $params = array();
        $row = array();

        // Get the metadata for our MySQL query and loop through each field to bind the result to an array.
	    $meta = $this->query->result_metadata();
	    while( $field = $meta->fetch_field() ) {
	        $params[] = &$row[$field->name];
	    }

        // Count the number of results we have received from our most recent query and save it into the $results variable.
        $this->results = 0;

        // Bind the result to our array and loop through each row to save it into a new array.
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while( $this->query->fetch() ) {
            $this->results++;
            $r = array();

            // Loop through each field in the current row and save it into a new array.
            foreach( $row as $key => $val ) {
                $r[$key] = $val;
            }

            // If we have a callback function passed to this function then we will call that function and pass the current row to it.
            if( $callback != null && is_callable($callback) ) {
                $value = call_user_func($callback, $r);
                if( $value == 'break' ) break;
            } else {
                $result[] = $r;
            }
        }

        // Close the current query and set the query_done variable to true.
        $this->query->close();
        $this->query_done = true;

        // Return the results array, so we can use that value later in our main code.
		return $result;
	}

    // This function will return all the result from our MySQL query as an array.
	public function fetch() {
	    $params = array();
        $row = array();

        // Get the metadata for our MySQL query and loop through each field to bind the result to an array.
	    $meta = $this->query->result_metadata();
	    while( $field = $meta->fetch_field() ) {
	        $params[] = &$row[$field->name];
	    }

        // Bind the result to our array and loop through each row to save it into a new array.
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();

        // Count the number of results we have received from our most recent query and save it into the $results variable.
        $this->results = 0;

        // Loop through each field in the current row and save it into a new array.
		while( $this->query->fetch() ) {
            $this->results++;
			foreach( $row as $key => $val ) {
				$result[$key] = $val;
			}
		}

        // Close the current query and set the query_done variable to true.
        $this->query->close();
        $this->query_done = true;

        // Return the results array, so we can use that value later in our main code.
		return $result;
	}

    // This function will escape any special characters in our query to prevent SQL injection attacks and other issues.
	public function escape($string) {
		return $this->connection->real_escape_string($string);
	}

    // This function will close the connection to the database.
	public function close() {
		return $this->connection->close();
	}

    // This function will return the number of rows from our MySQL query.
    public function rows() {
		$this->query->store_result();
		return $this->query->num_rows;
	}

    // This function will return the number of affected rows from our MySQL query.
	public function affectedrows() {
		return $this->query->affected_rows;
	}

    // This function will return the last inserted ID from our MySQL query.
    public function lastInsertID() {
    	return $this->connection->insert_id;
    }

    // This function will return the type of variable we are passing to it (s for string, d for real numbers, i for integer numbers, b for blob).
	private function _gettype($var) {
	    if( is_string($var) ) return 's';
	    if( is_float($var) ) return 'd';
	    if( is_int($var) ) return 'i';
	    return 'b';
	}

    // This function will return the last error from our MySQL query.
    public function error($error) {
        if( $this->show_error ) {
            exit($error);
        }
    }

}

// Initialize the error class and save it into a variable so we can use it throughout our application.
$dbo = new DBO(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
?>