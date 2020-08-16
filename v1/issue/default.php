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
} elseif ($issue_id > 0 && strpos($request, 'issue_reprints') !== false ) { //found it
    $query = "SELECT ir.id, ir.origin_issue_id, ir.target_issue_id, 
            ir.notes, ir.reserved,
            \"Parts of this issue are reprinted in another issue\" AS description_custom
        FROM  " . $DBName . ".gcd_issue_reprint ir 
        WHERE ir.origin_issue_id = ?";
} elseif ($issue_id > 0 && strpos($request, 'reprints_from_issue') !== false ) { //found it
    $query = "SELECT rfi.id, rfi.origin_issue_id, stTo.issue_id AS to_issue, rfi.target_id,
            rfi.notes, rfi.reserved,
            \"Parts of this issue are reprinted to a specific STORY\" AS description_custom
        FROM " . $DBName . ".gcd_reprint_from_issue rfi 
        INNER JOIN `gcdprod`.gcd_story stTo ON stTo.id = rfi.target_id
        WHERE rfi.origin_issue_id = ?";
} elseif ($issue_id > 0 && strpos($request, 'reprints_to_issue') !== false ) { //found it
    $query = "SELECT rti.id, rti.origin_id, stFrom.issue_id AS from_issue, rti.target_issue_id,
            rti.notes, rti.reserved,
            \"Parts of this issue are reprinted from a specific story\" AS description_custom
        FROM " . $DBName . ".gcd_reprint_to_issue rti 
        INNER JOIN `gcdprod`.gcd_story stFrom ON stFrom.id = rti.origin_id
        WHERE rti.target_issue_id = ? ";
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