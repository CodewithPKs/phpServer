<?php 
/* 
key : bf1910ba
secret : k1TvbMupR1WRpg2w
signed secret : JJ4fqQCF2E7nCW5HGYWNwuk7RI52051LE07X2EZ28vHcRYZX0F
MD5
appid : 50c87b6f-90e0-49b6-b5df-d7f00e5950fa

*/


require_once "vendor/autoload.php";
require "config.php";


use MiladRahimi\Jwt\Cryptography\Algorithms\Rsa\RS256Signer;
use MiladRahimi\Jwt\Cryptography\Algorithms\Rsa\RS256Verifier;
use MiladRahimi\Jwt\Cryptography\Keys\RsaPrivateKey;
use MiladRahimi\Jwt\Cryptography\Keys\RsaPublicKey;
use MiladRahimi\Jwt\Generator;
use MiladRahimi\Jwt\Parser;

$tono = $_POST['to_number'];
$selfno = $_POST['self_number'];

// Generate a token
$privateKey = new RsaPrivateKey('private.key');
$signer = new RS256Signer($privateKey);
$generator = new Generator($signer);
$jwt = $generator->generate(['application_id' => '50c87b6f-90e0-49b6-b5df-d7f00e5950fa', 'iat' => strtotime("now"),  'exp' => strtotime("+30 min"), 'jti' => uniqid() ]);

$_SESSION['jwt'] = $jwt;
$uuid = '';
$tokenid = 0;

$sql = "INSERT INTO jwttokens (`token`) VALUES ('$jwt')";
if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
}

function endcall($uuid, $jwt,$tokenid){
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
  
  echo json_encode(["message" => "Something Went Wrong! Please Try Later", "tokenid" => $tokenid, "status" => 0], 400);
}


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.nexmo.com/v1/calls',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "to": [{
    "type": "phone",
    "number": "'.$selfno.'"
  }],
  "from": {
    "type": "phone",
    "number": "12052673621"
  },
  "length_timer" : 7200,
  "ncco": [{
    "action": "talk",
    "loop": 0,
    "text": "   "
  },
  {
    "action": "conversation",
    "name": "waiting-room"
  }]
  
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer '.$jwt
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$response = json_decode($response);

if (property_exists($response, 'uuid')){

    $_SESSION['uuid'] = $response->uuid;
    $uuid = $response->uuid;
    

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.nexmo.com/v1/calls/'.$uuid,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer '.$jwt
      ),
    ));

    $response = json_encode(curl_exec($curl));

    curl_close($curl);
    if(property_exists($response, 'status') != "answered"){
      sleep(2);
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
    CURLOPT_POSTFIELDS =>'{
    "action": "transfer",
    "destination": {
        "type": "ncco",
        "ncco": [
            {
                "action": "talk",
                "text": "Please wait while we connect you"
            },
            {
                "action": "connect",
                "from":"12052673621",
                "endpoint": [
                {
                    "type": "phone",
                    "number": "'.$tono.'"
                }
                ]
            },
            {
                "action": "conversation",
                "name": "waiting-room"
            }
        ]
    }
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer '.$jwt
    ),
    ));

    $responses = json_encode(curl_exec($curls));
    curl_close($curls);

    if(property_exists($responses, 'type') && $responses->type == "BAD_REQUEST"){

        endcall($uuid,$jwt,$last_id);

    }else{
        echo json_encode(["message" => "Call Connecting Please Wait", "callid" => $uuid, "tokenid" => $last_id, "status" => 1], 200);
    }

}else{
  echo json_encode(["message" => "Something Went Wrong! Please Try Later", "tokenid" => $last_id, "status" => 0], 400);
}