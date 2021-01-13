<!---header--->
<?php require "resources/header.php"; ?>
<!---header--->

<?php if (!array_key_exists('page', $data)) { ?>
	<div class="content">
		<!-- registration -->
		<div class="main-1">
			<div class="container">
				<div class="register">
					<form id="signupForm" action="index.php?action=account&method=create" onsubmit="return validateSignup(this.id);" method="post">
						<div class="alert alert-danger" style="display: none;"></div>
						<div class="register-top-grid">
							<h3>Register</h3>
							<div>
								<span>Name<label>*</label></span>
								<input type="text" name="name">
							</div>
							<div>
								<span>Email Address<label>*</label></span>
								<input type="text" name="email">
							</div>
							<div>
								<span>Mobile Number<label>*</label></span>
								<input type="tel" name="mobile">
							</div>
							<div>
								<span>Security Question<label>*</label></span>
								<select name="security_ques">
									<option value="0">What was your childhood nickname?</option>
									<option value="1">What is the name of your favourite childhood friend?</option>
									<option value="2">What was your favourite place to visit as a child?</option>
									<option value="3">What was your dream job as a child?</option>
									<option value="4">What is your favourite teacher's nickname?</option>
								</select>
							</div>
							<div class="clearfix">
								<div></div>
							</div>
						</div>
						<div class="register-bottom-grid">
							<div>
								<span>Security Answer<label>*</label></span>
								<input type="text" name="security_ans">
							</div>
							<div>
								<span>Password<label>*</label></span>
								<input type="password" name="password">
							</div>
							<div>
								<span>Confirm Password<label>*</label></span>
								<input type="password" name="confirm_password">
							</div>
						</div>
						<div class="clearfix"> </div>
						<div class="register-but">
							<input type="submit" value="REGISTER" name="submit">
							<div class="clearfix"> </div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- registration -->
<?php } else if ($data['page'] == "confirm") { ?>
	<!-- conifrm -->
	<div class="content">
		<div class="confirm">
			<div class="container verify">
				<div class="register-top-grid justify-content-center">
					<span id="emailId"><?= $data['email'] ?></span>
					<div>
						<input type="text" name="emailOtp">
					</div>
					<div class="register-but">
						<button id="emailOtp" onclick="verifyOtp('email')">Verify</button>
					</div>
				</div>
				<div class="clearfix"> </div>
				<div class="register-bottom-grid">
					<span><?= $data['mobile'] ?></span>
					<div>
						<input type="text" name="mobileOtp">
					</div>
					<div class="register-but">
						<button id="mobilOtp" onclick="verifyOtp('mobile')">Verify</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!-- confirm -->

<!---footer--->
<?php require "resources/footer.php" ?>
<!---footer--->
</body>

</html>