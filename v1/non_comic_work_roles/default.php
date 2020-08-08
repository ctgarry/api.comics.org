<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$non_comic_work_roles = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_non_comic_work_role";

/** Fetch data **/
$non_comic_work_roles = getData( $mysqli, $query );

/** Display **/
if (sizeof($non_comic_work_roles) == 0) {
    $non_comic_work_roles = array(
        'error' => '(message 2) non_comic_work_roles not found'
    );
} elseif (sizeof($non_comic_work_roles) == 1) {
    $non_comic_work_roles = $non_comic_work_roles[0];
}

echo json_encode($non_comic_work_roles);

?>
