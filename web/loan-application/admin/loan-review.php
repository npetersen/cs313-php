<?php

    setlocale(LC_MONETARY,"en_US.UTF-8");

    // Create or access a session
    session_start();

    if (!$_SESSION['loggedIn']) {

        header('Location:index.php');
        die();

    } else {

        $host = $_SERVER['HTTP_HOST'];

        if (isset($_GET['loanId'])) {
            $loanId = filter_input(INPUT_GET, 'loanId');
            $url = "http://$host/loan-application/api/loan/read.php?loanId=$loanId";
        } else {
            $url = "http://$host/loan-application/api/loan/read.php";
        }

        $data = file_get_contents($url);
        $loan = json_decode($data);

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
                <nav class="navbar navbar-light mb-3" style="background-color: #e3f2fd;">
                    <a class="navbar-brand">Loan Application Admin > Review <?php echo $loan[0]->status ?> Loans > Loan ID: <?php echo $loan[0]->id ?></a>
                    <span class="navbar-text">
                        <?php echo $_SESSION['displayName'] ?>
                        <a href="index.php?action=logout" class="btn btn-danger ml-3" role="button" style="color: white;">Log Out</a>
                    </span>
                </nav>
                <div id="alert-message" class="alert alert-danger mb-3 hide"></div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Applicant Details</h5>
                                <ul class="list-group">
                                    <li class="list-group-item"><span class="font-weight-bolder">Account Number:</span> <?php echo $loan[0]->account_number ?></li>
                                    <li class="list-group-item"><span class="font-weight-bolder">Name:</span> <?php echo $loan[0]->first_name ?> <?php echo $loan[0]->last_name ?></li>
                                    <li class="list-group-item"><span class="font-weight-bolder">SSN:</span> <?php echo $loan[0]->ssn ?></li>
                                    <li class="list-group-item"><span class="font-weight-bolder">Gross Monthly Income:</span> <?php echo money_format('%.2n', $loan[0]->gross_monthly_income) ?></li>
                                    <li class="list-group-item"><span class="font-weight-bolder">Email:</span> <?php echo $loan[0]->email ?></li>
                                    <li class="list-group-item"><span class="font-weight-bolder">Phone:</span> <?php echo $loan[0]->phone ?></li>
                                    <li class="list-group-item"><span class="font-weight-bolder">Address:</span><br><?php echo $loan[0]->street_address ?><br><?php echo $loan[0]->city ?>, <?php echo $loan[0]->state ?> <?php echo $loan[0]->zip ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Loan Details</h5>
                                <ul class="list-group">
                                    <li class="list-group-item"><span class="font-weight-bolder">Status:</span> <?php echo $loan[0]->status ?></li>
                                    <li class="list-group-item"><span class="font-weight-bolder">Type:</span> <?php echo $loan[0]->loan_type ?></li>
                                    <li class="list-group-item"><span class="font-weight-bolder">Amount:</span> <?php echo money_format('%.2n', $loan[0]->amount) ?></li>
                                    <li class="list-group-item"><span class="font-weight-bolder">Term:</span> <?php echo $loan[0]->term ?> months</li>
                                    <li class="list-group-item"><span class="font-weight-bolder">Rate:</span> <?php echo $loan[0]->rate ?>%</li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-3">
                            <?php if ($loan[0]->status == 'pending') { ?>
                                <form id="approve-loan" method="post" class="mb-2">
                                    <input type="hidden" name="loan_id:number" value="<?php echo $loan[0]->id ?>">
                                    <input type="hidden" name="loan_status" value="approved">
                                    <input type="submit" class="btn btn-success btn-block" id="btn-approve-loan" value="Approve Loan">
                                </form>
                                <form id="deny-loan" method="post" class="mb-2">
                                    <input type="hidden" name="loan_id:number" value="<?php echo $loan[0]->id ?>">
                                    <input type="hidden" name="loan_status" value="denied">
                                    <input type="submit" class="btn btn-danger btn-block" id="btn-deny-loan" value="Deny Loan">
                                </form>
                            <?php } ?>
                            <?php if ($loan[0]->status == 'denied') { ?>
                                <a href="loan-list.php?status=denied" type="button" class="btn btn-primary btn-block">Back to Denied Loans List</a>
                            <?php } else if ($loan[0]->status == 'approved') { ?>
                                <a href="loan-list.php?status=approved" type="button" class="btn btn-primary btn-block">Back to Approved Loans List</a>
                            <?php } ?>
                            <a href="loan-list.php?status=pending" type="button" class="btn btn-primary btn-block">Back to Pending Loans List</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="../js/jquery.serializejson.js"></script>
        <script>
            $("#approve-loan, #deny-loan").submit(function(event) {
                event.preventDefault();
                console.log(JSON.stringify($(this).serializeJSON()));
                $.ajax({
                    url: '../api/loan/update.php',
                    dataType: 'json',
                    contentType: 'application/json',
                    type: 'POST',
                    data: JSON.stringify($(this).serializeJSON()),
                    processData: false
                }).done(function(data) {
                    console.log(data);
                    $(".container").empty().html("<h1>Success</h1><p>" + data.message + "</p><a href='loan-list.php?status=pending' class='btn btn-primary' role='button'>Review pending loans</a>").hide().fadeIn("fast");
                }).fail(function(data) {
                    console.log(data);
                    $('#alert-message').removeClass('hide').html(data.message);
                });
            });
        </script>
    </body>
</html>