<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$membership_types = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_membership_type";

/** Fetch data **/
$membership_types = getData( $mysqli, $query );

/** Display **/
if (sizeof($membership_types) == 0) {
    $membership_types = array(
        'error' => '(message 2) membership_types not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($membership_types) == 1) {
    $membership_types = $membership_types[0];
}

echo json_encode($membership_types);

?>
