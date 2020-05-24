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

?>