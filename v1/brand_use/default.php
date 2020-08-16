<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$brand_use_id = getRequest( $path, "brand_use" ); // IN
if ($brand_use_id < 1) $brand_use_id = 0;
$brand_use = array(); // OUT

$params_types = 'i';
$params = array( $brand_use_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_brand_use WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($brand_use_id > 0) {
    $brand_use = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($brand_use) == 0) {
    $brand_use = array(
        'error' => '(message 2) brand_use not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($brand_use) == 1) {
    $brand_use = $brand_use[0];
}

echo json_encode($brand_use);

?>