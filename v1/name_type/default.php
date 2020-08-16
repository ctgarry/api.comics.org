<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$name_type_id = getRequest( $path, "name_type" ); // IN
if ($name_type_id < 1) $name_type_id = 0;
$name_type = array(); // OUT

$params_types = 'i';
$params = array( $name_type_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_name_type WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($name_type_id > 0) {
    $name_type = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($name_type) == 0) {
    $name_type = array(
        'error' => '(message 2) name_type not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($name_type) == 1) {
    $name_type = $name_type[0];
}

echo json_encode($name_type);

?>