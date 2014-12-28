<?php 

require_once("lib/nusoap.php");

?>

<html>
	<head>
		<title>Daftar ID Mahasiswa</title>
	</head>
	<body>
		<form action="book_client.php" method="POST">
			<input type="submit" name="submit" value="DAFTAR Mahasiswa">
		</form>
		
<?php

$url="http://localhost/wsData/server_2.php";
if(isset($_POST['submit'])){
	$client=new nusoap_client($url); //buat kelas nusoap untuk client
	$result=$client->call("getmhsId",array()); //panggil fungsi web servis nya
	$err=$client->getError(); //penanganan ERROR
	echo "<hr>";
	echo "SOAP Request";
	echo "<pre>".htmlentities($client->request)."</pre>";
	echo "SOAP Response";
	echo "<pre>".htmlentities($client->request)."</pre>";
	echo "<hr>";
	
	if($err){
		echo "<p><b>ERROR</b>".$client->getError()."</p>";
		} else {
		echo "<p><b>DAFTAR ID Mahasiswa</b></p>";
		for($i=0;$i<count($result);$i++){
		echo $result[$i]."<br>";
		}
		}
		}
?>
</body>
</html>

		