<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$non_comic_work_types = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_non_comic_work_type";

/** Fetch data **/
$non_comic_work_types = getData( $mysqli, $query );

/** Display **/
if (sizeof($non_comic_work_types) == 0) {
    $non_comic_work_types = array(
        'error' => '(message 2) non_comic_work_types not found'
    );
} elseif (sizeof($non_comic_work_types) == 1) {
    $non_comic_work_types = $non_comic_work_types[0];
}

echo json_encode($non_comic_work_types);

?>
