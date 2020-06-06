<?php 

    session_start();

    $action = filter_input(INPUT_GET, 'action');

    if ($action == "logout") {
        session_destroy();
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
            <div class="form-signin shadow p-5">
                <form id="loanofficer-signin" method="post">
                    <div class="text-center mb-4">
                        <h1 class="h3 mb-3 font-weight-normal">Loan Application Admin</h1>
                        <h4 class="mb-3">Loan Officer Sign In</h4>
                        <div id="alert-message" class="alert alert-danger hide"></div>
                    </div>
                    <div class="form-label-group">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
                        <label for="inputUsername">Username</label>
                    </div>
                    <div class="form-label-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        <label for="inputPassword">Password</label>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Log In</button>
                </form>
            </div>
        </section>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="../js/jquery.serializejson.js"></script>
        <script>
            $("#loanofficer-signin").submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '../api/login.php',
                    dataType: 'json',
                    contentType: 'application/json',
                    type: 'POST',
                    data: JSON.stringify($(this).serializeJSON()),
                    processData: false
                }).done(function(data) {
                    console.log(data);
                    if (data.loggedIn) {
                        // $(".form-signin").empty().load("welcome.php").hide().fadeIn("fast");
                        $(".form-signin").empty().html("<h1>Welcome " + data.display_name + ".</h1><p>You have pending loans to review.</p><div class='text-center'><a href='loan-list.php?status=pending' class='btn btn-primary mr-3' role='button'>Review pending loans</a><a href='?action=logout' class='btn btn-danger' role='button'>Log out</a></div>").hide().fadeIn("fast");
                    } else {
                        $('#alert-message').removeClass('hide').html("There was a problem loggin in. Please try again.");
                    }
                    // $(".form-signin").empty().html("<p>" + data.message + ".<br>Welcome " + data.display_name + ".<br>" + JSON.stringify(data) + "</p>").hide().fadeIn("fast");
                }).fail(function(data) {
                    console.log($.parseJSON(JSON.stringify(data.responseJSON)));
                    $('#alert-message').removeClass('hide').html(data.responseJSON.message);
                });
            });
        </script>
    </body>
</html>