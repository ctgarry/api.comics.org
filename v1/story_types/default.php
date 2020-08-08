<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$story_types = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_story_type";

/** Fetch data **/
$story_types = getData( $mysqli, $query );

/** Display **/
if (sizeof($story_types) == 0) {
    $story_types = array(
        'error' => '(message 2) story_types not found'
    );
} elseif (sizeof($story_types) == 1) {
    $story_types = $story_types[0];
}

echo json_encode($story_types);

?>
