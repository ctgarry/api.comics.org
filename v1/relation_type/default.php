<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$relation_type_id = getRequest( $path, "relation_type" ); // IN
if ($relation_type_id < 1) $relation_type_id = 0;
$relation_type = array(); // OUT

$params_types = 'i';
$params = array( $relation_type_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_relation_type WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($relation_type_id > 0) {
    $relation_type = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($relation_type) == 0) {
    $relation_type = array(
        'error' => '(message 2) relation_type not found'
    );
} elseif (sizeof($relation_type) == 1) {
    $relation_type = $relation_type[0];
}

echo json_encode($relation_type);

?>


