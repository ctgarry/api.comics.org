<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$non_comic_work_role_id = getRequest( $path, "non_comic_work_role" ); // IN
if ($non_comic_work_role_id < 1) $non_comic_work_role_id = 0;
$non_comic_work_role = array(); // OUT

$params_types = 'i';
$params = array( $non_comic_work_role_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_non_comic_work_role WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($non_comic_work_role_id > 0) {
    $non_comic_work_role = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($non_comic_work_role) == 0) {
    $non_comic_work_role = array(
        'error' => '(message 2) non_comic_work_role not found'
    );
} elseif (sizeof($non_comic_work_role) == 1) {
    $non_comic_work_role = $non_comic_work_role[0];
}

echo json_encode($non_comic_work_role);

?>