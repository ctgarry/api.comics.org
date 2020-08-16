<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$feature_types = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_feature_type";

/** Fetch data **/
$feature_types = getData( $mysqli, $query );

/** Display **/
if (sizeof($feature_types) == 0) {
    $feature_types = array(
        'error' => '(message 2) feature_types not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($feature_types) == 1) {
    $feature_types = $feature_types[0];
}

echo json_encode($feature_types);

?>
