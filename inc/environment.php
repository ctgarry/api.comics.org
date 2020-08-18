<?php
header('Content-Type: application/json;charset=utf-8');
$request = $_SERVER['REQUEST_URI'];

/********************************************
 ** Environments and data source **/
if ($_SERVER['HTTP_HOST'] == 'localhost') {
	// set include, fix param, and set alternate db
    require_once dirname(dirname(__DIR__)) . '\cgi-bin\inc.database.php';
    $path = '/blackbox/bymonth/api/v1/';
	$DBName = 'gcdprod';
} else {
	// set include, and fix param
    require_once dirname(dirname(__DIR__)) . '/cgi-bin/inc.database.php';
    $path = '/api/v1/';
}

$mysqli = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
if (mysqli_connect_errno()) {
    exit('Error connecting to database'); 
}


/********************************************
 **  functions **/
function getRequest($path, $method, $verbose=false) {

    $uri = $_SERVER['REQUEST_URI']; // local
	if ($verbose) { echo '{"request": ' . json_encode($uri) . '},' . PHP_EOL; }
    $uri = str_replace( $path . $method . '/', '', $uri);
    if ($verbose) { echo '{"corrected request": ' . json_encode($uri) . '},' . PHP_EOL; }
    $getRequest = intval(isset($uri) ? $uri : 0); 
    if ($verbose) { echo '{"'.$method.'_id": ' . json_encode($getRequest) . '},' . PHP_EOL; }
    return $getRequest;

}

function getData( $conn, $query, $params='', $params_types='' ) {

    if ( $stmt = $conn->prepare($query) ) {
        if ( gettype($params) == "array" ) {
            $stmt->bind_param($params_types, ...$params);
        }
        $stmt->execute();

        $result = $stmt->result_metadata();
        while ($field = $result->fetch_field()) {
            $pointers[] = & $row[$field->name]; // pass by reference
        }
        $result->free_result();

        $stmt->bind_result(...$pointers);

        while ($stmt->fetch()) {
            $c = array();
            foreach ($row as $key => $val) { $c[$key] = $val; }
            $getData[] = array_map('utf8_encode', $c); // solves empty json translation
        }

        $stmt->free_result();
        $stmt->close();

    } else {
        $getData = array(
            'error' => 'params "' . $params . '" not found (message 1)'
        );
    };

    $conn->close();

    return $getData;
}

?>