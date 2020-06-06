<?php

    // {
    //     "account_number":7984651,
    //     "first_name":"Jerry",
    //     "last_name":"Racecardriver",
    //     "ssn":"000-00-0007",
    //     "gross_monthly_income":8000,
    //     "email":"jerry@racecardriver.com",
    //     "phone":"800-999-3961",
    //     "street_address":"PO Box 789",
    //     "city":"Ogden",
    //     "state":"UT",
    //     "zip":"84409",
    //     "loan_type":1,
    //     "amount":30000,
    //     "rate":4,
    //     "term":72
    // }
    
    // SET HEADER
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // INCLUDING DATABASE AND MAKING OBJECT
    require '../Database.php';
    $db_connection = new Database();
    $conn = $db_connection->dbConnection();
    
    // GET DATA FORM REQUEST
    $data = json_decode(file_get_contents("php://input"));
    
    //CREATE MESSAGE ARRAY AND SET EMPTY
    $msg['message'] = '';
    
    // CHECK IF RECEIVED DATA FROM THE REQUEST
    if (isset($data->account_number) && 
        isset($data->first_name) && 
        isset($data->last_name) && 
        isset($data->ssn) && 
        isset($data->gross_monthly_income) && 
        isset($data->email) && 
        isset($data->phone) && 
        isset($data->street_address) && 
        isset($data->city) && 
        isset($data->state) && 
        isset($data->zip) && 
        isset($data->loan_type) && 
        isset($data->amount) && 
        isset($data->rate) && 
        isset($data->term)) {
        // CHECK DATA VALUE IS EMPTY OR NOT
        if (!empty($data->account_number) && 
            !empty($data->first_name) && 
            !empty($data->last_name) && 
            !empty($data->ssn) && 
            !empty($data->gross_monthly_income) && 
            !empty($data->email) && 
            !empty($data->phone) && 
            !empty($data->street_address) && 
            !empty($data->city) && 
            !empty($data->state) && 
            !empty($data->zip) && 
            !empty($data->loan_type) && 
            !empty($data->amount) && 
            !empty($data->rate) && 
            !empty($data->term)) {
            $insert_query = "
                with first_insert as (
                    INSERT INTO loanapp.applicant(account_number, first_name, last_name, ssn, gross_monthly_income, email, phone) 
                    values(:account_number, :first_name, :last_name, :ssn, :gross_monthly_income, :email, :phone) 
                    RETURNING account_number
                ), 
                second_insert as (
                    INSERT INTO loanapp.applicant_address (account_number, street_address, city, state, zip)
                    VALUES ( (select account_number from first_insert), :street_address, :city, :state, :zip)
                    RETURNING account_number
                )
                INSERT INTO loanapp.loan (loan_type, applicant, rate, amount, term, status)
                values (:loan_type, (select account_number from first_insert), :rate, :amount, :term, 'pending');
            ";
            $insert_stmt = $conn->prepare($insert_query);
            // DATA BINDING
            $insert_stmt->bindValue(':account_number', htmlspecialchars(strip_tags($data->account_number)), PDO::PARAM_INT);
            $insert_stmt->bindValue(':first_name', htmlspecialchars(strip_tags($data->first_name)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':last_name', htmlspecialchars(strip_tags($data->last_name)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':ssn', htmlspecialchars(strip_tags($data->ssn)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':gross_monthly_income', htmlspecialchars(strip_tags($data->gross_monthly_income)), PDO::PARAM_INT);
            $insert_stmt->bindValue(':email', htmlspecialchars(strip_tags($data->email)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':phone', htmlspecialchars(strip_tags($data->phone)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':street_address', htmlspecialchars(strip_tags($data->street_address)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':city', htmlspecialchars(strip_tags($data->city)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':state', htmlspecialchars(strip_tags($data->state)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':zip', htmlspecialchars(strip_tags($data->zip)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':loan_type', htmlspecialchars(strip_tags($data->loan_type)), PDO::PARAM_INT);
            $insert_stmt->bindValue(':rate', htmlspecialchars(strip_tags($data->rate)), PDO::PARAM_INT);
            $insert_stmt->bindValue(':amount', htmlspecialchars(strip_tags($data->amount)), PDO::PARAM_INT);
            $insert_stmt->bindValue(':term', htmlspecialchars(strip_tags($data->term)), PDO::PARAM_INT);
            
            if ($insert_stmt->execute()) {
                $msg['message'] = 'Data Inserted Successfully';
                http_response_code(200);
            } else {
                $msg['message'] = 'Data not Inserted';
                http_response_code(500);
            }
        } else {
            $msg['message'] = 'Oops! Some missing fields were detected. Please make sure all fields are filled in.';
            http_response_code(500);
        }
    } else {
        $msg['message'] = 'Oops! Some missing fields were detected. Please make sure all fields are filled in.';
        http_response_code(500);
    }
    
    //ECHO DATA IN JSON FORMAT
    echo  json_encode($msg);

?>