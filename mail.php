<?php
$to = "sunnyg246@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: contact@weguarantee.in" . "\r\n" .
"CC: contact@sunnygulati.me";

mail($to,$subject,$txt,$headers);
?>