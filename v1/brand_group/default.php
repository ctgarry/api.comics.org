<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$brand_group_id = getRequest( $path, "brand_group" ); // IN
if ($brand_group_id < 1) $brand_group_id = 0;
$brand_group = array(); // OUT

$params_types = 'i';
$params = array( $brand_group_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_brand_group WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($brand_group_id > 0) {
    $brand_group = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($brand_group) == 0) {
    $brand_group = array(
        'error' => '(message 2) brand_group not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($brand_group) == 1) {
    $brand_group = $brand_group[0];
}

echo json_encode($brand_group);

?>