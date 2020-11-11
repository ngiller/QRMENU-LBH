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
														<label class="col-12 col-form-label">Page Title :</label>
                                                        <input type="text" class="form-control" name="title" placeholder="Page Title" required="true" id="title" value="<?php echo $data->title; ?>" onchange="titlechange()" disabled>
                                                        <span class="error invalid-feedback"></span>
													</div>
													<div class="form-group row">
                                                        <label class="col-12 col-form-label">Page Descriptions</label>
                                                        <textarea class="form-control cke_editor" id="descrip" name="descrip"><?php echo $data->descriptions; ?> 
                                                        </textarea>
                                                    </div>                                                    
                                                    <div class="form-group row">
														<label class="col-4 col-form-label">Or Link to image / PDF :</label>
														<div class="col-6 custom-file">																													
                                                            <input id="link" name="link" type="text" value="<?php echo $data->link; ?>" class="form-control">      
														</div>
                                                        <div class="col-2">
                                                            <a data-toggle="modal" href="javascript:;" data-target="#TopImageModal" class="btn btn-success btn-sm" type="button">Select</a>
                                                        </div>
													</div>
												</div>
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
                                                    <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                                                    <input type="hidden" name="old-title" value="<?php echo $data->title; ?>">
                                                    <input type="hidden" name="old-link"  value="<?php echo $data->link; ?>">
                                                    <input type="hidden" name="old-imgPhoto" value="<?php echo $data->topimage; ?>" />
													<button type="button" class="btn btn-primary" onclick="save()" id="btnSave">Save</button>
													<button type="button" class="btn btn-secondary" onclick="cancel()">Cancel</button>
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

                $("input").change(function(){
						$(this).parent().parent().removeClass('has-error');
						$(this).removeClass('is-invalid');
                        $(this).next().empty();
                        $('#btnSave').attr('disabled',false);
					});
                
                CKEDITOR.replace( 'descrip', {
                    height: 300,
                    width: '100%',
                    filebrowserBrowseUrl: '/assets/vendors/general/filemanager/dialog.php?type=2&akey=jPqtaZXzm5YazS8i2dI0w44ZfJDI2WK0p66mhulsA49lWP9LASCphpuH2ZgS&editor=ckeditor&fldr=',
                    filebrowserImageBrowseUrl: '/assets/vendors/general/filemanager/dialog.php?type=1&akey=jPqtaZXzm5YazS8i2dI0w44ZfJDI2WK0p66mhulsA49lWP9LASCphpuH2ZgS&editor=ckeditor&',
                    filebrowserUploadUrl: '/assets/vendors/general/filemanager/dialog.php?type=2&akey=jPqtaZXzm5YazS8i2dI0w44ZfJDI2WK0p66mhulsA49lWP9LASCphpuH2ZgS&editor=ckeditor&fldr='
                });
                
            });

            
            
            function save() {
                    
                $('#btnSave').text('saving...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable 
                CKEDITOR.instances.descrip.updateElement();
                var url;                    
                url = "/simin/pages/directory_update";
                    
                // ajax adding data to database
                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data) {
                        if(!data.status) {                                						                                
                           
                            for (var i = 0; i < data.inputerror.length; i++) {
                                $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                            } 
                           
                        }
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable       
                    }
                });
                
            }

            
 
        </script>

        <!-- Bootstrap modal -->
        <div class="modal fade" id="TopImageModal" role="dialog" data-target=".bd-example-modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Top Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body form">
                    <iframe width="750" height="400" src="/assets/vendors/general/filemanager/dialog.php?type=2&field_id=link'" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Bootstrap modal -->
        
	</body>

    <!-- end::Body -->
    
    
</html>