<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$feature_logo_id = getRequest( $path, "feature_logo" ); // IN
if ($feature_logo_id < 1) $feature_logo_id = 0;
$feature_logo = array(); // OUT

$params_types = 'i';
$params = array( $feature_logo_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_feature_logo WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($feature_logo_id > 0) {
    $feature_logo = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($feature_logo) == 0) {
    $feature_logo = array(
        'error' => '(message 2) feature_logo not found'
    );
} elseif (sizeof($feature_logo) == 1) {
    $feature_logo = $feature_logo[0];
}

echo json_encode($feature_logo);

?>