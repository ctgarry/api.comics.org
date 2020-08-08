<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$creator_id = getRequest( $path, "creator" ); // IN
if ($creator_id < 1) $creator_id = 0;
$creator = array(); // OUT

$params_types = 'i';
$params = array( $creator_id );

/** Set query and update params as needed **/
$request = $_SERVER['REQUEST_URI'];
if ($issue_id > 0 && strpos($request, 'names') !== false ) { //found it
	$query = "SELECT * FROM " . $DBName . ".gcd_creator WHERE id = ?";  //  IN PROGRESS !!!
} else {
	$query = "SELECT * FROM " . $DBName . ".gcd_creator WHERE id = ?";
};
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($creator_id > 0) {
    $creator = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($creator) == 0) {
    $creator = array(
        'error' => '(message 2) creator not found'
    );
} elseif (sizeof($creator) == 1) {
    $creator = $creator[0];
}

echo json_encode($creator);

?>