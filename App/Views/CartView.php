<?php require_once "resources/header.php" ?>
<div class="content">
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Qauntity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['cart']['cart'] as $key => $value) { ?>
                    <tr>
                        <td><?= $value['name'] ?></td>
                        <td><?= $value['qty'] ?></td>
                        <td><?= $value['price'] ?></td>
                        <td><a href="javascipt:void(0)" data-index="<?= $value[$key] ?>">✖</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="">
            <a href="checkout" class="button us-button" id="checkoutButtom">CHECKOUT</a>
        </div>
    </div>
</div>

<?php require_once "resources/footer.php" ?>