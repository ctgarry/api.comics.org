<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';
require_once dirname(dirname(__DIR__)) . '/inc/queries.php';
$method = "creator";
$table = $DBName . ".gcd_creator";

/******
 * Get params and default query **/
$param_id = getRequest( $path, $method ); // IN
if ( 1 > $param_id ) $param_id = 0;
$results_array = array(); // OUT
$params_types = 'i';
$params = array( $param_id );
$query = "SELECT * FROM " . $table . " WHERE deleted = 0 AND id = ?";

/******
 * Customizations need updates and additions **/
if ( $param_id == 0 && strpos( $request, 'name' ) !== false ) {
    $page = intval( isset( $_GET['page'] ) ?$_GET['page'] : 0 ); if ( $page < 1 ) $page = 1;
    $count = 25;	
    $skip = ( $page-1 ) * $count;
    $param = isset( $_GET['name'] ) ?$_GET['name'] : ""; 
    $params_types = 'sii';
    $params = array( $param, $skip, $count );
    $query = $get_creator_by_name_paged_sql;
    if ( $param == "" || strlen( $param ) < 2 ) { $param_id = 0; } else { $param_id = 1; } 
} // example: /v1/creator/?name=simmons&page=2

if ( $param_id > 0 && strpos( $request, 'names' ) !== false ) {
    $query = $get_creator_names_sql;
} // example: /v1/creator/14078/names

if ( $param_id > 0 && strpos( $request, 'schools' ) !== false ) {
    $query = $get_creator_schools_sql;
} // example: /v1/creator/14078/schools

if ( $param_id > 0 && strpos( $request, 'degrees' ) !== false ) {
    $query = $get_creator_degrees_sql;
} // example: /v1/creator/14078/degrees

if ( $param_id > 0 && strpos( $request, 'signatures' ) !== false ) {
    $query = $get_creator_signatures_sql;
} // example: /v1/creator/65/signatures

if ( $param_id > 0 && strpos( $request, 'awards' ) !== false ) {
    $query = $get_creator_awards_sql;
} // example: /v1/creator/14078/awards

if ( $param_id > 0 && strpos( $request, 'awards_for_stories' ) !== false ) {
    $query = $get_creator_awards_for_stories_sql;
} // example: /v1/creator/14078/awards_for_stories

if ( $param_id > 0 && strpos( $request, 'art_influences' ) !== false ) {
    $query = $get_creator_art_influences_sql;
    $contains_json_as_subquery = true;
} // example: /v1/creator/14078/art_influences

if ( $param_id > 0 && strpos( $request, 'memberships' ) !== false ) {
    $query = $get_creator_memberships_sql;
} // example: /v1/creator/14078/memberships

if ( $param_id > 0 && strpos( $request, 'non_comic_works' ) !== false ) {
    $query = $get_creator_non_comic_works_sql;
    $contains_json_as_subquery = true;
} // example: /v1/creator/14078/non_comic_works

if ( $param_id > 0 && strpos( $request, 'relations' ) !== false ) {
    $query = $get_creator_relations_sql_56;
    $contains_json_as_subquery = true;
} // example: /v1/creator/14078/relations

/******
 * Fetch data and make any fixes needed **/
if ( 0 < $param_id ) {
    $results_array = getData( $mysqli, $query, $params, $params_types );
    if ( $contains_json_as_subquery ) {
        foreach ( $results_array as $key => &$val ) {
            if ( !is_null( $val ) ) {
                foreach ( $val as $key1 => &$val1 ) {
                    if ( "_json" == substr( $key1,-5 ) ) {
                        $val[$key1] = json_decode( $val1 );
                    }
                }
            }
        }
    }
}

/******
 * Display **/
if ( 0 == sizeof( $results_array ) ) {
    $results_array = array( 'error' => $method . ' not found ( message 2 )' );
} elseif ( !isset( $results_array[0] ) ) {
    $results_array = array( 'error' => 'result is not set ( message 3 )' );
} elseif ( is_null( $results_array[0] ) ) {
    $results_array = array( 'error' => 'result is null ( message 4 )' );
} elseif ( 1 === sizeof( $results_array ) ) {
    $results_array = $results_array[0];
}

echo json_encode( $results_array );

?>