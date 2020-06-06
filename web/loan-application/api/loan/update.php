<?php

    // {
    //     "loan_id": 3,
    //     "status": "approved"
    // }

    // SET HEADER
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: PUT");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // INCLUDING DATABASE AND MAKING OBJECT
    require '../Database.php';
    $db_connection = new Database();
    $conn = $db_connection->dbConnection();
    
    // GET DATA FORM REQUEST
    $data = json_decode(file_get_contents("php://input"));
    
    // CHECKING, IF ID AVAILABLE ON $data
    if (isset($data->loan_id)) {
        $msg['message'] = '';
        $loan_id = $data->loan_id;
        
        //GET LOAN BY ID FROM DATABASE
        $sql = "SELECT * FROM loanapp.loan WHERE id = :loan_id";
        $get_stmt = $conn->prepare($sql);
        $get_stmt->bindValue(':loan_id', $loan_id, PDO::PARAM_INT);
        $get_stmt->execute();
        
        // CHECK WHETHER THERE IS ANY LOAN IN THE DATABASE
        if ($get_stmt->rowCount() > 0) {
            // FETCH LOAN FROM DATBASE 
            $row = $get_stmt->fetch(PDO::FETCH_ASSOC);
            // CHECK, IF NEW UPDATE REQUEST DATA IS AVAILABLE THEN SET IT OTHERWISE SET OLD DATA
            $loan_status = isset($data->loan_status) ? $data->loan_status : $row['status'];
            
            $update_query = "UPDATE loanapp.loan SET status = :status WHERE id = :loan_id";
            $update_stmt = $conn->prepare($update_query);
            
            // DATA BINDING AND REMOVE SPECIAL CHARS AND REMOVE TAGS
            $update_stmt->bindValue(':status', $loan_status, PDO::PARAM_STR);
            $update_stmt->bindValue(':loan_id', $loan_id, PDO::PARAM_INT);
            
            if ($update_stmt->execute()) {
                $msg['message'] = "Loan ID: $loan_id has been $loan_status.";
                $msg['loan_id'] = $loan_id;
                $msg['status'] = $loan_status;
                http_response_code(200);
            } else {
                $msg['message'] = "An unexpected error has occurred while attempting to process your request. Please try again.";
                http_response_code(500);
            }
        } else {
            $msg['message'] = 'Invalid ID';
            http_response_code(500);
        }
        
        echo  json_encode($msg);
    }

?>