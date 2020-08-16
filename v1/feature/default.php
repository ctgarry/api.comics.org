<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$feature_id = getRequest( $path, "feature" ); // IN
if ($feature_id < 1) $feature_id = 0;
$feature = array(); // OUT

$params_types = 'i';
$params = array( $feature_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_feature WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($feature_id > 0) {
    $feature = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($feature) == 0) {
    $feature = array(
        'error' => '(message 2) feature not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($feature) == 1) {
    $feature = $feature[0];
}

echo json_encode($feature);

?>