<?php 
session_start();
$HASHING_METHOD = 'sha512'; // md5,sha1

// This response.php used to receive and validate response.
if(!isset($_SESSION['SECRET_KEY']) || empty($_SESSION['SECRET_KEY']))
$_SESSION['SECRET_KEY'] = ''; //set your secretkey here
	
$hashData = $_SESSION['SECRET_KEY'];
ksort($_POST);
foreach ($_POST as $key => $value){
	if (strlen($value) > 0 && $key != 'SecureHash') {
		$hashData .= '|'.$value;
	}
}
if (strlen($hashData) > 0) {
	$secureHash = strtoupper(hash($HASHING_METHOD , $hashData));
	
	if($secureHash == $_POST['SecureHash']){
		
		if($_POST['ResponseCode'] == 0){
			// update response and the order's payment status as SUCCESS in to database
			
			//for demo purpose, its stored in session
			$_POST['paymentStatus'] = 'SUCCESS';
			$_SESSION['paymentResponse'][$_POST['PaymentID']] = $_POST;
			
		} else {
			// update response and the order's payment status as FAILED in to database
			
			//for demo purpose, its stored in session
			$_POST['paymentStatus'] = 'FAILED';
			$_SESSION['paymentResponse'][$_POST['PaymentID']] = $_POST;
		}
		// Redirect to confirm page with reference.
		$confirmData = array();
		$confirmData['PaymentID'] = $_POST['PaymentID'];
		$confirmData['Status'] = $_POST['paymentStatus'];
		$confirmData['Amount'] = $_POST['Amount'];
		
		$hashData = $_SESSION['SECRET_KEY'];

		ksort($confirmData);
		foreach ($confirmData as $key => $value){
			if (strlen($value) > 0) {
				$hashData .= '|'.$value;
			}
		}
		if (strlen($hashData) > 0) {
			$secureHash = strtoupper(hash($HASHING_METHOD , $hashData));
		}
?>
		<html>
		<body onLoad="document.payment.submit();">
		<form action="confirm.php" name="payment" method="POST">
<?php
			foreach($confirmData as $key => $value) {
?>
		<input type="hidden" value="<?php echo $value;?>" name="<?php echo $key;?>"/>
<?php
			}
?>
		<input type="hidden" value="<?php echo $secureHash; ?>" name="SecureHash"/>
		</form>
		</body>
		</html>
<?php

	} else {
		echo '<h1>Error!</h1>';
		echo '<p>Hash validation failed</p>';
	}
} else {
	echo '<h1>Error!</h1>';
	echo '<p>Invalid response</p>';
}
?>