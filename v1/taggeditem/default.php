<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$taggeditem_id = getRequest( $path, "taggeditem" ); // IN
if ($taggeditem_id < 1) $taggeditem_id = 0;
$taggeditem = array(); // OUT

$params_types = 'i';
$params = array( $taggeditem_id );
$query = "SELECT * FROM " . $DBName . ".taggit_taggeditem WHERE id = ?";

/** Fetch data **/
if ($taggeditem_id > 0) {
    $taggeditem = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($taggeditem) == 0) {
    $taggeditem = array(
        'error' => '(message 2) taggeditem not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($taggeditem) == 1) {
    $taggeditem = $taggeditem[0];
}

echo json_encode($taggeditem);

?>