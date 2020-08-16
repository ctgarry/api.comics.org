<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$feature_type_id = getRequest( $path, "feature_type" ); // IN
if ($feature_type_id < 1) $feature_type_id = 0;
$feature_type = array(); // OUT

$params_types = 'i';
$params = array( $feature_type_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_feature_type WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($feature_type_id > 0) {
    $feature_type = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($feature_type) == 0) {
    $feature_type = array(
        'error' => '(message 2) feature_type not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($feature_type) == 1) {
    $feature_type = $feature_type[0];
}

echo json_encode($feature_type);

?>