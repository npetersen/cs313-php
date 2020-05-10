<?php
    session_start();
?>

<h1>Checkout</h1>
<div class="row">
    <div class="col-sm">
        <div class="card p-3">
        <form action="confirmation.php" method="post" id="checkout-form" name="checkcout-form">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputFirstName">First Name</label>
                    <input type="text" class="form-control" id="inputFirstName" name="firstName">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputLastName">Last Name</label>
                    <input type="text" class="form-control" id="inputLastName" name="lastName">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" name="city">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control" name="state">
                        <option selected>Choose...</option>
                        <option value="UT">Utah</option>
                        <option value="ID">Idaho</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip" name="zip">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Complete checkout</button>
        </form>
        </div>
    </div>
    <div class="col-sm">
        <div class="card p-3">
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
                    <td>
                        <button class="btn btn-primary" onclick="showCart()">Back to shopping cart</button>
                    </td>
                    <td>Total:</td>
                    <td>
                        <?php echo '$' . number_format($item_total, 2) ?>
                    </td>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
</div>