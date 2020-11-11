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
														<a href="<?php echo base_url('simin/whatson/addnew'); ?>"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#show_record" ><i class="flaticon-add-circular-button"></i> Add Record</button></a> <button type="button" name="btnDelete"  class="btn btn-danger btn-sm"  value="Delete" onclick="del_record()" ><i class="flaticon-delete"></i> Delete Record</button>
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
																<th>Title</th>
																<th>On Home</th>
																<th>Date</th>
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
 
				//datatables
				table = $('#table').DataTable({ 
					"responsive": true,									
					"pageLength": 25,
					"processing": true, //Feature control the processing indicator.
					"serverSide": true, //Feature control DataTables' server-side processing mode.
					"order": [], //Initial no order.			
					"ajax": { "url": "<?php echo site_url('simin/whatson/ajax_list')?>", "type": "POST" }, // Load data for the table's content from an Ajax source
					"columnDefs": [			
						{ "width": "33px", "targets": [ -1 ] },
						{ "width": "100px", "targets": [ -2 ] },
						{ "width": "75px", "targets": [ -3 ] },
                        { "width": "120px", "targets": [ -4 ] },
                        { "width": "33px", "targets": [ -6 ] },
						{ "width": "33px", "targets": [ -7 ] },
						{  "targets": [ -1 ], "orderable": false, },
						{  "targets": [ -2 ], "orderable": false, }
  					]

				});	

			});			
			
			function reload_table() {
				table.ajax.reload(null,false); //reload datatable ajax 
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
								url : "<?php echo site_url('simin/whatson/delete')?>/"+id,
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
				window.location.replace("/simin/whatson/rec_edit/"+id);
			} 

			function dup_record(id) {
				$.ajax({
					url : "<?php echo site_url('simin/whatson/rec_dup')?>/"+id,
						type: "POST",
						dataType: "JSON",
						success: function(data) {	
							reload_table();																		
						},
						error: function (jqXHR, textStatus, errorThrown) {
							reload_table();
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
									url : "<?php echo site_url('simin/whatson/del_selected')?>",
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

			function show_gallery(id){
				window.location.href = "/simin/pages/gallery/"+id;
			}
    	

			
		</script>

	
	<?php $this->load->view("simin/_includes/delete_dialog.php"); ?>
	</body>

	<!-- end::Body -->
</html>