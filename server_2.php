<?php
// langkah1: buat/deklarasikan fungsi yang akan digunakan

function getmhsID(){
	mysql_connect("localhost","root","");
	mysql_select_db("no2") or die (mysql_error());
	$result=mysql_query("SELECT * FROM mhs");
	$index=0;
	while($data=mysql_fetch_array($result)){
	$mhsId[$index]=$data['nim'];
	
	$index++;
	}
	mysql_close();
	return $mhsId;   
		
}

//langkah2:load library nusoap
require_once("lib/nusoap.php");

//langkah3:buat object soap-server
$server=new soap_server();

//langkah4:buat konfigurasi WSDL-nya
$server->configureWSDL("mahasiswa","urn:mahasiswaService");

//langkah5:buat deklarasi tipe arraynya (buat tipe dat abaru)
$server->wsdl->addComplexType(
	"mhsID",
	"complexType",
	"array",
	"",
	"SOAP-ENC:Array",
	array(),
	array(
		array(
			"ref"=>"SOAP-ENC:arrayType",
			"wsdl:arrayType"=>"xsd:string[]"
			)
		),
		"xsd:string"
);

//langkah6:daftarkan fungsi web_service nya
$server->register(
	"getmhsId",
		array(),
		array("return"=>"tns:mhsID"),
		
		"urn:mahasiswaService",
		"urn:mahasiswaService#getmhsID"
		);
		
//langkah7:panggil fungsi $HTTP_RAW_POST_DATA
$HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA :"";

//langkah8:publish servicenya
$server->service($HTTP_RAW_POST_DATA);
?>
