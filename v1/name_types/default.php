<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$name_types = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_name_type";

/** Fetch data **/
$name_types = getData( $mysqli, $query );

/** Display **/
if (sizeof($name_types) == 0) {
    $name_types = array(
        'error' => '(message 2) name_types not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($name_types) == 1) {
    $name_types = $name_types[0];
}

echo json_encode($name_types);

?>
