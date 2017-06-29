<?php
//if(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] != "")){
/*if(isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] == 443)){
	$redirect = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header("Location: $redirect");
	//exit(1);
}*/

ini_set('date.timezone','Asia/Calcutta');
date_default_timezone_set( 'Asia/Calcutta' );
//ob_start( 'ob_gzhandler' );
if (extension_loaded('zlib')) { 
	ob_end_clean(); 
	ob_start('ob_gzhandler'); 
} 
define( 'DS' , DIRECTORY_SEPARATOR );
define( 'HOME_PATH' , __DIR__ );
define( 'HTML_UPLOAD_PATH' , HOME_PATH . DS . 'uploads' . DS );
define( 'HTML_TMP_PATH' , HOME_PATH . DS . 'tmp' . DS );
define( 'HTML_MAIN_PATH' , dirname( HOME_PATH ) . DS );

$pos	= stripos( PHP_OS, 'WIN' );
global $db;

// will work as long as local dev env. is WINDOWS & prod env is LINUX
if( $pos === false ) {
	$is_localhost	= 0; // server
} else {
	$is_localhost	= 1; // local
}

if( $is_localhost ) { //testing phase
	ini_set( 'display_errors', 1 );
	ini_set( 'error_reporting', E_ALL );
	ini_set( 'memory_limit', '-1' );
	ini_set( 'max_execution_time', '-1' );

	$hostname	= 'localhost';
	$username	= 'root';
	$password	= 'geetha12';
	$database	= 'practise';
	$pd_connect = 'mysql:host=' . $hostname . ';dbname=' . $database;
} else { //production server
	ini_set( 'display_errors', 0 );
	ini_set( 'error_reporting', E_ALL ^ E_DEPRECATED );
	ini_set( 'log_errors', 1 );
	ini_set( 'error_log', HOME_PATH . DS . 'browserErrorLog' );

	$hostname	= 'productionserverIPaddress';
	$username	= 'username';
	$password	= 'password';
	$database	= 'employeetable';
	$pd_connect = 'mysql:host=' . $hostname . ';dbname=' . $database;
}

try {
	$db = new PDO($pd_connect, $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

function __autoload( $class ) {
	if( file_exists( $class . '.php' ) ) {
		require_once $class . '.php';
	} else {
		die( 'No such file.' );
	}
}

function cleanup( $str ) {
	$str = trim( $str );
	$regex = <<<'END'
/
(
(?: [\x00-\x7F]                 # single-byte sequences   0xxxxxxx
|   [\xC0-\xDF][\x80-\xBF]      # double-byte sequences   110xxxxx 10xxxxxx
|   [\xE0-\xEF][\x80-\xBF]{2}   # triple-byte sequences   1110xxxx 10xxxxxx * 2
|   [\xF0-\xF7][\x80-\xBF]{3}   # quadruple-byte sequence 11110xxx 10xxxxxx * 3 
)+                              # ...one or more times
)
| .                                 # anything else
/x
END;

	return preg_replace( $regex, '$1', $str );
}
?>