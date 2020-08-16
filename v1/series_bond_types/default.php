<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$series_bond_types = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_series_bond_type";

/** Fetch data **/
$series_bond_types = getData( $mysqli, $query );

/** Display **/
if (sizeof($series_bond_types) == 0) {
    $series_bond_types = array(
        'error' => '(message 2) series_bond_types not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($series_bond_types) == 1) {
    $series_bond_types = $series_bond_types[0];
}

echo json_encode($series_bond_types);

?>
