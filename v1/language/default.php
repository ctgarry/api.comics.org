<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$language_id = getRequest( $path, "language" ); // IN
if ($language_id < 1) $language_id = 0;
$language = array(); // OUT

$params_types = 'i';
$params = array( $language_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".stddata_language WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($language_id > 0) {
    $language = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($language) == 0) {
    $language = array(
        'error' => '(message 2) language not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($language) == 1) {
    $language = $language[0];
}

echo json_encode($language);

?>