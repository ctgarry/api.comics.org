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
if ($issue_id > 0 && strpos($request, 'indicia_printer') !== false ) { //found it
    $query = "SELECT ip.`id`, ip.`name` FROM " . $DBName . ".gcd_issue_indicia_printer iip
        INNER JOIN gcdprod.gcd_indicia_printer ip ON iip.`indiciaprinter_id` = ip.`id`
        WHERE iip.`issue_id` = ?";
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