<!---header--->
<?php require "resources/header.php"; ?>
<script src="https://www.paypal.com/sdk/js?client-id=AUJ3KFen7AMQ2J1dUqZZ7j2KeiW8Jv1rDaHiFGxXdUlWHvGZVf0fMuYWBGyg37R_hzh7_t-K-QFUIzwd&currency=INR&components=buttons"></script>
<!---header--->

<div class="content">
    <!-- registration -->
    <div class="main-1">
        <div class="container">
            <div class="products">
                <?php foreach ($data['cart'] as $value) : ?>
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
            <div class="register">
                <form id="signupForm" action="checkout/make" onsubmit="return validateSignup(this.id);" method="post">
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
                            <select name="country">
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
        </div>
    </div>
</div>
<!-- Checkout -->
<!---footer--->
<?php require "resources/footer.php" ?>
<!---footer--->
</body>

</html>