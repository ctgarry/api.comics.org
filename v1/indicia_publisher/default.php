<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$indicia_publisher_id = getRequest( $path, "indicia_publisher" ); // IN
if ($indicia_publisher_id < 1) $indicia_publisher_id = 0;
$indicia_publisher = array(); // OUT

$params_types = 'i';
$params = array( $indicia_publisher_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_indicia_publisher WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($indicia_publisher_id > 0) {
    $indicia_publisher = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($indicia_publisher) == 0) {
    $indicia_publisher = array(
        'error' => '(message 2) indicia_publisher not found'
    );
} elseif (sizeof($indicia_publisher) == 1) {
    $indicia_publisher = $indicia_publisher[0];
}

echo json_encode($indicia_publisher);

?>