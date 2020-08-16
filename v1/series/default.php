<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';

/** Get params **/
$series_id = getRequest( $path, "series" ); // IN
if ($series_id < 1) $series_id = 0;
$series = array(); // OUT

$params_types = 'i';
$params = array( $series_id );

/** Set query and update params as needed **/
$request = $_SERVER['REQUEST_URI'];
if ($series_id > 0 && strpos($request, 'brand_emblems') !== false ) { //found it
	$query = "SELECT i.brand_id,
		IFNULL(b.`name`,\"no publisher's brand\") AS brand_name,
		count(i.brand_id) AS brand_issue_count
	FROM " . $DBName . ".gcd_series s
	INNER JOIN " . $DBName . ".gcd_issue i ON i.series_id = s.id
	LEFT JOIN " . $DBName . ".gcd_brand b ON b.id = i.brand_id
	WHERE s.id = ?
	GROUP BY i.brand_id
	ORDER BY b.year_began;";
} elseif ($series_id > 0 && strpos($request, 'indicia_publishers') !== false ) { //found it
	$query = "SELECT i.indicia_publisher_id, 
		IFNULL(ip.`name`,\"no publisher's brand\") AS indicia_publisher_name, 
		count(i.indicia_publisher_id) AS indicia_publisher_issue_count
	FROM " . $DBName . ".gcd_series s
	INNER JOIN " . $DBName . ".gcd_issue i ON i.series_id = s.id
	LEFT JOIN " . $DBName . ".gcd_indicia_publisher ip ON ip.id = i.indicia_publisher_id
	WHERE s.id = ?
	GROUP BY i.indicia_publisher_id
	ORDER BY ip.year_began;";
} elseif ($series_id > 0 && strpos($request, 'awards') !== false ) { //found it
	$query = "SELECT a.id as award_id,
		a.`name` as award_name, 
		ra.id AS received_award_id,
		ra.`award_name` AS received_award_name,
		ra.award_year AS received_award_year    
	FROM " . $DBName . ".gcd_series s
	INNER JOIN " . $DBName . ".gcd_received_award ra ON ra.object_id = s.id
	INNER JOIN " . $DBName . ".gcd_award a ON a.id = ra.award_id
	WHERE s.id = ?
	GROUP BY s.id;";
} elseif ($series_id > 0 && strpos($request, 'bonds') !== false ) { //found it
	$params_types = 'iiii';
	$params = array( $series_id, $series_id, $series_id, $series_id );
	$query = "(SELECT sb.id, 
		sb.origin_id, CONCAT(series_from.name,' (',publisher_from.name,', ',series_from.year_began,' series)') AS origin_id_seriesname, 
		sb.target_id, CONCAT(series_to.name,' (',publisher_to.name,', ',series_to.year_began,' series)') AS target_id_seriesname, 
		sb.origin_issue_id, issue_from.number AS origin_issue_id_number, 
		sb.target_issue_id, issue_to.number AS target_issue_number, 
		sb.bond_type_id, 1 AS match_type_custom, 
		issue_to.sort_code AS sort_code_custom, 
		CONCAT('numbering continues with #', issue_to.number, ' from ', series_from.name, ' (', series_from.year_began, ' series) #', issue_from.number) AS bond_description_custom
	FROM " . $DBName . ".gcd_series_bond sb
	INNER JOIN " . $DBName . ".gcd_issue issue_to ON issue_to.id = sb.target_issue_id
	INNER JOIN " . $DBName . ".gcd_series series_to ON series_to.id = sb.target_id
	INNER JOIN " . $DBName . ".gcd_publisher publisher_to ON publisher_to.id = series_to.publisher_id
	INNER JOIN " . $DBName . ".gcd_issue issue_from ON issue_from.id = sb.origin_issue_id
	INNER JOIN " . $DBName . ".gcd_series series_from ON series_from.id = sb.origin_id
	INNER JOIN " . $DBName . ".gcd_publisher publisher_from ON publisher_from.id = series_from.publisher_id
	WHERE 
		sb.target_id = ?
	)	
	UNION
	(SELECT sb.id, 
		sb.origin_id, CONCAT(series_from.name,' (',publisher_from.name,', ',series_from.year_began,' series)') AS origin_id_seriesname, 
		sb.target_id, CONCAT(series_to.name,' (',publisher_to.name,', ',series_to.year_began,' series)') AS target_id_seriesname, 
		sb.origin_issue_id, issue_from.number AS origin_issue_id_number, 
		sb.target_issue_id, issue_to.number AS target_issue_number, 
		sb.bond_type_id, 2 AS match_type_custom,
		issue_from.sort_code AS sort_code_custom, 
		CONCAT('numbering continues after #', issue_from.number, ' with ', series_to.name, ' (', series_to.year_began, ' series) #', issue_to.number) AS bond_description_custom
	FROM " . $DBName . ".gcd_series_bond sb
	INNER JOIN " . $DBName . ".gcd_issue issue_to ON issue_to.id = sb.target_issue_id
	INNER JOIN " . $DBName . ".gcd_series series_to ON series_to.id = sb.target_id
	INNER JOIN " . $DBName . ".gcd_publisher publisher_to ON publisher_to.id = series_to.publisher_id
	INNER JOIN " . $DBName . ".gcd_issue issue_from ON issue_from.id = sb.origin_issue_id
	INNER JOIN " . $DBName . ".gcd_series series_from ON series_from.id = sb.origin_id
	INNER JOIN " . $DBName . ".gcd_publisher publisher_from ON publisher_from.id = series_from.publisher_id
	WHERE 
		sb.origin_id = ?
	)	
	UNION
	( # ...and where there are SOME null issues
	SELECT sb.id, 
		sb.origin_id, CONCAT(series_from.name,' (',publisher_from.name,', ',series_from.year_began,' series)') AS origin_id_seriesname, 
		sb.target_id, CONCAT(series_to.name,' (',publisher_to.name,', ',series_to.year_began,' series)') AS target_id_seriesname, 
		sb.origin_issue_id, 'null' AS origin_issue_id_number, 
		sb.target_issue_id, 'null' AS target_issue_number, 
		sb.bond_type_id, 3 AS match_type_custom,
		'null' AS sort_code_custom, 
		CONCAT('numbering continues from ', series_from.name, ' (', series_from.year_began, ' series)') AS bond_description_custom
	FROM " . $DBName . ".gcd_series_bond sb
	INNER JOIN " . $DBName . ".gcd_series series_to ON series_to.id = sb.target_id
	INNER JOIN " . $DBName . ".gcd_publisher publisher_to ON publisher_to.id = series_to.publisher_id
	INNER JOIN " . $DBName . ".gcd_series series_from ON series_from.id = sb.origin_id
	INNER JOIN " . $DBName . ".gcd_publisher publisher_from ON publisher_from.id = series_from.publisher_id
	WHERE 
		( sb.target_issue_id IS NULL 
			OR sb.origin_issue_id IS NULL ) 
		AND
		sb.target_id = ? 
	)
	UNION
	( # ...and where there are SOME null issues
	SELECT sb.id, 
		sb.origin_id, CONCAT(series_from.name,' (',publisher_from.name,', ',series_from.year_began,' series)') AS origin_id_seriesname, 
		sb.target_id, CONCAT(series_to.name,' (',publisher_to.name,', ',series_to.year_began,' series)') AS target_id_seriesname, 
		sb.origin_issue_id, 'null' AS origin_issue_id_number, 
		sb.target_issue_id, 'null' AS target_issue_number, 
		sb.bond_type_id, 4 AS match_type_custom,
		'null' AS sort_code_custom, 
		CONCAT('numbering continues with ', series_to.name, ' (', series_to.year_began, ' series)') AS bond_description_custom
	FROM " . $DBName . ".gcd_series_bond sb
	INNER JOIN " . $DBName . ".gcd_series series_to ON series_to.id = sb.target_id
	INNER JOIN " . $DBName . ".gcd_publisher publisher_to ON publisher_to.id = series_to.publisher_id
	INNER JOIN " . $DBName . ".gcd_series series_from ON series_from.id = sb.origin_id
	INNER JOIN " . $DBName . ".gcd_publisher publisher_from ON publisher_from.id = series_from.publisher_id
	WHERE 
		( sb.target_issue_id IS NULL 
			OR sb.origin_issue_id IS NULL ) 
		AND
		sb.origin_id = ? 
	)
	ORDER BY sort_code_custom, match_type_custom;";
} else {
	$query = "SELECT * FROM " . $DBName . ".gcd_series WHERE id = ?";
};

/** Search by name 
 * example: /v1/series/?name=fantastic+four&page=2 **/
 if ($series_id == 0 && strpos($request, 'name') !== false ) { //found it

	$page = intval(isset($_GET['page']) ?$_GET['page'] : 0); if ($page < 1) $page = 1;
	$count = 25;
	$skip = ($page-1) * $count;
	$param = isset($_GET['name']) ?$_GET['name'] : ""; 
	$params_types = 'sii';
    $params = array( $param, $skip, $count );
    $query = "SELECT `id`, `name`, `year_began`, `publisher_id`, `country_id`
		FROM " . $DBName . ".gcd_series WHERE INSTR( `name`, ? ) > 0 
		ORDER BY `issue_count` DESC, `year_began`
		LIMIT ?, ?";

	if ( $param == "" || strlen($param)<2 ) { $series_id=0; } else { $series_id=1; } 

}

if (false) {echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL;}

/** Fetch data **/
if ($series_id > 0) {
    $series = getData( $mysqli, $query, $params, $params_types );
}

/** Display **/
if (sizeof($series) == 0) {
    $series = array(
        'error' => '(message 2) series not found'
    );
} elseif (is_null($issue[0])) {
    $issue = array(
        'error' => '(message 3) sql prepare failed'
    );
} elseif (sizeof($series) == 1) {
    $series = $series[0];
}

echo json_encode($series);

?>
