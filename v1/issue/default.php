<?php
require_once dirname(dirname(__DIR__)) . '/inc/environment.php';
require_once dirname(dirname(__DIR__)) . '/inc/queries.php';
$method = "issue";
$table = $DBName . ".gcd_issue";

/****** 
 * Get params and default query **/
$param_id = getRequest( $path, $method ); // IN
if ( 1 > $param_id ) $param_id = 0;
$results_array = array(); // OUT
$params_types = 'i';
$params = array( $param_id );
$query = "SELECT * FROM " . $table . " WHERE deleted = 0 AND id = ?";
$contains_json_as_subquery = false;

/****** 
 * CUSTOMIZATIONS need updates and additions */
if ($param_id > 0 && strpos($request, 'indicia_printer') !== false ) {
    $query = get_issue_indicia_printer_sql;
} // example: /v1/issue/114119/indicia_printer

if ($param_id > 0 && strpos($request, 'issue_reprints') !== false ) {
    $query = get_issue_issue_reprints_sql;
} // example: /v1/issue/391286/issue_reprints

if ($param_id > 0 && strpos($request, 'reprints_from_issue') !== false ) {
    $query = get_issue_reprints_from_issue_sql;
} // example: /v1/issue/536367/reprints_from_issue

if ($param_id > 0 && strpos($request, 'reprints_to_issue') !== false ) {
    $query = get_issue_reprints_to_issue_sql;
} // example: /v1/issue/636292/reprints_to_issue

if ( $param_id == 0 && strpos( $request, 'barcode' ) !== false ) {
    $page = intval( isset( $_GET['page'] ) ?$_GET['page'] : 0 ); if ( $page < 1 ) $page = 1;
    $count = 25;	
    $skip = ( $page-1 ) * $count;
    $param = isset( $_GET['barcode'] ) ?preg_replace('/[^0-9]+/', '', $_GET['barcode']) : ""; 
    $params_types = 'sii';
    $params = array( $param, $skip, $count );
    $query = $get_issue_by_barcode_paged_sql;
    if ( $param == "" || strlen( $param ) < 2 ) { $param_id = 0; } else { $param_id = 1; } 
} // example: /v1/issue/?barcode=76194120001990111

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