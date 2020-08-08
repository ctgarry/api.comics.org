<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$tag_id = getRequest( $path, "tag" ); // IN
if ($tag_id < 1) $tag_id = 0;
$tag = array(); // OUT

$params_types = 'i';
$params = array( $tag_id );
$query = "SELECT * FROM " . $DBName . ".taggit_tag WHERE id = ?";

/** Fetch data **/
if ($tag_id > 0) {
    $tag = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($tag) == 0) {
    $tag = array(
        'error' => '(message 2) tag not found'
    );
} elseif (sizeof($tag) == 1) {
    $tag = $tag[0];
}

echo json_encode($tag);

?>
