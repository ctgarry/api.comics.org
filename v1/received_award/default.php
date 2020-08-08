<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$received_award_id = getRequest( $path, "received_award" ); // IN
if ($received_award_id < 1) $received_award_id = 0;
$received_award = array(); // OUT

$params_types = 'i';
$params = array( $received_award_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_received_award WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($received_award_id > 0) {
    $received_award = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($received_award) == 0) {
    $received_award = array(
        'error' => '(message 2) received_award not found'
    );
} elseif (sizeof($received_award) == 1) {
    $received_award = $received_award[0];
}

echo json_encode($received_award);

?>