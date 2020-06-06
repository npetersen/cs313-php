<?php

    setlocale(LC_MONETARY,"en_US.UTF-8");

    // Create or access a session
    session_start();

    if (!$_SESSION['loggedIn']) {

        header('Location:index.php');
        die();

    } else {

        $host = $_SERVER['HTTP_HOST'];
        $status = 'pending';

        if (isset($_GET['status'])) {
            $status = filter_input(INPUT_GET, 'status');
            $url = "http://$host/loan-application/api/loan/read.php?status=$status";
        } else {
            $url = "http://$host/loan-application/api/loan/read.php";
        }

        $data = file_get_contents($url);
        $loans = json_decode($data);

    }

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arvo&family=Montserrat&display=swap">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/loan-application.css">
        <title>Loan Application Admin</title>
    </head>
    <body>
        <section class="d-flex align-items-center min-vh-100">
            <div class="container shadow p-5">
                <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
                    <a class="navbar-brand">Loan Application Admin > Review <?php echo $status ?> Loans</a>
                    <span class="navbar-text">
                        <?php echo $_SESSION['displayName'] ?>
                        <a href="index.php?action=logout" class="btn btn-danger ml-3" role="button" style="color: white;">Log Out</a>
                    </span>
                </nav>
                <nav class="navbar navbar-expand-lg navbar-light mb-3" style="background-color: #e3f2fd;">
                    <div class="collapse navbar-collapse">    
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="?status=pending">Review pending loans</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?status=approved">Review approved loans</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?status=denied">Review denied loans</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <table class="table table-bordered table-striped table-hover" style="background-color:white;">
                    <thead>
                        <tr>
                            <th>Account Number</th>
                            <th>Name</th>
                            <th>Loan Type</th>
                            <th>Loan Amount</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($loans as $loan) { ?>
                            <tr>
                                <td><?php echo $loan->account_number ?></td>
                                <td><?php echo $loan->first_name ?> <?php echo $loan->last_name ?></td>
                                <td><?php echo $loan->loan_type ?></td>
                                <td><?php echo money_format('%.2n', $loan->amount) ?></td>
                                <td><a class="btn btn-primary" href="loan-review.php?loanId=<?php echo $loan->id ?>" role='button'>Review This Loan</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="../js/jquery.serializejson.js"></script>
    </body>
</html>