<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$series_publication_type_id = getRequest( $path, "series_publication_type" ); // IN
if ($series_publication_type_id < 1) $series_publication_type_id = 0;
$series_publication_type = array(); // OUT

$params_types = 'i';
$params = array( $series_publication_type_id );
$query = "SELECT * FROM " . $DBName . ".gcd_series_publication_type WHERE id = ?";

/** Fetch data **/
if ($series_publication_type_id > 0) {
    $series_publication_type = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($series_publication_type) == 0) {
    $series_publication_type = array(
        'error' => '(message 2) series_publication_type not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($series_publication_type) == 1) {
    $series_publication_type = $series_publication_type[0];
}

echo json_encode($series_publication_type);

?>
