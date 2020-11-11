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
							<div class="row">
								<div class ="col-sm-6">
                                    <div class="kt-portlet">
										
										<!--begin::Form-->
										<form class="kt-form kt-form--label-right" id="setting-form">
											<div class="kt-portlet__body">
												
												<div class="form-group row">
													<label for="example-text-input" class="col-3 col-form-label">Tax (%)</label>
													<div class="col-9">
														<input class="form-control" type="number" value="" id="tax" name="tax" autofocus>
													</div>
												</div>
												<div class="form-group row">
													<label for="example-search-input" class="col-3 col-form-label">Service (%)</label>
													<div class="col-9">
														<input class="form-control" type="number" value="" id="service" name="service">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-email-input" class="col-3 col-form-label">Time Zone</label>
													<div class="col-9">
														<input class="form-control" type="text" value="" id="timezone" name="timezone">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-url-input" class="col-3 col-form-label">QR Size (pixel)</label>
													<div class="col-9">
														<input class="form-control" type="number" value="" id="qrsize" name="qrsize">
													</div>
												</div>												
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-2">
														</div>
														<div class="col-10">
															<button type="reset" class="btn btn-success" id="btnSave" onclick="save()" disabled>Save Setting</button>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
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

      		$(document).ready(function() {

				$('#select_property').change(function(){
					var id=$(this).val();
					console.log(id);
					$.ajax({
						url : "<?php echo base_url();?>simin/setting/change_property/",
						method : "POST",
						data : {id: id},						
						dataType : 'JSON',
						success: function(data){
							
						}
					});
				});
 

				//set input/textarea/select event when change value, remove class error and remove text help block 
				$("input").change(function(){
					$(this).parent().parent().removeClass('has-error');
					$(this).removeClass('is-invalid');
                    $(this).next().empty();
                    $('#btnSave').prop('disabled', false);
                });	
                
                $('#setting-form')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error class
				$('.help-block').empty(); // clear error string
			
				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('simin/setting/ajax_edit/')?>",
					type: "GET",
					dataType: "JSON",
					success: function(data) {
                        $('[name="tax"]').val(data.tax);	
                        $('[name="service"]').val(data.service);	
                        $('[name="timezone"]').val(data.timezone);
                        $('[name="qrsize"]').val(data.qrsize);									
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error get data from ajax');
					}
				});

			});

			function save() {
				$('#btnSave').text('saving...'); //change button text
				$('#btnSave').attr('disabled',true); //set button disable 
				var url = "<?php echo site_url('simin/setting/ajax_update')?>";
				
				// ajax adding data to database
				$.ajax({
					url : url,
					type: "POST",
					data: $('#setting-form').serialize(),
					dataType: "JSON",
					success: function(data) {    
						if(data.status) {
							//$('#setting-form').modal('hide');
							//reload_table();
						} else  {
							for (var i = 0; i < data.inputerror.length; i++) {
								$('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
								$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
								$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
							}
						}
						$('#btnSave').text('Save Setting'); //change button text
						$('#btnSave').attr('disabled',true); //set button enable             
					},
					error: function (jqXHR, textStatus, errorThrown) {
						alert('Error adding / update data');
						$('#btnSave').text('Save Setting'); //change button text
						$('#btnSave').attr('disabled',false); //set button enable       
					}
				});
			}	
		</script>

	</body>

	<!-- end::Body -->
</html>