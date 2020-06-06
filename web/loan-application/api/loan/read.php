<?php

    // SET HEADER
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json; charset=UTF-8");
    
    // INCLUDING DATABASE AND MAKING OBJECT
    require '../Database.php';
    $db_connection = new Database();
    $conn = $db_connection->dbConnection();
    
    // CHECK GET ID PARAMETER OR NOT
    if (isset($_GET['loanId'])) {
        // IF HAS loanId PARAMETER
        // $loanId = filter_var($_GET['loanId'], FILTER_VALIDATE_INT, ['options' => ['default' => 'all_loans', 'min_range' => 1]]);
        $loanId = filter_input(INPUT_GET, 'loanId', FILTER_SANITIZE_NUMBER_INT);
        $sql = "
            SELECT 
                l.id, l.rate, l.amount, l.term, l.status, 
                lt.loan_type, 
                a.account_number, a.first_name, a.last_name, a.ssn, a.gross_monthly_income, a.email, a.phone, 
                aa.street_address, aa.city, aa.state, aa.zip
            FROM 
                loanapp.loan l, loanapp.loan_types lt, loanapp.applicant a, loanapp.applicant_address aa 
            WHERE 
                l.loan_type = lt.id 
                AND l.applicant = a.account_number 
                AND a.account_number = aa.account_number 
                AND l.id = :loanId  
        ";
    } else if (isset($_GET['status'])) {
        $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);
        $sql = "
            SELECT 
                l.id, l.rate, l.amount, l.term, l.status, 
                lt.loan_type, 
                a.account_number, a.first_name, a.last_name, a.ssn, a.gross_monthly_income, a.email, a.phone, 
                aa.street_address, aa.city, aa.state, aa.zip
            FROM 
                loanapp.loan l, loanapp.loan_types lt, loanapp.applicant a, loanapp.applicant_address aa 
            WHERE 
                l.loan_type = lt.id 
                AND l.applicant = a.account_number 
                AND a.account_number = aa.account_number 
                AND l.status = :status
        ";
    } else {
        $sql = "
            SELECT 
                l.id, l.rate, l.amount, l.term, l.status, 
                lt.loan_type, 
                a.account_number, a.first_name, a.last_name, a.ssn, a.gross_monthly_income, a.email, a.phone, 
                aa.street_address, aa.city, aa.state, aa.zip
            FROM 
                loanapp.loan l, loanapp.loan_types lt, loanapp.applicant a, loanapp.applicant_address aa 
            WHERE 
                l.loan_type = lt.id 
                AND l.applicant = a.account_number 
                AND a.account_number = aa.account_number
        ";
    }

    $stmt = $conn->prepare($sql);

    if (isset($loanId)) {
        $stmt->bindValue(':loanId', $loanId, PDO::PARAM_INT);
    } else if (isset($status)) {
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
    }
    
    $stmt->execute();
    
    //CHECK WHETHER THERE IS ANY LOAN IN OUR DATABASE
    if ($stmt->rowCount() > 0) {
        // CREATE LOANS ARRAY
        $loans_array = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
            $loan_data = [
                'id' => $row['id'], 
                'rate' => $row['rate'], 
                'amount' => $row['amount'], 
                'term' => $row['term'],
                'status' => $row['status'],
                'loan_type' => $row['loan_type'],
                'account_number' => $row['account_number'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'ssn' => $row['ssn'],
                'gross_monthly_income' => $row['gross_monthly_income'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'street_address' => $row['street_address'],
                'city' => $row['city'],
                'state' => $row['state'],
                'zip' => $row['zip']
            ];
            
            // PUSH LOAN DATA IN OUR $loans_array ARRAY
            array_push($loans_array, $loan_data);
        }
        
        //SHOW POST/POSTS IN JSON FORMAT
        echo json_encode($loans_array);

    } else {
        //IF THERE IS NO LOAN IN OUR DATABASE
        echo json_encode(['message'=>'No loans found']);
    }
?>