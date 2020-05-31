<?php

    // Create or access a session
    session_start();

    // Get the database connection file
    require_once 'db-connect.php';
    // Get the data access object for use as needed
    require_once 'dao.php';
    // Get the functions library
    require_once 'functions.php';

    $action = filter_input(INPUT_POST, 'action');

    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action) {
        case 'loanApplication':
            $loanTypes = getLoanTypes();
            $includePage = 'loan-application.php';
        break;

        case 'submitLoan':
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
            $accountNumber = filter_input(INPUT_POST, 'accountNumber', FILTER_SANITIZE_NUMBER_INT);
            $ssn = $firstName = filter_input(INPUT_POST, 'ssn', FILTER_SANITIZE_STRING);
            $grossMonthlyIncome = filter_input(INPUT_POST, 'grossMonthlyIncome', FILTER_SANITIZE_NUMBER_INT);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
            $streetAddress = filter_input(INPUT_POST, 'streetAddress', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
            $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
            $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING);
            $loanType = filter_input(INPUT_POST, 'loanType', FILTER_SANITIZE_NUMBER_INT);
            $loanAmount = filter_input(INPUT_POST, 'loanAmount', FILTER_SANITIZE_NUMBER_INT);
            $rate = filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_NUMBER_INT);
            $term = filter_input(INPUT_POST, 'term', FILTER_SANITIZE_NUMBER_INT);

            $success = insertLoan($accountNumber, $firstName, $lastName, $ssn, $grossMonthlyIncome, $email, $phone, $accountNumber, $streetAddress, $city, $state, $zip, $loanType, $loanAmount, $rate, $term);

            if ($success) {
                $message = "Your " . $loanType . " loan application has been submitted!";
            } else {
                $message = "There was a problem submitting your " . $loanType . " loan application.";
            }

            $includePage = 'thank-you.php';
            
        break;

        case 'login':
            $username = filter_input(INPUT_POST, 'inputUsername', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'inputPassword', FILTER_SANITIZE_STRING);
            $userData = getUser($username, $password);
            
            if (!empty($userData)) {
                // var_dump($userData);
                $_SESSION['userData'] = $userData;
                $_SESSION['loggedIn'] = true;
                // Build a list of pending loans using the $loans array
                $loans = getLoansByStatus('pending');
                $includePage = 'loan-list.php';
                $message = $_SESSION['userData']['display_name'] . ' successfully logged in. <a href="index.php?action=logout">Log out</a>';
            } else {
                $message = 'Unsuccessful login attempt. Please try again.';
                $includePage = 'login.php';
            }
        break;

        case 'logout':
            session_destroy();
            $message = "Successfully logged out.";
            $includePage = 'login.php';
        break;

        case 'reviewLoan':
            if ($_SESSION['loggedIn']) {
                $loanId = filter_input(INPUT_GET, 'loanId', FILTER_SANITIZE_NUMBER_INT);
                $loan = getLoan($loanId);
                $includePage = 'loan.php';
            } else {
                $message = "Unauthorized action. Please login.";
                $includePage = 'login.php';
            }
        break;

        case 'decisionLoan':
            if ($_SESSION['loggedIn']) {
                $loanId = filter_input(INPUT_GET, 'loanId', FILTER_SANITIZE_NUMBER_INT);
                $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);
                $updateLoanResult = updateLoan($status, $loanId);
                if ($updateLoanResult) {
                    $message = "Loan #" . $loanId . " has been " . $status . ".";
                    $loans = getLoansByStatus('pending');
                    $includePage = 'loan-list.php';
                } else {
                    $message = "There was a problem decisioning loan #" . $loanId . ". Please try again.";
                    $includePage = 'loan-list.php';
                }
            } else {
                $message = "Unauthorized action. Please login.";
                $includePage = 'login.php';
            }
        break;

        case 'viewLoanList':
            if ($_SESSION['loggedIn']) {
                $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);
                $loans = getLoansByStatus($status);
                $includePage = 'loan-list.php';
            } else {
                $message = "Unauthorized action. Please login.";
                $includePage = 'login.php';
            }
        break;

        default:
            $includePage = 'login.php';
        break;
    }

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        
        <title>Loan Application</title>
    </head>
    <body>
        <div class="container">
            <h1>Loan Application</h1>
            <?php if (isset($message)) echo '<p>' . $message . '</p>' ?>
            <?php
                if (!is_null($includePage)) {
                    include $includePage;
                } 
                
                // if (!is_null($pageContent)) {
                //     echo $pageContent;
                // }
            ?>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script>
            $('#ssn').keyup(function() {
                var val = this.value.replace(/\D/g, '');
                var newVal = '';
                if(val.length > 4) {
                    this.value = val;
                }
                if((val.length > 3) && (val.length < 6)) {
                    newVal += val.substr(0, 3) + '-';
                    val = val.substr(3);
                }
                if (val.length > 5) {
                    newVal += val.substr(0, 3) + '-';
                    newVal += val.substr(3, 2) + '-';
                    val = val.substr(5);
                }
                newVal += val;
                this.value = newVal.substring(0, 11);
            });
        </script>
    </body>
</html>