<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$feature_relation_types = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_feature_relation_type";

/** Fetch data **/
$feature_relation_types = getData( $mysqli, $query );

/** Display **/
if (sizeof($feature_relation_types) == 0) {
    $feature_relation_types = array(
        'error' => '(message 2) feature_relation_types not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($feature_relation_types) == 1) {
    $feature_relation_types = $feature_relation_types[0];
}

echo json_encode($feature_relation_types);

?>
