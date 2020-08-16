<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$non_comic_work_type_id = getRequest( $path, "non_comic_work_type" ); // IN
if ($non_comic_work_type_id < 1) $non_comic_work_type_id = 0;
$non_comic_work_type = array(); // OUT

$params_types = 'i';
$params = array( $non_comic_work_type_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".gcd_non_comic_work_type WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($non_comic_work_type_id > 0) {
    $non_comic_work_type = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($non_comic_work_type) == 0) {
    $non_comic_work_type = array(
        'error' => '(message 2) non_comic_work_type not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($non_comic_work_type) == 1) {
    $non_comic_work_type = $non_comic_work_type[0];
}

echo json_encode($non_comic_work_type);

?>