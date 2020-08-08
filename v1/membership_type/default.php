<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$membership_type_id = getRequest( $path, "membership_type" ); // IN
if ($membership_type_id < 1) $membership_type_id = 0;
$membership_type = array(); // OUT

$params_types = 'i';
$params = array( $membership_type_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_membership_type WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($membership_type_id > 0) {
    $membership_type = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($membership_type) == 0) {
    $membership_type = array(
        'error' => '(message 2) membership_type not found'
    );
} elseif (sizeof($membership_type) == 1) {
    $membership_type = $membership_type[0];
}

echo json_encode($membership_type);

?>