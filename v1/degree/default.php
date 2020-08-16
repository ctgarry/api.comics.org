<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$degree_id = getRequest( $path, "degree" ); // IN
if ($degree_id < 1) $degree_id = 0;
$degree = array(); // OUT

$params_types = 'i';
$params = array( $degree_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_degree WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($degree_id > 0) {
    $degree = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($degree) == 0) {
    $degree = array(
        'error' => '(message 2) degree not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($degree) == 1) {
    $degree = $degree[0];
}

echo json_encode($degree);

?>