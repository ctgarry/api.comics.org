<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$story_id = getRequest( $path, "story" ); // IN
if ($story_id < 1) $story_id = 0;
$story = array(); // OUT

$params_types = 'i';
$params = array( $story_id );
$query = "SELECT * FROM " . $DBName . ".gcd_story WHERE id = ?";

/** Fetch data **/
if ($story_id > 0) {
    $story = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($story) == 0) {
    $story = array(
        'error' => '(message 2) story not found'
    );
} elseif (sizeof($story) == 1) {
    $story = $story[0];
}

echo json_encode($story);

?>
