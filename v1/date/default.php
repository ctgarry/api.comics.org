<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$date_id = getRequest( $path, "date" ); // IN
if ($date_id < 1) $date_id = 0;
$date = array(); // OUT

$params_types = 'i';
$params = array( $date_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".stddata_date WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($date_id > 0) {
    $date = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($date) == 0) {
    $date = array(
        'error' => '(message 2) date not found'
    );
} elseif (sizeof($date) == 1) {
    $date = $date[0];
}

echo json_encode($date);

?>