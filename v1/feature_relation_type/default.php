<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$feature_relation_type_id = getRequest( $path, "feature_relation_type" ); // IN
if ($feature_relation_type_id < 1) $feature_relation_type_id = 0;
$feature_relation_type = array(); // OUT

$params_types = 'i';
$params = array( $feature_relation_type_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_feature_relation_type WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($feature_relation_type_id > 0) {
    $feature_relation_type = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($feature_relation_type) == 0) {
    $feature_relation_type = array(
        'error' => '(message 2) feature_relation_type not found'
    );
} elseif (sizeof($feature_relation_type) == 1) {
    $feature_relation_type = $feature_relation_type[0];
}

echo json_encode($feature_relation_type);

?>