<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$series_bond_type_id = getRequest( $path, "series_bond_type" ); // IN
if ($series_bond_type_id < 1) $series_bond_type_id = 0;
$series_bond_type = array(); // OUT

$params_types = 'i';
$params = array( $series_bond_type_id );
$query = "SELECT * FROM " . $DBName . ".gcd_series_bond_type WHERE id = ?";

/** Fetch data **/
if ($series_bond_type_id > 0) {
    $series_bond_type = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($series_bond_type) == 0) {
    $series_bond_type = array(
        'error' => '(message 2) series_bond_type not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($series_bond_type) == 1) {
    $series_bond_type = $series_bond_type[0];
}

echo json_encode($series_bond_type);

?>
