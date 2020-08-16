<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$languages = array(); // OUT

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".stddata_language";

/** Fetch data **/
$languages = getData( $mysqli, $query );

/** Display **/
if (sizeof($languages) == 0) {
    $languages = array(
        'error' => '(message 2) languages not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($languages) == 1) {
    $languages = $languages[0];
}

echo json_encode($languages);

?>
