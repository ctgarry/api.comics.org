<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$award_id = getRequest( $path, "award" ); // IN
if ($award_id < 1) $award_id = 0;
$award = array(); // OUT

$params_types = 'i';
$params = array( $award_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_award WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($award_id > 0) {
    $award = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($award) == 0) {
    $award = array(
        'error' => '(message 2) award not found'
    );
} elseif (sizeof($award) == 1) {
    $award = $award[0];
}

echo json_encode($award);

?>