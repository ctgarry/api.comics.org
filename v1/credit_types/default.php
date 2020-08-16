<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$credit_types = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_credit_type";

/** Fetch data **/
$credit_types = getData( $mysqli, $query );

/** Display **/
if (sizeof($credit_types) == 0) {
    $credit_types = array(
        'error' => '(message 2) credit_types not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($credit_types) == 1) {
    $credit_types = $credit_types[0];
}

echo json_encode($credit_types);

?>
