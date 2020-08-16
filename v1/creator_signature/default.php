<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$creator_signature_id = getRequest( $path, "creator_signature" ); // IN
if ($creator_signature_id < 1) $creator_signature_id = 0;
$creator_signature = array(); // OUT

$params_types = 'i';
$params = array( $creator_signature_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_creator_signature WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($creator_signature_id > 0) {
    $creator_signature = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($creator_signature) == 0) {
    $creator_signature = array(
        'error' => '(message 2) creator_signature not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($creator_signature) == 1) {
    $creator_signature = $creator_signature[0];
}

echo json_encode($creator_signature);

?>