<?php
error_reporting(E_ALL);
ini_set('display_error',1);
session_start();
//panggil library
require_once('nusoap-0.9.5/lib/nusoap.php');
//mendefinisikan alamat url service yang disediakan oleh client 
$url = 'http://localhost/SIT/server.php?wsdl';
// $client = new soapclient($url); 
$client = new nusoap_client($url, 'WSDL');
$username =  isset($_POST["username"]) ? $_POST["username"] : 'admin' ;
$password =  isset($_POST["password"]) ? $_POST["password"] :  'admin' ;
$result = $client->call('loginService', array('username'=>$username, 'password'=>$password));
// echo '<pre>';print_r($client->response);echo '</pre>';
if($result == 'welcome, '.$username."..!"){ 
  $_SESSION['username'] = $username; 
  header ("location:index.php");
} else{
  header ("location:login.php"); 
}
?>