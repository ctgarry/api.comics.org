<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$script_id = getRequest( $path, "script" ); // IN
if ($script_id < 1) $script_id = 0;
$script = array(); // OUT

$params_types = 'i';
$params = array( $script_id );

/** Set query **/
$query = "SELECT * FROM " . $DBName . ".stddata_script WHERE id = ?";
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($script_id > 0) {
    $script = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($script) == 0) {
    $script = array(
        'error' => '(message 2) script not found'
    );
} elseif (sizeof($script) == 1) {
    $script = $script[0];
}

echo json_encode($script);

?>