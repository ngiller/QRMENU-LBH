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
														<label class="col-1 col-form-label">Active</label>
														<div class="col-1">
															<span class="kt-switch kt-switch--sm">
																<label>                                                                   
                                                                    <?php if ($data->active == 0) { ?>
                                                                        <input type="checkbox" checked="checked" name="active" value="0">
                                                                    <?php } else { ?>
                                                                        <input type="checkbox" name="active" value="0"> 
                                                                    <?php } ?>    
																	<span></span>
																</label>
															</span>
                                                        </div>
                                                        <label class="col-2 col-form-label">Show on Home</label>
														<div class="col-1">
															<span class="kt-switch kt-switch--sm">
																<label>                                                                   
                                                                    <?php if ($data->showonhome == 0) { ?>
                                                                        <input type="checkbox" checked="checked" name="onhome" value="0">
                                                                    <?php } else { ?>
                                                                        <input type="checkbox" name="onhome" value="0"> 
                                                                    <?php } ?>    
																	<span></span>
																</label>
															</span>
														</div>
                                                    </div>                                                    
                                                    <div class="form-group row">
														<label class="col-12 col-form-label">Position :</label>
                                                        <input type="text" class="form-control" name="pos" placeholder="position number" required="true" id="pos" value="<?php echo $data->position; ?>">
                                                        <span class="error invalid-feedback"></span>
                                                    </div>
													<div class="form-group row">
														<label class="col-12 col-form-label">Title :</label>
                                                        <input type="text" class="form-control" name="title" placeholder="Page Title" required="true" id="title" value="<?php echo $data->title; ?>" onchange="titlechange()">
                                                        <span class="error invalid-feedback"></span>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-12 col-form-label">Short Descriptions</label>
                                                        <textarea class="form-control cke_editor" id="short_desc" name="short_desc"><?php echo $data->short_desc; ?> 
                                                        </textarea>
                                                    </div>	
                                                    <div class="form-group row">
                                                        <label class="col-12 col-form-label">Link to Page</label>	
                                                        <select class="form-control" id="pagelink" name="pagelink">
                                                            <option value="0" <?php echo  ($data->page_link == 0) ? " selected" :  ""; ?>> </option>
                                                            <?php foreach($pages_data->result() as $row):?>
                                                                <option value="<?php echo $row->id;?>" <?php echo  ($row->id != $data->page_link) ? "" :  " selected"; ?>><?php echo $row->title;?></option>															
                                                            <?php endforeach;?>
                                                        </select>	
                                                    </div>
                                                    <div class="form-group row">
														<label class="col-4 col-form-label">Or Link to Image / PDF / URL :</label>
														<div class="col-6 custom-file">																													
                                                            <input id="linktopage" name="linktopage" type="text" value="<?php echo $data->link_to_url; ?>" class="form-control">      
														</div>
                                                        <div class="col-2">
                                                            <a data-toggle="modal" href="javascript:;" data-target="#TopImageModal" class="btn btn-success btn-sm" type="button">Select</a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group row">
														<label class="col-4 col-form-label">HOME IMAGE : (350 X 300)</label>
														<div class="col-6 custom-file">														
															<input id="homeimage" name="homeimage" type="text" value="<?php echo $data->homeimage; ?>" class="form-control">
														</div>
														<div class="col-2">
                                                        <a href="javascript:open_popup('/assets/vendors/general/filemanager/dialog.php?type=2&popup=1&field_id=homeimage&akey=jPqtaZXzm5YazS8i2dI0w44ZfJDI2WK0p66mhulsA49lWP9LASCphpuH2ZgS')" class="btn btn-success btn-sm" type="button">Select</a>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="display: inline-block;">
                                                        <?php
                                                            if ($data->homeimage != '') {
                                                                $fl = $data->homeimage;
                                                            } else {
                                                                $fl = "/assets/img/no-image.jpg";
                                                            }
                                                        ?>
                                                        <img id="homeimg" src="<?php echo $fl; ?>" width="250px" height="auto"/>                                                        
                                                    </div>                                                    
                                                    <div class="form-group row">
														<label class="col-12 col-form-label">Slug Name :</label>
                                                        <input type="text" class="form-control" name="link" placeholder="Link name" required="true" id="link" value="<?php echo $data->link; ?>">
                                                        <span class="error invalid-feedback"></span>
                                                    </div>													
												</div>
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
                                                    <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                                                    <input type="hidden" name="old_link" value="<?php echo $data->link; ?>">
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

        <script type="text/javascript">

            $(document).ready(function() {                

                $("input").change(function(){
						$(this).parent().parent().removeClass('has-error');
						$(this).removeClass('is-invalid');
						$(this).next().empty();
					});    
            });

            function titlechange() {
                title = $('[name=title]').val();
                $("#link").val(title);
            }

            function cancel() {
                window.location.replace("/simin/whatson");
            }
            
            function save() {
                    
                $('#btnSave').text('saving...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable 
                var url;                    
                url = "/simin/whatson/ajax_update";
                    
                // ajax adding data to database
                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data) {
                        if(data.status) {                                						                                
                            window.location.replace("/simin/whatson");
                        } else  {
                            for (var i = 0; i < data.inputerror.length; i++) {
                                $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                            }
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

            function open_popup(url) {
                var w = 880;
                var h = 570;
                var l = Math.floor((screen.width-w)/2);
                var t = Math.floor((screen.height-h)/2);
                var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
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
                    <iframe width="750" height="400" src="/assets/vendors/general/filemanager/dialog.php?type=2&field_id=linktopage'" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
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