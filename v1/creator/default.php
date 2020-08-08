<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$creator_id = getRequest( $path, "creator" ); // IN
if ($creator_id < 1) $creator_id = 0;
$creator = array(); // OUT

$params_types = 'i';
$params = array( $creator_id );

/** Set query and update params as needed **/
$request = $_SERVER['REQUEST_URI'];
if ($issue_id > 0 && strpos($request, 'names') !== false ) { //found it
	$query = "SELECT * FROM " . $DBName . ".gcd_creator WHERE id = ?";  //  IN PROGRESS !!!
} else {
	$query = "SELECT * FROM " . $DBName . ".gcd_creator WHERE id = ?";
};

/** Search by name 
 * example: /v1/creator/?name=simmons&page=2 **/
if ( $creator_id == 0 && strpos($request, 'name') !== false ) { //found it

	$page = intval(isset($_GET['page']) ?$_GET['page'] : 0); if ($page < 1) $page = 1;
	$count = 25;	
	$skip = ($page-1) * $count;
	$param = isset($_GET['name']) ?$_GET['name'] : ""; 
	$params_types = 'sii';
    $params = array( $param, $skip, $count );
    $query = "SELECT c.`id`, c.`gcd_official_name`, c.`birth_country_id`
        FROM " . $DBName . ".gcd_creator c
        INNER JOIN " . $DBName . ".gcd_story_credit sc ON sc.creator_id = c.id
        WHERE INSTR( `gcd_official_name`, ? ) > 0 
		GROUP BY  c.id
        ORDER BY COUNT(sc.creator_id) DESC
		LIMIT ?, ?";

    if ( $param == "" || strlen($param)<2 ) { $creator_id=0; } else { $creator_id=1; } 

}

if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($creator_id > 0) {
    $creator = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($creator) == 0) {
    $creator = array(
        'error' => '(message 2) creator not found'
    );
} elseif (sizeof($creator) == 1) {
    $creator = $creator[0];
}

echo json_encode($creator);

?>