<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$publisher_id = getRequest( $path, "publisher" ); // IN
if ($publisher_id < 1) $publisher_id = 0;
$publisher = array(); // OUT

$params_types = 'i';
$params = array( $publisher_id );

/** Set query and update params as needed **/
$request = $_SERVER['REQUEST_URI'];
if ($publisher_id > 0 && strpos($request, 'brand_groups') !== false ) { //found it
	$query = "SELECT * FROM " . $DBName . ".gcd_brand_group WHERE parent_id = ?";
} else {
	$query = "SELECT * FROM " . $DBName . ".gcd_publisher WHERE id = ?";
};
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($publisher_id > 0) {
    $publisher = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($publisher) == 0) {
    $publisher = array(
        'error' => '(message 2) publisher not found'
    );
} elseif (sizeof($publisher) == 1) {
    $publisher = $publisher[0];
}

echo json_encode($publisher);

?>