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
										<div class="kt-portlet__head">												
											<div class="kt-portlet__head-label">
												<form class="form-select-outlet">
													<div class="row">
														<label class="col-2 label-select-property">Outlet :</label>
															<div class="col-9">													
																<select class="form-control select-outlet" id="select_outlet">
																	<?php																		
																		foreach($select_outlet->result() as $row):
																			if ($this->session->outletid  == "") {
																				$this->session->set_userdata('outletid', $row->id);
																			}
																			if ($this->session->outletid == $row->id) {
																	?>
																		<option value="<?php echo $row->id; ?>" selected><?php echo $row->name;?></option>
																			<?php } else { ?>
																		<option value="<?php echo $row->id; ?>" ><?php echo $row->name;?></option>																		
																	<?php } endforeach;?>
																</select>
															</div>
															
													</div>
												</form>
											</div>
										</div>
									</div>
									<div class="kt-portlet">
										<form method="post">
											<div class="kt-portlet__head">												
												<div class="kt-portlet__head-label">																									
													<h3 class="kt-portlet__head-title">
														<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#show_record" onclick="add_record()"><i class="flaticon-add-circular-button"></i> Add Record</button> <button type="button" name="btnDelete"  class="btn btn-danger btn-sm"  value="Delete" onclick="del_record()" ><i class="flaticon-delete"></i> Delete Record</button>
													</h3>
												</div>
											</div>
											<div class="kt-portlet__body">
												<div class="kt-section">												
												<div class="kt-section__content">													
													<table id="table" class="table" style="width:100%">
														<thead>
															<tr>
																<th>Active</th>
																<th>Code #</th>
																<th>Category Name</th>
																<th>Sub Category</th>																
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

      		$(document).ready(function() {
				
				$('#select_property').change(function(){
					var id=$(this).val();					
					$.ajax({
						url : "<?php echo base_url();?>simin/menucat/change_property/",
						method : "POST",
						data : {id: id},						
						dataType : 'JSON',
						success: function(data) {						
							table.ajax.reload();							
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
							table.ajax.reload();							
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
					"ajax": { "url": "/simin/menucat/ajax_list/", "type": "POST" }, // Load data for the table's content from an Ajax source
					"columnDefs": [
						{ "width": "33px", "targets": [ -1 ] },
						{ "width": "75px", "targets": [ -2 ] },
						{ "width": "95px", "targets": [ -3 ] },
						{ "width": "55px", "targets": [ -5 ] },
						{ "width": "55px", "targets": [ -6 ] },						
						{  "targets": [ -1 ], "orderable": false, },
						{  "targets": [ -2 ], "orderable": false, },
						{  "targets": [ -3 ], "orderable": false, },
						{  "targets": [ -4 ], "orderable": false, },
						{  "targets": [ -5 ], "orderable": false, },
						{  "targets": [ -6 ], "orderable": false, }
  					],
					"createdRow": function( row, data, dataIndex){ 
							if( data[3] == null){
								$(row).addClass('mastercat');
							}
						}
				});

				//set input/textarea/select event when change value, remove class error and remove text help block 
				$("input").change(function(){
					$(this).parent().parent().removeClass('has-error');
					$(this).removeClass('is-invalid');
					$(this).next().empty();
				});		

			});			
			
			function reload_table() {
				table.ajax.reload(null,false); //reload datatable ajax 
			}

			function add_record() {
				save_method = 'add';
				$('#form')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error class
				$('#menucat').removeClass('is-invalid');				
				//$('[name="subof"]').val(subof);		
				$('#img').attr("src", "/assets/img/no-image.jpg");			
				$('.invalid-feedback').empty(); // clear error string

				$.ajax({
					url: '/simin/menucat/get_cat_dropdown',
					type: 'post',
					dataType: 'json',
					success:function(response){

						var len = response.length; 

						$("#subof").empty();
						$('#subof').append('<option value="0">Select sub category</option>');
						for( var i = 0; i<len; i++){
							var id = response[i]['id'];
							var name = response[i]['name']; 
							
							if (response[i]['sub_of']==0) {
								$("#subof").append("<option value='"+id+"'>"+name+"</option>");
							} else {
								$("#subof").append("<option value='"+id+"'>&nbsp;&nbsp;&nbsp; > "+name+"</option>");
							}
						}
					}
				});

				$('#modal_form').modal('show'); // show bootstrap modal
				$('.modal-title').text('Add Category'); // Set Title to Bootstrap modal title
			}

			function save() {
				$('#btnSave').text('saving...'); //change button text
				$('#btnSave').attr('disabled',true); //set button disable 
				var url;
				
				if(save_method == 'add') {
					url = "<?php echo site_url('simin/menucat/add_save')?>";
				} else {
					url = "<?php echo site_url('simin/menucat/ajax_update')?>";
				}
				
				// ajax adding data to database
				$.ajax({
					url : url,
					type: "POST",
					data: $('#form').serialize(),
					dataType: "JSON",
					success: function(data) {    
						if(data.status) {
							$('#modal_form').modal('hide');							
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
								url : "<?php echo site_url('simin/menucat/delete')?>/"+id,
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

			function edit_record(id) {
				save_method = 'update';
				$('#form')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error class
				$('.help-block').empty(); // clear error string
				$('.modal-title').text('Edit Category'); 

				$.ajax({
					url: '/simin/menucat/get_cat_dropdown',
					type: 'post',
					dataType: 'json',
					success:function(response){

						var len = response.length; 

						$("#subof").empty();
						$('#subof').append('<option value="0">Select sub category</option>');
						for( var i = 0; i<len; i++){
							var id = response[i]['id'];
							var name = response[i]['name']; 
							
							if (response[i]['sub_of']==0) {
								$("#subof").append("<option value='"+id+"'>"+name+"</option>");
							} else {
								$("#subof").append("<option value='"+id+"'>&nbsp;&nbsp;&nbsp; > "+name+"</option>");
							}
						}
					}
				});
			
				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('simin/menucat/ajax_edit/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
			
						$('[name="id"]').val(data.id);
						if (data.active == 0) {
							$( "#active" ).prop( "checked", true );
						} else {
							$( "#active" ).prop( "checked", false );
						}
						if (data.order_other_outlet == 0) {
							$( "#other_outlet" ).prop( "checked", true );
						} else {
							$( "#other_outlet" ).prop( "checked", false );
						}
						$('[name="code"]').val(data.code);
						$('[name="name"]').val(data.name);
						$('[name="subof"]').val(data.sub_of).change();
						$('[name="fbtype"]').val(data.fb);
						$('[name="image"]').val(data.image);
						if (data.image != '') {
							$('[name="img"]').attr("src", data.image);	
						} else {
							$('[name="img"]').attr('src', '/assets/img/no-image.jpg');
						}
												
						$('#first-create').text(data.datefirst+' by '+data.firstname);  
						$('#last-update').text(data.datelast+' by '+data.lastname);     						
						$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
						$('.modal-title').text('Edit Category'); // Set title to Bootstrap modal title
			
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
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
									url : "<?php echo site_url('simin/menucat/del_selected')?>",
									type: "POST",
									dataType: "JSON",
									data:{id:id},
									success: function(data) {	
										reload_table();																		
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
    	
			function open_popup(url) {
				var w = 880;
				var h = 570;
				var l = Math.floor((screen.width-w)/2);
				var t = Math.floor((screen.height-h)/2);
				var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
			}
			
		</script>

	<!-- Bootstrap modal -->
	<div class="modal fade " id="modal_form" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body form">
					<form action="#" id="form" class="form-horizontal">
						<div class="kt-section__body">
							<input type="hidden" value="" name="id"/> 
							<input type="hidden" value="" name="old-menucat"/>				
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Active</label>
								<div class="col-sm-8">
									<span class="kt-switch kt-switch--sm">
										<label>
											<input type="checkbox" checked="checked" name="active" value="0" id="active">
											<span></span>
										</label>
									</span>
								</div>
							</div>	
							<div class="form-group row">							
								<label class="col-sm-4 col-form-label">Code #</label>		
								<div class="col-sm-8">
									<input type="text" class="form-control" name="code" required="true" id="code" placeholder="Code">																				
									<span class="error invalid-feedback"></span>
								</div>
							</div>					 
							<div class="form-group row">							
								<label class="col-sm-4 col-form-label">Category Name</label>		
								<div class="col-sm-8">
									<input type="text" class="form-control" name="name" required="true" id="name" placeholder="Category Name">																				
									<span class="error invalid-feedback"></span>
								</div>
							</div>	
							<div class="form-group row">													
								<label class="col-sm-4 col-form-label">Sub Category of</label>
								<div class="col-sm-8">
									<select class="form-control" name="subof" id="subof">										
											
									</select>
									<span class="error invalid-feedback"></span>
								</div>
							</div>						
							<div class="form-group row">													
								<label class="col-sm-4 col-form-label">Type</label>
								<div class="col-sm-8">
									<select class="form-control" id="fbtype" name="fbtype">										
											<option value="1">Food</option>
											<option value="2">Beverage</option>
											<option value="3">Spa</option>
											<option value="4">Others</option>
									</select>
									<span class="error invalid-feedback"></span>
								</div>	
							</div>  
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Allow order from other outlet</label>
								<div class="col-sm-8">
									<span class="kt-switch kt-switch--sm">
										<label>
											<input type="checkbox" checked="checked" name="other_outlet" value="0" id="other_outlet">
											<span></span>
										</label>
									</span>
								</div>
							</div> 
							<div class="form-group row">							
									<label class="col-sm-12 col-form-label">Image (512 X 340)</label>		
									<div class="col-sm-10">
										<input type="text" class="form-control" name="image" required="true" id="image" placeholder="image">																				
									</div>
									<div class="col-2">
									<a href="javascript:open_popup('/assets/vendors/general/filemanager/dialog.php?type=2&popup=1&field_id=image&akey=jPqtaZXzm5YazS8i2dI0w44ZfJDI2WK0p66mhulsA49lWP9LASCphpuH2ZgS')" class="btn btn-success btn-sm" type="button">Select</a>
                                    </div>
							</div>
							<div class="form-group row">
								<img name="img" id="img" src="" width="250px" height="166px"/>
							</div>
							<div class="kt-separator kt-separator--border-dashed"></div>     
							<div class="kt-section__body">
								<div class="row">
									<div class="col-sm-3">
										First create :
									</div>
									<div class="col-sm-9" id="first-create">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3">
										Last update  :
									</div>
									<div class="col-sm-9" id="last-update">
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" id="btnSave" onclick="save()" class="btn btn-success btn-sm">Save</button>
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