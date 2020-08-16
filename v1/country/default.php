<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$country_id = getRequest( $path, "country" ); // IN
if ($country_id < 1) $country_id = 0;
$country = array(); // OUT

$params_types = 'i';
$params = array( $country_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".stddata_country WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($country_id > 0) {
    $country = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($country) == 0) {
    $country = array(
        'error' => '(message 2) country not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($country) == 1) {
    $country = $country[0];
}

echo json_encode($country);

?>