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
								<div class ="col-sm-12">
									
									<div class="kt-portlet">
										<form method="post">
											<div class="kt-portlet__head">
												<div class="kt-portlet__head-label">
													<h3 class="kt-portlet__head-title">
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#show_record" onclick="add_record()"><i class="flaticon-add-circular-button"></i> Add Record</button> <button type="button" name="btnDelete"  class="btn btn-danger btn-sm"  value="Delete" onclick="del_record()" ><i class="flaticon-delete"></i> Delete Record</button> <button type="button" name="btnDelete"  class="btn btn-warning btn-sm"  value="Delete" onclick="back_to_menu()" >Back To Menu</button>
													</h3>
												</div>
											</div>
											<div class="kt-portlet__body">
												<div class="kt-section">												
												<div class="kt-section__content">													
													<table id="table" class="table table-striped" style="width:100%">
														<thead>
															<tr>
                                                                <th>Active</th>
                                                                <th>Pos</th>
                                                                <th>Image</th>
																<th>Action</th>
																<th></th>
															</tr>
														</thead>
														<tbody>																																								
														</tbody>													
													</table>
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
 
				//datatables
                
				table = $('#table').DataTable({ 
					"responsive": true,									
					"pageLength": 25,
					"processing": true, //Feature control the processing indicator.
					"serverSide": true, //Feature control DataTables' server-side processing mode.
					"order": [], //Initial no order.			
					"ajax": {
                        url: "<?php echo site_url('simin/menu/image_list')?>/"+menuid, 
                        dataType: "JSON",
                        type: "POST" }, 
					"columnDefs": [			
						{ "width": "36px", "targets": [ -1 ] },
						{ "width": "65px", "targets": [ -2 ] },
						{ "width": "45px", "targets": [ -4 ] },
						{ "width": "46px", "targets": [ -5 ] }
  					]

				});				

			});					
			
			function reload_table() {
				table.ajax.reload(null,false); //reload datatable ajax 
			}

			function add_record() {
				save_method = 'add';
				$('#addform')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error class	
				$('.invalid-feedback').empty(); // clear error string
                $('[name="menuid"]').val(menuid);

                $.ajax({
					url: "<?php echo site_url('simin/menu/get_next_pos_image')?>/"+menuid, 
					dataType: "JSON",
					type: "POST", 
					success: function(data) {
                        if(data.status) {
                            $('#pos').val(data.nextpos);
                        } else {
						    alert('Error next position');
						}
					}
				});
					
				$('#add_form').modal('show'); // show bootstrap modal
				$('.modal-title').text('Add Menu Images'); // Set Title to Bootstrap modal title    
			}

			function img_save() {
				$('#btnSave').text('saving...'); //change button text
				$('#btnSave').attr('disabled',true); //set button disable 
				var url;
				
				if(save_method == 'add') {
					url = "<?php echo site_url('simin/menu/add_image')?>";
				} else {
					url = "<?php echo site_url('simin/menu/image_update')?>";
				}
				
				// ajax adding data to database
				$.ajax({
					url : url,
					type: "POST",
					data: $('#addform').serialize(),
					dataType: "JSON",					
					success: function(data) {    
						if(data.status) {
							$('#add_form').modal('hide');							
							reload_table();								
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

			function delete_record(id) {
				bootbox.confirm({
					title: "Delete record ?",
    				message: "Do you want to delete this record ? This cannot be undone.",
					buttons: {
						confirm: {
							label: 'Yes',
							className: 'btn-success'
						},
						cancel: {
							label: 'No',
							className: 'btn-danger'
						}
					},
					callback: function (result) {
						if(result) {
							// ajax delete data to database
							$.ajax({
								url : "<?php echo site_url('simin/menu/delete_image')?>/"+id,
								type: "POST",
								dataType: "JSON",
								success: function(data) {	
									reload_table();																		
								},
								error: function (jqXHR, textStatus, errorThrown) {
									alert('Error deleting data');
								}
							});
						}
					}
				});				  												
			}

			function edit_img(id) {
				save_method = 'update';
				$('#addform')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error class
				$('.help-block').empty(); // clear error string
			
				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('simin/menu/image_edit/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{			
						$('[name="id"]').val(id);
						$('[name="menuid"]').val(menuid);
						if (data.data.active == 0) {
							$( "#active" ).prop( "checked", true );
						} else {
							$( "#active" ).prop( "checked", false );
						}
                        $('[name="pos"]').val(data.data.position);
						$('[name="image"]').val(data.data.image);	 						
						$('#add_form').modal('show'); // show bootstrap modal when complete loaded
						$('.modal-title').text('Edit Menu Image'); // Set title to Bootstrap modal title
			
					},
					error: function (jqXHR, textStatus, errorThrown) {
						alert('Error get data from ajax');
					}
				});
			} 
			
			function del_record() {
				bootbox.confirm({
					title: "Delete selected record ?",
    				message: "Do you want to delete selected record ? This cannot be undone.",
					buttons: {
						confirm: {
							label: 'Yes',
							className: 'btn-success'
						},
						cancel: {
							label: 'No',
							className: 'btn-danger'
						}
					},
					callback: function (result) {
						if (result) {
							var id = [];
   
							$(':checkbox:checked').each(function(i) {
								id[i] = $(this).val();
							});
							
							if(id.length === 0) {
								bootbox.alert({title: "Warning", message: "Please Select at least one checkbox"});
							} else {

								// ajax delete data to database
								$.ajax({
									url : "<?php echo site_url('simin/menu/del_selected_image')?>",
									type: "POST",
									dataType: "JSON",
									data:{id:id},
									success: function(data) {	
										reload_table();								
										var html = '';
										var i;
										for(i=0; i<data.data.length; i++){
											html += '<option>'+data.data[i].name+'</option>';
										}
										$('#select_property').html(html);
									},
									error: function (jqXHR, textStatus, errorThrown) {
										alert('Error deleting data');
									}
								});
							}
						}
					}
				});
			}	

            function back_to_menu(id){
				window.location.href = "/simin/menu";
			}					
		</script>

        <!-- Bootstrap modal -->
        <div class="modal fade" id="add_form" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-target=".bd-example-modal-lg">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body form">
						<form action="#" id="addform" class="form-horizontal">
							<div class="kt-section__body">
								<input type="hidden" value="" name="id"/> 
								<input type="hidden" value="" name="menuid"/> 
								<div class="form-group row">							
									<label class="col-sm-2 col-form-label">Active</label>		
									<div class="col-sm-4">
										<span class="kt-switch kt-switch--sm">
											<label>
												<input type="checkbox" checked="checked" name="active" value="0" id="active">
												<span></span>
											</label>
										</span>
									</div>
								</div>
								
								<div class="form-group row">																			
									<label class="col-sm-2 col-form-label">Position Number</label>	
									<div class="col-sm-2">							
										<input type="text" class="form-control" name="pos" required="true" id="pos" placeholder="pos number">																				
										<span class="error invalid-feedback"></span>
									</div>
								</div>
								<div class="form-group row">							
									<label class="col-sm-12 col-form-label">Image (1100 X 400)</label>		
									<div class="col-sm-10">
										<input type="text" class="form-control" name="image" required="true" id="image" placeholder="image">																				
									</div>
									<div class="col-2">
                                        <a data-toggle="modal" href="javascript:;" data-target="#PageImageModal" class="btn btn-success btn-sm" type="button">Select</a>
                                    </div>
								</div>							
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnSave" onclick="img_save()" class="btn btn-success btn-sm">Save</button>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- End Bootstrap modal -->

		<!-- Bootstrap modal -->
        <div class="modal fade" id="PageImageModal" role="dialog" data-target=".bd-example-modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Menu Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body form">
                    <iframe width="750" height="400" src="/assets/vendors/general/filemanager/dialog.php?type=2&field_id=image" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Bootstrap modal -->

	<?php $this->load->view("simin/_includes/delete_dialog.php"); ?>
	</body>

	<!-- end::Body -->
</html>