<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$printer_id = getRequest( $path, "printer" ); // IN
if ($printer_id < 1) $printer_id = 0;
$printer = array(); // OUT

$params_types = 'i';
$params = array( $printer_id );

/** Set query and update params as needed **/
$request = $_SERVER['REQUEST_URI'];
/** Get indicia_printers
 * example: /v1/printer/9/indicia_printers **/
 if ($printer_id > 0 && strpos($request, 'indicia_printers') !== false ) { //found it
    $query = "SELECT ip.`id`, ip.`name` FROM " . $DBName . ".gcd_indicia_printer ip
    INNER JOIN " . $DBName . ".gcd_printer pr ON pr.`id` = ip.`parent_id`
    WHERE ip.`parent_id` = ?";
} else {
    $query = "SELECT * FROM " . $DBName . ".gcd_printer WHERE id = ?";
};

/** Search by name 
 * example: /v1/printer/?name=hemmets&page=1 **/
if ( $printer_id == 0 && strpos($request, 'name') !== false ) { //found it

	$page = intval(isset($_GET['page']) ?$_GET['page'] : 0); if ($page < 1) $page = 1;
	$count = 25;	
	$skip = ($page-1) * $count;
	$param = isset($_GET['name']) ?$_GET['name'] : ""; 
	$params_types = 'sii';
    $params = array( $param, $skip, $count );
    $query = "SELECT `id`, `name`, `year_began`, `country_id`
		FROM " . $DBName . ".gcd_printer WHERE INSTR( `name`, ? ) > 0 
		ORDER BY `issue_count` DESC, `year_began`
		LIMIT ?, ?";
		
    if ( $param == "" || strlen($param)<2 ) { $printer_id=0; } else { $printer_id=1; } 

}
if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($printer_id > 0) {
    $printer = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($printer) == 0) {
    $printer = array(
        'error' => '(message 2) printer not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($printer) == 1) {
    $printer = $printer[0];
}

echo json_encode($printer);

?>