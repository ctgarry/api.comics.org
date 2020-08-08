<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$creator_school_id = getRequest( $path, "creator_school" ); // IN
if ($creator_school_id < 1) $creator_school_id = 0;
$creator_school = array(); // OUT

$params_types = 'i';
$params = array( $creator_school_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_creator_school WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($creator_school_id > 0) {
    $creator_school = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($creator_school) == 0) {
    $creator_school = array(
        'error' => '(message 2) creator_school not found'
    );
} elseif (sizeof($creator_school) == 1) {
    $creator_school = $creator_school[0];
}

echo json_encode($creator_school);

?>