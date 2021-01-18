<!---header--->
<?php require "resources/header.php" ?>
<!---header--->
<!---singleblog--->
<div class="content">
	<div class="linux-section">
		<div class="container">
			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Select Plan</h5>
						</div>
						<div class="modal-body">
							<div class="select-plan">
								<div class="form-group">
									<select id="planType" class="form-control" name="price-type">
										<option value="0">Monthly</option>
										<option value="1">Annual</option>
									</select>
								</div>
								<div>
									Total price: <span id="totalPrice"></span>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Add To Cart</button>
						</div>
					</div>
				</div>
			</div>
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
		<div class="container hosting-page">
			<?php foreach ($data['prod_data'] as $value) {
				$desc = json_decode($value['description'], true);
			?>
				<div class="col-md-3 linux-price">
					<div class="linux-top us-top">
						<h4><?= $value['prod_name'] ?></h4>
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
							<li><strong>location</strong> : <img src="images/india.png"></li>
						</ul>
					</div>
					<a href="#" data-toggle="modal" data-target="#exampleModal" data-product=<?= json_encode(["id" => $value['id'], "name" => $value['prod_name'], "price" => [$value['mon_price'], $value['annual_price']]]); ?> class="us-button">add to cart</a>
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