<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>

<html lang="en">

<head>
	<?php $this->load->view("simin/_includes/head.php"); ?>

	<style>
		.element-animation {
			animation: animationFrames ease-in-out 1s;
			animation-iteration-count: 500;
			transform-origin: 50% 0%;
			animation-fill-mode: forwards;
			/*when the spec is finished*/
			-webkit-animation: animationFrames ease-in-out 1s;
			-webkit-animation-iteration-count: 500;
			-webkit-transform-origin: 50% 0%;
			-webkit-animation-fill-mode: forwards;
			/*Chrome 16+, Safari 4+*/
			-moz-animation: animationFrames ease-in-out 1s;
			-moz-animation-iteration-count: 500;
			-moz-transform-origin: 50% 0%;
			-moz-animation-fill-mode: forwards;
			/*FF 5+*/
			-o-animation: animationFrames ease-in-out 1s;
			-o-animation-iteration-count: 500;
			-o-transform-origin: 50% 0%;
			-o-animation-fill-mode: forwards;
			/*Not implemented yet*/
			-ms-animation: animationFrames ease-in-out 1s;
			-ms-animation-iteration-count: 500;
			-ms-transform-origin: 50% 0%;
			-ms-animation-fill-mode: forwards;
			/*IE 10+*/
		}

		@keyframes animationFrames {
			0% {
				transform: rotate(0deg);
			}

			20% {
				transform: rotate(15deg);
			}

			40% {
				transform: rotate(-10deg);
			}

			60% {
				transform: rotate(5deg);
			}

			80% {
				transform: rotate(-5deg);
			}

			100% {
				transform: rotate(0deg);
			}
		}

		@-moz-keyframes animationFrames {
			0% {
				-moz-transform: rotate(0deg);
			}

			20% {
				-moz-transform: rotate(15deg);
			}

			40% {
				-moz-transform: rotate(-10deg);
			}

			60% {
				-moz-transform: rotate(5deg);
			}

			80% {
				-moz-transform: rotate(-5deg);
			}

			100% {
				-moz-transform: rotate(0deg);
			}
		}

		@-webkit-keyframes animationFrames {
			0% {
				-webkit-transform: rotate(0deg);
			}

			20% {
				-webkit-transform: rotate(15deg);
			}

			40% {
				-webkit-transform: rotate(-10deg);
			}

			60% {
				-webkit-transform: rotate(5deg);
			}

			80% {
				-webkit-transform: rotate(-5deg);
			}

			100% {
				-webkit-transform: rotate(0deg);
			}
		}

		@-o-keyframes animationFrames {
			0% {
				-o-transform: rotate(0deg);
			}

			20% {
				-o-transform: rotate(15deg);
			}

			40% {
				-o-transform: rotate(-10deg);
			}

			60% {
				-o-transform: rotate(5deg);
			}

			80% {
				-o-transform: rotate(-5deg);
			}

			100% {
				-o-transform: rotate(0deg);
			}
		}

		@-ms-keyframes animationFrames {
			0% {
				-ms-transform: rotate(0deg);
			}

			20% {
				-ms-transform: rotate(15deg);
			}

			40% {
				-ms-transform: rotate(-10deg);
			}

			60% {
				-ms-transform: rotate(5deg);
			}

			80% {
				-ms-transform: rotate(-5deg);
			}

			100% {
				-ms-transform: rotate(0deg);
			}
		}
	</style>
</head>

<!-- begin::Body -->

<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

	<!-- begin:: Page -->
	<?php $this->load->view("simin/_includes/headmobile.php"); ?>

	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

			<?php $this->load->view("simin/_includes/sidemenu.php"); ?>

			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

				<?php $this->load->view("simin/_includes/topheader.php"); ?>

				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

					<div class="kt-subheader   kt-grid__item" id="kt_subheader">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title" id="title">DASHBOARD</h3>
							<span class="kt-subheader__separator kt-hidden"></span>
						</div>
						<div class="kt-subheader__toolbar">
							<div class="kt-subheader__wrapper">
								<form class="form-select-outlet d-flex justify-content-between">
									<label class="form-control" style="width: auto; border: none">Outlet </label>


									<select class="form-control" id="select_outlet">
										<?php
										foreach ($select_outlet->result() as $row) :
											if ($this->session->outletid  == "") {
												$this->session->set_userdata('outletid', $row->id);
											}
											if ($this->session->outletid == $row->id) {
										?>
												<option value="<?php echo $row->id; ?>" selected><?php echo $row->name; ?></option>
											<?php } else { ?>
												<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
										<?php }
										endforeach; ?>
									</select>
								</form>
							</div>
						</div>
					</div>
					<!-- begin:: Content -->
					<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
						<div class="container">
							<div class="row" id="order-data">

							</div>
						</div>
						<!--End::Dashboard 1-->
					</div>

					<!-- end:: Content -->
				</div>

				<?php $this->load->view("simin/_includes/bottomfooter.php"); ?>
			</div>
		</div>
	</div>

	<!-- end:: Page -->

	<?php $this->load->view("simin/_includes/footer.php"); ?>

	<script type="text/javascript">
		$(document).ready(function() {

			$('#select_property').change(function(){
				var id=$(this).val();					
				$.ajax({
					url : "<?php echo base_url();?>simin/menu_cat/change_property/",
					method : "POST",
					data : {id: id},						
					dataType : 'JSON',
					success: function(emp){
						reload_table();
						
					}
				});
			});		

			$('#select_outlet').change(function(){
				var id=$(this).val();					
				$.ajax({
					url : "<?php echo base_url();?>simin/menucat/change_outlet/",
					method : "POST",
					data : {id: id},						
					dataType : 'JSON',
					success: function(data) {						
						//table.ajax.reload();							
					}
				});
			});	

			$.ajax({
				url: "<?php echo base_url(); ?>simin/dashboard/ajax_get_order/",
				method: "POST",
				dataType: 'JSON',
				success: function(data) {
					$('#order-data').html(data.data);
				}
			});

			setInterval(fetchdata, 5000);

		});

		function fetchdata() {
			$.ajax({
				url: '<?php echo base_url(); ?>simin/dashboard/ajax_get_order/',
				type: 'post',
				dataType: 'JSON',
				success: function(response) {
					$('#order-data').html(response.data);
				}
			});
		}

		function formatNumber(num) {
			number = parseFloat(num);
				return (
					number
					.toFixed(0)
					.replace('.', ',') // replace decimal point character with ,
					.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
				)
		}
	</script>

</body>

<!-- end::Body -->

</html>