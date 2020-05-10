<?php

    session_start();

?>

<!doctype html>
<html lang="en">
    
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Shopping Cart</title>    
</head>

<body>
    <div class="container">
        <h1>Catalog</h1>

        <?php require_once "catalog.php"; ?>

        <div class="row mt-5">
            <div class="col-sm" id="cart-item">
                <?php require_once "cart-action.php"; ?>
            </div>
        </div>

        <!-- <div class="row mt-5">
            <div class="col-sm" id="checkout">
                
            </div>
        </div> -->
        
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        function cartAction(action, product_code) {
            var queryString = "";

            if (action != "") {
                switch (action) {
                    case "add":
                        if ($("#qty_" + product_code).val() < 1) {
                            $("#add_" + product_code).html("Quantity must be at least 1").removeClass("btn-primary").addClass("btn-danger");
                        } else {
                            queryString = 'action=' + action + '&code=' + product_code + '&quantity=' + $("#qty_" + product_code).val();
                            $("#add_" + product_code).html("Add to cart").removeClass("btn-danger").addClass("btn-primary");
                        }
                        break;
                    case "remove":
                        queryString = 'action=' + action + '&code=' + product_code;
                        break;
                    case "empty":
                        queryString = 'action=' + action;
                        break;
                }
            }
            
            jQuery.ajax({
                url: "cart-action.php",
                data: queryString,
                type: "POST",
                success: function (data) {
                    $("#cart-item").hide().fadeIn("fast").html(data);
                    if (action == "add") {
                        // $("#add_" + product_code).html("Item added");
                        // $("#add_" + product_code).attr("onclick", "");
                    } else if (action == "empty") {
                        $("#cart-item").fadeOut("slow");
                    }
                },
                error: function () {}
            });
        }

        function showCheckout() {
            $("#cart-item").load("checkout.php").hide().fadeIn("fast");
        }

        function showCart() {
            $("#cart-item").load("cart-action.php").hide().fadeIn("fast");
        }

        $("#checkout-form").submit(function(event) {
            event.preventDefault();
            var postUrl = $(this).attr("action");
            var requestMethod = $(this).attr("method");
            var formData = $(this).serialize();

            console.log(formData);

            $.ajax({
                url: postUrl,
                type: requestMethod,
                data: formData
            }).done(function() {
                $("#cart-item").html(response);
            });
        });

        function doCheckout() {}
    </script>
</body>

</html>