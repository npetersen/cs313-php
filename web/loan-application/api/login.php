<?php

    // Create or access a session
    session_start();

    // {
    //     "username":"user",
    //     "password":"password"
    // }
    
    // SET HEADER
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // INCLUDING DATABASE AND MAKING OBJECT
    require 'Database.php';
    $db_connection = new Database();
    $conn = $db_connection->dbConnection();
    
    // GET DATA FORM REQUEST
    $data = json_decode(file_get_contents("php://input"));
    
    //CREATE MESSAGE ARRAY AND SET EMPTY
    $msg['message'] = '';
    
    // CHECK IF RECEIVED DATA FROM THE REQUEST
    if (isset($data->username) && isset($data->password)) {
        // CHECK DATA VALUE IS EMPTY OR NOT
        if (!empty($data->username) && !empty($data->password)) {
            $sql = "SELECT display_name FROM public.user WHERE username = :username AND password = :password";
            $stmt = $conn->prepare($sql);
            // DATA BINDING
            $stmt->bindValue(':username', $data->username, PDO::PARAM_STR);
            $stmt->bindValue(':password', $data->password, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($stmt->rowCount()) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['displayName'] = $row['display_name'];
                $msg['message'] = 'User match found';
                $msg['display_name'] = $row['display_name'];
                $msg['loggedIn'] = $_SESSION['loggedIn'];
                http_response_code(200);
            } else {
                $_SESSION['loggedIn'] = false;
                $msg['message'] = 'User match not found';
                $msg['loggedIn'] = $_SESSION['loggedIn'];
                http_response_code(500);
            }
        } else {
            $_SESSION['loggedIn'] = false;
            $msg['message'] = 'Oops! empty field detected. Please provide all the necessary data.';
            $msg['loggedIn'] = $_SESSION['loggedIn'];
            http_response_code(500);
        }
    } else {
        $_SESSION['loggedIn'] = false;
        $msg['message'] = 'Please provide all the necessary data.';
        $msg['loggedIn'] = $_SESSION['loggedIn'];
        http_response_code(500);
    }
    
    //ECHO DATA IN JSON FORMAT
    echo  json_encode($msg);

?>