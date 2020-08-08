<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$issue_id = getRequest( $path, "issue" ); // IN
if ($issue_id < 1) $issue_id = 0;
$issue = array(); // OUT

$params_types = 'i';
$params = array( $issue_id );

/** Set query and update params as needed **/
$request = $_SERVER['REQUEST_URI'];
if ($issue_id > 0 && strpos($request, 'issue_reprints') !== false ) { //found it
	$query = "SELECT * FROM " . $DBName . ".gcd_issue WHERE id = ?";  //  IN PROGRESS !!!
} else {
	$query = "SELECT * FROM " . $DBName . ".gcd_issue WHERE id = ?";
};
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($issue_id > 0) {
    $issue = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($issue) == 0) {
    $issue = array(
        'error' => '(message 2) issue not found'
    );
} elseif (sizeof($issue) == 1) {
    $issue = $issue[0];
}

echo json_encode($issue);

?>