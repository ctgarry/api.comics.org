<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$publisher_id = getRequest( $path, "publisher" ); // IN
if ($publisher_id < 1) $publisher_id = 0;
$publisher = array(); // OUT

$params_types = 'i';
$params = array( $publisher_id );

/** Set query and update params as needed **/
$request = $_SERVER['REQUEST_URI'];
if ($publisher_id > 0 && strpos($request, 'brand_groups') !== false ) { //found it
	$query = "SELECT * FROM " . $DBName . ".gcd_brand_group WHERE parent_id = ?";
} else {
	$query = "SELECT * FROM " . $DBName . ".gcd_publisher WHERE id = ?";
};

/** Search by name 
 * example: /v1/publisher/?name=dc&page=3 **/
if ( $publisher_id == 0 && strpos($request, 'name') !== false ) { //found it

	$page = intval(isset($_GET['page']) ?$_GET['page'] : 0); if ($page < 1) $page = 1;
	$count = 25;	
	$skip = ($page-1) * $count;
	$param = isset($_GET['name']) ?$_GET['name'] : ""; 
	$params_types = 'sii';
    $params = array( $param, $skip, $count );
    $query = "SELECT `id`, `name`, `year_began`, `country_id`
		FROM " . $DBName . ".gcd_publisher WHERE INSTR( `name`, ? ) > 0 
		ORDER BY `series_count` DESC, `issue_count` DESC, `year_began`
		LIMIT ?, ?";

    if ( $param == "" || strlen($param)<2 ) { $publisher_id=0; } else { $publisher_id=1; } 

}

if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($publisher_id > 0) {
    $publisher = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($publisher) == 0) {
    $publisher = array(
        'error' => '(message 2) publisher not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($publisher) == 1) {
    $publisher = $publisher[0];
}

echo json_encode($publisher);

?>