<?php 
session_start();
$HASHING_METHOD = 'sha512';  // md5,sha1

// This confirm.php used to show payment status and response parameters.
if(!isset($_SESSION['SECRET_KEY']) || empty($_SESSION['SECRET_KEY']))
	$_SESSION['SECRET_KEY'] = ''; //set your secretkey here
	
$hashData = $_SESSION['SECRET_KEY'];
$response = array();
print_r($_POST);

ksort($_POST);
foreach ($_POST as $key => $value){
	if (strlen($value) > 0 && $key != 'SecureHash') {
		$hashData .= '|'.$value;
	}
}
if (strlen($hashData) > 0) {
	$secureHash = strtoupper(hash($HASHING_METHOD , $hashData));
	
	if($secureHash != $_POST['SecureHash']){
		echo '<h1>Error!</h1>';
		echo '<p>Hash validation failed</p>';
		exit;
	} else {
		$response = $_SESSION['paymentResponse'][$_POST['PaymentID']];
	}
} else {
	echo '<h1>Error!</h1>';
	echo '<p>Invalid response</p>';
	exit;
}
?>
<HTML>
<HEAD>
<TITLE>PHP Integration Demo - Confirmation Page</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<style>
	h1       { font-family:Arial,sans-serif; font-size:24pt; color:#08185A; font-weight:100; margin-bottom:0.1em}
    h2.co    { font-family:Arial,sans-serif; font-size:24pt; color:#FFFFFF; margin-top:0.1em; margin-bottom:0.1em; font-weight:100}
    h3.co    { font-family:Arial,sans-serif; font-size:16pt; color:#000000; margin-top:0.1em; margin-bottom:0.1em; font-weight:100}
    h3       { font-family:Arial,sans-serif; font-size:16pt; color:#08185A; margin-top:0.1em; margin-bottom:0.1em; font-weight:100}
    body     { font-family:Verdana,Arial,sans-serif; font-size:11px; color:#08185A;}
	th 		 { font-size:12px;background:#015289;color:#FFFFFF;font-weight:bold;height:30px;}
	td 		 { font-size:12px;background:#DDE8F3}
	.pageTitle { font-size:24px;}
</style>
</HEAD>
<BODY LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 bgcolor="#ECF1F7">
<center>
<table width='100%' cellpadding='0' cellspacing="0" ><tr><th width='90%'>&nbsp;</th></tr></table>
	<center><h3>PHP Integration Kit - Confirmation Page </H3></center>
	<p align="center"><b>Payment Status : <?=$response['paymentStatus']?></b></p>
    <table width="600" cellpadding="2" cellspacing="2" border="0">
        <tr>
            <th colspan="2">Transaction Response</th>
        </tr>
<?php
		foreach( $response as $key => $value) {
			if($key == 'paymentStatus') continue;
?>			
        <tr>
            <td class="fieldName" width="50%"><?php echo $key; ?></td>
            <td class="fieldName" align="left" width="50%"><?php echo $value; ?></td>
        </tr>
<?php
		}
?>		
	</table>
</center>
<table width='100%' cellpadding='0' cellspacing="0" ><tr><th width='90%'>&nbsp;</th></tr></table>
</body>
</html>
