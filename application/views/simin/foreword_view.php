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
		<?php $this->load->view("/simin/_includes/headmobile.php"); ?>

		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<?php $this->load->view("/simin/_includes/sidemenu.php"); ?>
				
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<?php $this->load->view("/simin/_includes/topheader.php"); ?>
					
					<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
						
						<?php $this->load->view("/simin/_includes/pagetitle.php"); ?>
						
						<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<div class="row">
								<div class ="col-sm-12">
									<div class="kt-portlet">
                                        
                                        <!--begin::Form-->
										<form id="form" class="kt-form" novalidate="novalidate">
											<div class="kt-portlet__body">
												<div class="kt-section kt-section--first">                                                   
													<div class="form-group row">
                                                        <label class="col-12 col-form-label">Foreword Descriptions</label>
                                                        <textarea class="form-control cke_editor" id="foreword" name="foreword"><?php echo $foreword; ?> 
                                                        </textarea>
                                                    </div>
													
												</div>
                                            </div>
                                            <hr>
                                            <div class="kt-portlet__body">
												<div class="kt-section kt-section--first">                                                   
													<div class="form-group row">
                                                        <label class="col-12 col-form-label">Closeword Descriptions</label>
                                                        <textarea class="form-control cke_editor" id="closeword" name="closeword"><?php echo $closeword; ?> 
                                                        </textarea>
                                                    </div>
													
												</div>
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<button type="button" class="btn btn-primary" onclick="save()" id="btnSave"> Save </button>
												</div>
											</div>
										</form>

									</div>
								</div>
							</div>
						</div>

						<!-- end:: Content -->
					</div>

					<?php $this->load->view("/simin/_includes/bottomfooter.php"); ?>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<?php $this->load->view("/simin/_includes/footer.php"); ?>

        <script src="/assets/vendors/general/ckeditor/ckeditor.js"></script>
        <script type="text/javascript">

            $(document).ready(function() {

                CKEDITOR.replace( 'foreword', {
                    height: 100,
                    width: '100%',
                    filebrowserBrowseUrl: '/assets/vendors/general/filemanager/dialog.php?type=2&akey=jPqtaZXzm5YazS8i2dI0w44ZfJDI2WK0p66mhulsA49lWP9LASCphpuH2ZgS&editor=ckeditor&fldr=',
                    filebrowserImageBrowseUrl: '/assets/vendors/general/filemanager/dialog.php?type=1&akey=jPqtaZXzm5YazS8i2dI0w44ZfJDI2WK0p66mhulsA49lWP9LASCphpuH2ZgS&editor=ckeditor&',
                    filebrowserUploadUrl: '/assets/vendors/general/filemanager/dialog.php?type=2&akey=jPqtaZXzm5YazS8i2dI0w44ZfJDI2WK0p66mhulsA49lWP9LASCphpuH2ZgS&editor=ckeditor&fldr='
                });

                CKEDITOR.replace( 'closeword', {
                    height: 100,
                    width: '100%',
                    filebrowserBrowseUrl: '/assets/vendors/general/filemanager/dialog.php?type=2&akey=jPqtaZXzm5YazS8i2dI0w44ZfJDI2WK0p66mhulsA49lWP9LASCphpuH2ZgS&editor=ckeditor&fldr=',
                    filebrowserImageBrowseUrl: '/assets/vendors/general/filemanager/dialog.php?type=1&akey=jPqtaZXzm5YazS8i2dI0w44ZfJDI2WK0p66mhulsA49lWP9LASCphpuH2ZgS&editor=ckeditor&',
                    filebrowserUploadUrl: '/assets/vendors/general/filemanager/dialog.php?type=2&akey=jPqtaZXzm5YazS8i2dI0w44ZfJDI2WK0p66mhulsA49lWP9LASCphpuH2ZgS&editor=ckeditor&fldr='
                });
                
            });

            
            function save() {
                    
                $('#btnSave').text('saving...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable 
                CKEDITOR.instances.foreword.updateElement();
                CKEDITOR.instances.closeword.updateElement();
                var url;                    
                url = "/simin/setting/update_foreword";
                    
                // ajax adding data to database
                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data) {
                        if(data.status) {                                						                                
                            //window.location.replace("/simin/setting/foreword");
                        }
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable             
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable       
                    }
                });
                
            }

            
 
        </script>
        
	</body>

    <!-- end::Body -->
    
    
</html>