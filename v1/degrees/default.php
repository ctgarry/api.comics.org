<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$degrees = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_degree";

/** Fetch data **/
$degrees = getData( $mysqli, $query );

/** Display **/
if (sizeof($degrees) == 0) {
    $degrees = array(
        'error' => '(message 2) degrees not found'
    );
} elseif (sizeof($degrees) == 1) {
    $degrees = $degrees[0];
}

echo json_encode($degrees);

?>
