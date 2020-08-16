<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$scripts = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".stddata_script";

/** Fetch data **/
$scripts = getData( $mysqli, $query );

/** Display **/
if (sizeof($scripts) == 0) {
    $scripts = array(
        'error' => '(message 2) scripts not found'
    );
} elseif (sizeof($scripts) == 1) {
    $scripts = $scripts[0];
}

echo json_encode($scripts);

?>
