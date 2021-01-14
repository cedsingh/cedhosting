<!---header--->
<?php require "resources/header.php" ?>
<!---header--->
<!---singleblog--->
<div class="content">
	<div class="linux-section">
		<div class="container">
			<div class="linux-grids">
				<div class="col-md-8 linux-grid">
					<h2><?= $data['cat_title'] ?></h2>
					<div>
						<?= $data['cat_desc'] ?>
					</div>
					<a href="#">view plans</a>
				</div>
				<div class="col-md-4 linux-grid1">
					<img src="images/cms.png" class="img-responsive" alt="" />
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="tab-prices">
		<div class="container">
			<?php foreach ($data['prod_data'] as $value) {
				$desc = json_decode($value['description'], true);
			?>
				<div class="col-md-3 linux-price">
					<div class="linux-top us-top">
						<h4><?= $desc['name'] ?></h4>
					</div>
					<div class="linux-bottom us-bottom">
						<h5>₹ <?= $value['mon_price'] ?><span class="month"> per month</span></h5>
						<h5>₹ <?= $value['annual_price'] ?><span class="month"> per annum</span></h5>
						<h6><?= $desc['domain'] ?> Domains</h6>
						<ul>
							<li><strong><?= $desc['webspace'] ?></strong> Disk Space</li>
							<li><strong><?= $desc['bandwidth'] ?></strong> Data Transfer</li>
							<li><strong><?= $desc['mailbox'] ?></strong> Email Accounts</li>
							<li><strong>Includes </strong> Global CDN</li>
							<li><strong>High Performance</strong> Servers</li>
							<li><strong>location</strong> : <img src="Public/images/india.png"></li>
						</ul>
					</div>
					<a href="#" onclick="addToCart(this.id, <?= $value['id'] ?>)" class="us-button">buy now</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<!---footer--->
<?php require "resources/footer.php" ?>
<!---footer--->


</body>

</html>