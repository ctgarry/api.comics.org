<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$series_publication_types = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_series_publication_type";

/** Fetch data **/
$series_publication_types = getData( $mysqli, $query );

/** Display **/
if (sizeof($series_publication_types) == 0) {
    $series_publication_types = array(
        'error' => '(message 2) series_publication_types not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($series_publication_types) == 1) {
    $series_publication_types = $series_publication_types[0];
}

echo json_encode($series_publication_types);

?>
