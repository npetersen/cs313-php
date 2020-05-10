<?php

    require_once ("Product.php");
    $product = new Product();
    $productArray = $product->getAllProduct();

?>

<div class="row">
    <?php if (! empty($productArray)) {foreach ($productArray as $k => $v) { ?>
        <div class="col-sm">
            <form id="frmCart" class="card">
                <img class="card-img-top" src="product-images/<?php echo $productArray[$k]["image"] ?>">
                <div class="card-body">
                    <h4><?php echo $productArray[$k]["name"]; ?></h4>
                    <p class="card-text">Description</p>
                    <h5><?php echo "$" . $productArray[$k]["price"]; ?></h5>
                    <div class="form-inline">
                        <input type="text" class="form-control mr-sm-2" id="qty_<?php echo $productArray[$k]["code"]; ?>" name="quantity" value="1" size="2" />
                        <button type="button" id="add_<?php echo $productArray[$k]["code"]; ?>" class="btn btn-primary btnAddAction cart-action" onclick="cartAction('add','<?php echo $productArray[$k]['code']; ?>')">
                            Add to cart
                        </button>
                    </div>
                </div>
            </form>
        </div>
    <?php } } ?>
</div>