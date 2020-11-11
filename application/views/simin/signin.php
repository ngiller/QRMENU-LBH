<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>SIGN IN</title>
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
                google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>

		<!--end::Fonts -->

		<link href="<?php echo base_url('assets/app/custom/login/login-v4.default.css') ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet" type="text/css" />		
		<link href="<?php echo base_url('assets/vendors/general/animate.css/animate.css') ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/default/base/style.bundle.css') ?>" rel="stylesheet" type="text/css" />

		<link rel="shortcut icon" href="<?php echo base_url('assets/media/logos/favicon.png') ?>" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(<?php echo base_url('assets/media/bg/bg-2.jpg'); ?>);">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container">
							<div class="kt-login__logo">
								<a href="#">
									<img src="<?php echo base_url('assets/media/logos/logo-5.png');?>">
								</a>
							</div>
							<div class="kt-login__signin">
								<div class="kt-login__head">
									<h3 class="kt-login__title">SIGN IN</h3>
								</div>
								<form class="kt-form" action="">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="User ID" name="user" autocomplete="off" id="user">
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Password" name="passwd" id="passwd">
									</div>
									<div class="row kt-login__extra">
										<div class="col">
											<!--<label class="kt-checkbox">
												<input type="checkbox" name="remember"> Remember me
												<span></span>
											</label>-->
										</div>
										<div class="col kt-align-right">
											<a href="javascript:;" id="kt_login_forgot" class="kt-login__link">Forget Password ?</a>
										</div>
									</div>
									<div class="kt-login__actions">
										<button id="kt_login_signin_submit" class="btn btn-brand btn-pill kt-login__btn-primary">Sign In</button>
									</div>
								</form>
							</div>							
							<div class="kt-login__forgot">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Forgotten Password ?</h3>
									<div class="kt-login__desc">Enter your email to reset your password:</div>
								</div>
								<form class="kt-form" action="">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
									</div>
									<div class="kt-login__actions">
										<button id="kt_login_forgot_submit" class="btn btn-brand btn-pill kt-login__btn-primary">Request</button>&nbsp;&nbsp;
										<button id="kt_login_forgot_cancel" class="btn btn-secondary btn-pill kt-login__btn-secondary">Cancel</button>
									</div>
								</form>
							</div>							
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>


		<!--begin:: Global Mandatory Vendors -->
		<script src="<?php echo base_url('assets/vendors/general/jquery/dist/jquery.js');?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/vendors/general/popper.js/dist/umd/popper.js');?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/vendors/general/bootstrap/dist/js/bootstrap.min.js');?>" type="text/javascript"></script>	

		<!--begin:: Global Optional Vendors -->
		<script src="<?php echo base_url('assets/vendors/general/jquery-form/dist/jquery.form.min.js');?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/vendors/general/jquery-validation/dist/jquery.validate.js');?>" type="text/javascript"></script>
		


		<!--begin::Page Scripts(used by this page) -->
		<script src="<?php echo base_url('assets/app/custom/login/login-general.js');?>" type="text/javascript"></script>

		

	</body>

	<!-- end::Body -->
</html>