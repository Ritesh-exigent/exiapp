<?php
$api_key = urlencode("NDQ2MjUwN2EzMzQzN2E1NTM1NTg0ZTUwMzYzNDcwNGQ=");
$sender = urlencode('TXTLCL');

$number = '91'.$_POST['number'];
$otp = $_POST['otp'];
$message = rawurlencode("Your Exigent login OTP is '$otp'");
$data = array('apikey'=>$api_key, 'numbers'=>array($number), 'sender'=>$sender, 'message'=>$message);
$ch = curl_init('https://api.textlocal.in/send/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
if($response)
echo json_encode(array('state'=>1, 'result'=>$response));
else
echo json_encode(array('state'=>0));
?>