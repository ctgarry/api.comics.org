<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$relation_types = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_relation_type";

/** Fetch data **/
$relation_types = getData( $mysqli, $query );

/** Display **/
if (sizeof($relation_types) == 0) {
    $relation_types = array(
        'error' => '(message 2) relation_types not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($relation_types) == 1) {
    $relation_types = $relation_types[0];
}

echo json_encode($relation_types);

?>
