<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$countries = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".stddata_country";

/** Fetch data **/
$countries = getData( $mysqli, $query );

/** Display **/
if (sizeof($countries) == 0) {
    $countries = array(
        'error' => '(message 2) countries not found'
    );
} elseif (sizeof($countries) == 1) {
    $countries = $countries[0];
}

echo json_encode($countries);

?>
