<?php

    session_start();

    $_SESSION['name_addr'] = $_POST;

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <title>Checkout Complete</title>
    </head>
    
    <body>
        <div class="container">
            <h1>Checkout Complete</h1>
            <h3><?php echo $_SESSION['name_addr']['firstName'] ?> <?php echo $_SESSION['name_addr']['lastName'] ?>, thanks for your purchase!</h3>
            <div class="row">
                <div class="col-sm">
                    <div class="card p-3">
                        <h5>Your order will be sent to:</h5>
                        <p>
                            <?php echo $_SESSION['name_addr']['firstName'] ?> <?php echo $_SESSION['name_addr']['lastName'] ?><br>
                            <?php echo $_SESSION['name_addr']['address'] ?><br>
                            <?php echo $_SESSION['name_addr']['city'] ?>, <?php echo $_SESSION['name_addr']['state'] ?> <?php echo $_SESSION['name_addr']['zip'] ?> 
                        </p>
                    </div>     
                </div>
                <div class="col-sm">
                    <div class="card p-3">
                        <h5>Items in your order:</h5>
                        <table class="table table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($_SESSION['cart_item'] as $item) { ?>
                                    <tr>
                                        <td><strong><?php echo $item['name'] ?></strong></td>
                                        <td><?php echo $item['quantity'] ?></td>
                                        <td><?php echo '$' . $item['price'] ?></td>
                                    </tr>
                                    <?php $item_total += ($item['price'] * $item['quantity']) ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Total:</td>
                                    <td><?php echo '$' . number_format($item_total, 2) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>





