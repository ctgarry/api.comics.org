<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$brand_emblem_id = getRequest( $path, "brand_emblem" ); // IN
if ($brand_emblem_id < 1) $brand_emblem_id = 0;
$brand_emblem = array(); // OUT

$params_types = 'i';
$params = array( $brand_emblem_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_brand WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($brand_emblem_id > 0) {
    $brand_emblem = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($brand_emblem) == 0) {
    $brand_emblem = array(
        'error' => '(message 2) brand_emblem not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($brand_emblem) == 1) {
    $brand_emblem = $brand_emblem[0];
}

echo json_encode($brand_emblem);

?>