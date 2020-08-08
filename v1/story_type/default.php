<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$story_type_id = getRequest( $path, "story_type" ); // IN
if ($story_type_id < 1) $story_type_id = 0;
$story_type = array(); // OUT

$params_types = 'i';
$params = array( $story_type_id );
$query = "SELECT * FROM " . $DBName . ".gcd_story_type WHERE id = ?";

/** Fetch data **/
if ($story_type_id > 0) {
    $story_type = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($story_type) == 0) {
    $story_type = array(
        'error' => '(message 2) story_type not found'
    );
} elseif (sizeof($story_type) == 1) {
    $story_type = $story_type[0];
}

echo json_encode($story_type);

?>
