<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$indicia_printer_id = getRequest( $path, "indicia_printer" ); // IN
if ($indicia_printer_id < 1) $indicia_printer_id = 0;
$indicia_printer = array(); // OUT

$params_types = 'i';
$params = array( $indicia_printer_id );

/** Set query and update params as needed **/
$request = $_SERVER['REQUEST_URI'];
$query = "SELECT * FROM " . $DBName . ".gcd_indicia_printer WHERE id = ?";

/** Search by name 
 * example: /v1/indicia_printer/?name=egmont&page=1 **/
if ( $indicia_printer_id == 0 && strpos($request, 'name') !== false ) { //found it

	$page = intval(isset($_GET['page']) ?$_GET['page'] : 0); if ($page < 1) $page = 1;
	$count = 25;	
	$skip = ($page-1) * $count;
	$param = isset($_GET['name']) ?$_GET['name'] : ""; 
	$params_types = 'sii';
    $params = array( $param, $skip, $count );
    $query = "SELECT `id`, `name`, `year_began`, `country_id`
		FROM " . $DBName . ".gcd_indicia_printer WHERE INSTR( `name`, ? ) > 0 
		ORDER BY `issue_count` DESC, `year_began`
		LIMIT ?, ?";
		
    if ( $param == "" || strlen($param)<2 ) { $indicia_printer_id=0; } else { $indicia_printer_id=1; } 

}

if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($indicia_printer_id > 0) {
    $indicia_printer = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($indicia_printer) == 0) {
    $indicia_printer = array(
        'error' => '(message 2) indicia_printer not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) no results'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($indicia_printer) == 1) {
    $indicia_printer = $indicia_printer[0];
}

echo json_encode($indicia_printer);

?>