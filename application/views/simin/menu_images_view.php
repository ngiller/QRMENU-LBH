<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>

<html lang="en">

	<head>	
		<?php $this->load->view("simin/_includes/head.php"); ?>			
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
						
						<?php $this->load->view("simin/_includes/pagetitle.php"); ?>
						
						<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">									
							<div class="kt-portlet">
								<form method="post" id="imgform">
									<div class="kt-portlet__head">

											<div class="row mt-4" style="width: 100%;">

													<div class="col-6">
														<button type="button" name="btnback" class="btn btn-warning btn-sm" value="back" onclick="back_to_menu()">Back To Menu</button>
													</div>
													<div class="col-6">
														<button type="button" name="save" class="btn btn-success btn-sm" value="back" onclick="img_save()" style="float:right">Save Image</button>
													</div>
	
											</div>

									</div>
									<div class="kt-portlet__body">
										<div class="kt-section">
											<div class="kt-section__content">
												<div class="form-group row">							
													<label class="col-sm-12 col-form-label">Image (460 X 307)</label>		
													<div class="col-sm-10">
														<input type="hidden" value="<?php echo $menuid; ?>" name="id"/>
														<input type="text" class="form-control" name="image" required="true" id="image" placeholder="image" value="<?php echo $menu_image; ?>">																				
													</div>
													<div class="col-2">
													<a href="javascript:open_popup('/assets/vendors/general/filemanager/dialog.php?type=2&popup=1&field_id=image&akey=jPqtaZXzm5YazS8i2dI0w44ZfJDI2WK0p66mhulsA49lWP9LASCphpuH2ZgS')" class="btn btn-success btn-sm" type="button">Select</a>
													</div>
												</div>
												<div class="form-group row">
													<img id="menu_img" src="<?php echo $menu_image; ?>">
												</div>
											</div>
										</div>
								</form>
							</div>

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
 
      		var save_method; //for save method string
      		var table;
            <?php echo 'var menuid = '.$menuid.';'; ?> 

      		$(document).ready(function() {		
                 		
				$('#select_property').change(function(){
					var id=$(this).val();					
					$.ajax({
						url : "<?php echo base_url();?>simin/menu/change_property/",
						method : "POST",
						data : {id: id},						
						dataType : 'JSON',
						success: function(emp){
							reload_table();							
						}
					});
				});

				$('#image').change(function(){
					var str = $("#image"). val();
					alert(str);
					$('#menu_img').attr("src", str);
				});
			});								

			function img_save() {
				$('#btnSave').text('saving...'); //change button text
				var url = "<?php echo site_url('simin/menu/save_image')?>";
				
				// ajax adding data to database
				$.ajax({
					url : url,
					type: "POST",
					data: $('#imgform').serialize(),
					dataType: "JSON",					
					success: function(data) {    
						if(data.status) {
							window.location.href = "/simin/menu";									
						} else  {
							for (var i = 0; i < data.inputerror.length; i++) {
								$('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
								$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
								$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
							}
						}
						$('#btnSave').text('save'); //change button text         
					},
					error: function (jqXHR, textStatus, errorThrown) {
						alert('Error adding / update data');
						$('#btnSave').text('save'); //change button text
						$('#btnSave').attr('disabled',false); //set button enable       
					}
				});
			}												

            function back_to_menu(id){
				window.location.href = "/simin/menu";
			}
			
			function open_popup(url) {
				var w = 880;
				var h = 570;
				var l = Math.floor((screen.width-w)/2);
				var t = Math.floor((screen.height-h)/2);
				var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
			}
		</script>

	</body>

	<!-- end::Body -->
</html>