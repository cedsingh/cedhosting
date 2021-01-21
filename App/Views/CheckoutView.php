<!---header--->
<?php require "resources/header.php"; ?>
<script src="https://www.paypal.com/sdk/js?client-id=AUJ3KFen7AMQ2J1dUqZZ7j2KeiW8Jv1rDaHiFGxXdUlWHvGZVf0fMuYWBGyg37R_hzh7_t-K-QFUIzwd&currency=INR&components=buttons"></script>
<!---header--->
<div class="content checkout-page">
    <!-- registration -->
    <div class="main-1">
        <div class="container">
            <?php if ($data['page'] == "payment") : ?>
                <div class="row">
                    <?php if ($data['msg'] !== "") { ?>
                        <div class="alert alert-success">
                            <?= $data['msg'] ?>
                        </div>
                    <?php } ?>
                    <div class="col-8">
                        <div class="addresses">
                            <?php foreach ((array)$data['addresses'] as $value) { ?>
                                <input type="radio" name="address" value="<?= $value['id'] ?>" />
                                <p><?= $value['billing_name'] ?></p>
                                <p><?= $value['house_no'] ?></p>
                                <p><?= $value['city'] ?></p>
                                <p><?= "{$value['state']} - {$value['pincode']}" ?></p>
                                <p><?= $value['country'] ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <a href="checkout/address" class="btn btn-success">Add New Address</a>
                    <div class="col-4">
                        <div class="products">
                            <?php foreach ((array)$data['cart'] as $value) : ?>
                                <div class="">
                                    <span><?= $value['name'] ?></span>
                                    <span><?= $value['price'] ?></span>
                                </div>
                                <div>
                                    <b>Total </b>
                                    <span id="totalPrice"><?= $data['cart_total'] ?></span>
                                </div>
                            <?php endforeach ?>
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="register">
                    <form id="signupForm" action="checkout" method="post">
                        <div class="alert alert-danger" style="display: none;"></div>
                        <div class="register-top-grid">
                            <h3>New Billing Address</h3>
                            <div>
                                <span>Name<label>*</label></span>
                                <input type="text" name="billing_name">
                            </div>
                            <div>
                                <span>House no<label>*</label></span>
                                <input type="text" name="house_no">
                            </div>
                            <div>
                                <span>City<label>*</label></span>
                                <input type="text" name="city">
                            </div>
                            <div>
                                <span>State<label>*</label></span>
                                <select name="state">
                                    <?php foreach ($data['states'] as $value) { ?>
                                        <?php echo "<option value='{$value['name']}'>{$value['name']}</option>" ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div>
                                <span>PIN Code<label>*</label></span>
                                <input type="number" name="pincode">
                            </div>
                            <div>
                                <span>Country<label>*</label></span>
                                <select name="country">
                                    <option value="IN">India</option>
                                </select>
                            </div>
                            <div class="clearfix">
                                <div></div>
                            </div>
                        </div>
                        <div class="register-but">
                            <input type="submit" value="ADD ADDRESS" name="submit">
                            <div class="clearfix"> </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Checkout -->
<!---footer--->
<?php require "resources/footer.php" ?>
<!---footer--->
</body>

</html>