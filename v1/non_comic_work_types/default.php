<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';
$method = "non_comic_work_types";
$table = $DBName . ".gcd_non_comic_work_type";

/****** 
 * Get params and default query **/
$results_array = array(); // OUT
$query = "SELECT * FROM " . $table;

/****** 
 * Fetch data **/
$results_array = getData( $mysqli, $query );

/****** 
 * Display **/
if ( 0 == sizeof( $results_array ) ) {
    $results_array = array( 'error' => $method . ' not found ( message 2 )' );
} elseif ( is_null( $results_array[0] ) ) {
    $results_array = array( 'error' => 'null ( message 3 )' );
} elseif ( 1 == sizeof( $results_array ) ) {
    $results_array = $results_array[0];
}

echo json_encode( $results_array );

?>