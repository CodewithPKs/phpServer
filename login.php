<?php

require "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['userPassword'])) {
        $email = $_POST['email'];
        $userPassword = $_POST['userPassword'];
            // checking for valid user details 
            $sql = "SELECT * FROM `users` WHERE users.email='$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($user__data = $result->fetch_assoc()) {
                    if (password_verify($userPassword, $user__data['password'])) {
                        $user__object = array(
                            "username"=>$user__data['username'],
                            "email"=>$user__data['email']
                        );
                        http_response_code(200);
                        $server__response__success = array(
                            "code" => http_response_code(200),
                            "status" => true,
                            "message" => "User Verified" ,
                            "id"=>$user__data['id'],
                            "name"=>$user__data['username'],
                            "mobile"=>$user__data['mobile'],
                        );
                        echo json_encode($server__response__success);
                    } else {
                        http_response_code(404);
                        $server__response__error = array(
                            "code" => http_response_code(404),
                            "status" => false,
                            "message" => "Opps!! Incorrect Login Credentials"
                        );
                        echo json_encode($server__response__error);
                    }
                }
            } else {
                http_response_code(404);
                $server__response__error = array(
                    "code" => http_response_code(404),
                    "status" => false,
                    "message" => "Opps!! Incorrect Login Credentials"
                );
                echo json_encode($server__response__error);
            }
    } else {
        http_response_code(404);
        $server__response__error = array(
            "code" => http_response_code(404),
            "status" => false,
            "message" => "Invalid API parameters! Please contact the administrator or refer to the documentation for assistance."
        );
        echo json_encode($server__response__error);
    }
} else {
    http_response_code(404);
    $server__response__error = array(
        "code" => http_response_code(404),
        "status" => false,
        "message" => "Bad Request"
    );
    echo json_encode($server__response__error);
}