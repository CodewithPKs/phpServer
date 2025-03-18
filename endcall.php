<?php
require_once "vendor/autoload.php";
require "config.php";

$tokenid = $_POST['tokenid'];
$uuid = $_POST['callid'];

$sql = "SELECT `token` FROM `jwttokens` where `id`='$tokenid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $jwt = $row["token"];
  }

  $curls = curl_init();
        curl_setopt_array($curls, array(
        CURLOPT_URL => 'https://api.nexmo.com/v1/calls/'.$uuid,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS =>'{"action": "hangup"}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$jwt
        ),
        ));

        $responses = curl_exec($curls);
        curl_close($curls);
        
        echo json_encode(["message" => "Call Disconnected"], 200);

} else {

}
$conn->close();