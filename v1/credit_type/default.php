<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$credit_type_id = getRequest( $path, "credit_type" ); // IN
if ($credit_type_id < 1) $credit_type_id = 0;
$credit_type = array(); // OUT

$params_types = 'i';
$params = array( $credit_type_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_credit_type WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($credit_type_id > 0) {
    $credit_type = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($credit_type) == 0) {
    $credit_type = array(
        'error' => '(message 2) credit_type not found'
    );
} elseif (sizeof($credit_type) == 1) {
    $credit_type = $credit_type[0];
}

echo json_encode($credit_type);

?>