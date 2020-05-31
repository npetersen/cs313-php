<?php

    function getLoansByStatus($status) {

        // Create a connection object from the acme connection function
        $db = get_db();

        // The SQL statement to be used with the database 
        $sql = '
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
        ';

        // The next line creates the prepared statement using the acme connection
        $stmt = $db->prepare($sql);

        // Bind the $status variable to the query
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);

        // The next line runs the prepared statement
        $stmt->execute();

        // The next line gets the data from the database and stores it as an array in the $loans variable
        $loans = $stmt->fetchAll(); 

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        // The next line sends the array of data back to where the function was called
        return $loans;

    }

    function getLoan($loanId) {
        $db = get_db();
        $sql = '
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
        ';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':loanId', $loanId, PDO::PARAM_INT);
        $stmt->execute();
        $loanData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $loanData;
    }

    function updateLoan($status, $loanId) {
        $db = get_db();
        $sql = 'UPDATE loanapp.loan SET status = :status WHERE id = :loanId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':loanId', $loanId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowsChanged;
    }

    function insertLoan($accountNumber, $firstName, $lastName, $ssn, $grossMonthlyIncome, $email, $phone, $streetAddress, $city, $state, $zip, $loanType, $loanAmount, $rate, $term) {
        $db = get_db();
        
        $sql = "
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

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':account_number', $accountNumber, PDO::PARAM_INT);
        $stmt->bindValue(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindValue(':ssn', $ssn, PDO::PARAM_STR);
        $stmt->bindValue(':gross_monthly_income', $grossMonthlyIncome, PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':street_address', $streetAddress, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':state', $state, PDO::PARAM_STR);
        $stmt->bindValue(':zip', $zip, PDO::PARAM_STR);
        $stmt->bindValue(':loan_type', $loanType, PDO::PARAM_INT);
        $stmt->bindValue(':rate', $rate, PDO::PARAM_INT);
        $stmt->bindValue(':amount', $loanAmount, PDO::PARAM_INT);
        $stmt->bindValue(':term', $term, PDO::PARAM_INT);

        $stmt->execute();

        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowsChanged;
    }

    // Get user data based on a username
    function getUser($username, $password) {
        $db = get_db();
        $sql = 'SELECT display_name FROM public.user WHERE username = :username AND password = :password';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $userData;
    }

    function getLoanTypes() {
        $db = get_db();
        $sql = 'SELECT id, loan_type FROM loanapp.loan_types';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $loanTypes = $stmt->fetchAll();
        $stmt->closeCursor();

        return $loanTypes;
    }

?>