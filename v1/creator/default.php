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
if ($creator_id > 0 && strpos($request, 'relations') !== false ) { //found it
    $query = "SELECT cr.id AS creator_relation_id, rt.`type` AS relation_type_type, 
            cr.to_creator_id,c.gcd_official_name AS to_creator_name,
            dt.`year` AS to_creator_birth_year, cr.notes AS creator_relation_notes,
            cnd.id AS using_creator_name_detail_id, cnd.`name` AS using_creator_name_detail_name
        FROM " . $DBName . ".gcd_creator_relation cr
        INNER JOIN " . $DBName . ".gcd_relation_type rt ON rt.id = cr.relation_type_id
        LEFT JOIN " . $DBName . ".gcd_creator c ON c.id = cr.to_creator_id
        LEFT JOIN " . $DBName . ".stddata_date dt ON dt.id = c.birth_date_id
        LEFT JOIN " . $DBName . ".gcd_creator_relation_creator_name crcn ON crcn.creatorrelation_id = cr.id
        LEFT JOIN " . $DBName . ".gcd_creator_name_detail cnd ON cnd.id = crcn.creatornamedetail_id
        WHERE cr.from_creator_id = ?";
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