<?php 

require "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        !empty($_POST['username']) && !empty($_POST['mobile']) && !empty($_POST['email'])
        && !empty($_POST['password'])
    ) {
        $username = $_POST['username'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $password	 = $_POST['password'];


        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                
            $sql = "SELECT * FROM `users` WHERE users.email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                http_response_code(404);
                $server__response__error = array(
                    "code" => http_response_code(404),
                    "status" => false,
                    "message" => "This user is already registered."
                );
                echo json_encode($server__response__error);

            } else {
                $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                
                $sql = "INSERT INTO `users`( `username`, `mobile`, `email`, `password` ) VALUES ('$username','$mobile','$email','$passwordhash')";
                if ($conn->query($sql) == TRUE) {
                    $server__response__success = array(
                        "code" => http_response_code(200),
                        "status" => true,
                        "id"=>$conn->insert_id,
                        "message" => "User successfully created."
                    );
                    echo json_encode($server__response__success);
                } else {
                    http_response_code(404);
                    $server__response__error = array(
                        "code" => http_response_code(404),
                        "status" => false,
                        "message" => "Failed to create user. Please try again."
                    );
                    echo json_encode($server__response__error);
                }
            }
    } else {
        http_response_code(404);
        $server__response__error = array(
            "code" => http_response_code(404),
            "status" => false,
            "message" => "Invalid API parameters! Please contact the administrator or refer to the documentation for assistance."
        );
        echo json_encode($server__response__error);
    } // end of Parameters IF Condition
} else {
    http_response_code(404);
    $server__response__error = array(
        "code" => http_response_code(404),
        "status" => false,
        "message" => "Bad Request"
    );
    echo json_encode($server__response__error);
}