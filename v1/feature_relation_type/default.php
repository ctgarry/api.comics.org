<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';
$method = "feature_relation_type";
$table = $DBName . ".gcd_feature_relation_type";

/******
 * Get params and default query **/
$param_id = getRequest( $path, $method ); // IN
if ( 1 > $param_id ) $param_id = 0;
$results_array = array(); // OUT
$params_types = 'i';
$params = array( $param_id );
$query = "SELECT * FROM " . $table . " WHERE id = ? ";

/******
 * Fetch data **/
if ( 0 < $param_id ) {
    $results_array = getData( $mysqli, $query, $params, $params_types );
}

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