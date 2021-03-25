<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);*/


//echo "begin Test4 api";
/*echo '<pre>';
print_r($_SERVER);

echo '</pre>';*/

//ini_set('display_errors', 1);
define('WEBROOT',str_replace("index.php","",$_SERVER["SCRIPT_NAME"]));
define('ROOT',str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]));

//echo WEBROOT;
//echo ROOT;

require ('Config/db.php');
require ('Core/Controller.php');
require ('Core/Model.php');
require ('Core/View.php');
require ('request.php');
require ('router.php');
require_once 'dispatcher.php';
//echo '<pre>';
//echo "new dispatcher";
//echo '</pre>';
//$content_for_layout = "content_for_layout";
//require('Views/Layouts/default.php');


$dispatcher = new Dispatcher;

//file_put_contents("umitest", print_r([__FILE__.' '.__LINE__, get_defined_vars()], true).PHP_EOL, FILE_APPEND | LOCK_EX);
$dispatcher ->start();
?>

