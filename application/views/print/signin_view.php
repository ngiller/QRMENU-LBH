
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Order Print Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/assets/img/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/css/print.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(/assets/img/bg-01.jpg);">
					<span class="login100-form-title-1">
						ORDER PRINT
					</span>
                </div>
				
				<form class="login100-form validate-form" method="POST" action="/print/signin/login" >
				<?php
					if ($this->session->flashdata('error_msg')) {
				?>
				<div class="alert alert-danger text-center" role="alert" style="font-size: 14px; width: 100%">
					<?= $this->session->flashdata('error_msg'); ?>
				</div>
				<?php
					} 
				?>
					<div class="wrap-input100 validate-input m-b-26 mb-2" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="user" placeholder="Enter user" value="<?= $user; ?>" required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required" value ="<?= $passwd; ?>">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="passwd" placeholder="Enter password" required>
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn mt-5 d-flex justify-content-end">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="/assets/js/jquery-3.5.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/assets/js/popper.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
<!--===============================================================================================-->

</body>
</html>