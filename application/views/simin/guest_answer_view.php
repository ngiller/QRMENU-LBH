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
                                        <form method="post" id="form-show_activity" name="form-show_activity">
											<div class="kt-portlet__head row mt-3">
												<!--<div class="kt-portlet__head-label ">
													<h3 class="kt-portlet__head-title">-->                                                
                                                    <div class="col-4">
                                                        <div class="row">
                                                            <label class="col-form-label col-lg-4 col-sm-12">Show from
                                                                date</label>
                                                            <div class="col-lg-8 col-md-9 col-sm-12">
                                                                <div class="input-group date">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Select date" id="kt_datepicker_1"
                                                                        name="fromdate"
                                                                        value="<?php echo $this->session->bdate; ?>">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-calendar-check-o"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="row">
                                                            <label
                                                                class="col-form-label col-lg-3 col-sm-12 text-right">To
                                                                date</label>
                                                            <div class="col-lg-8 col-md-9 col-sm-12">
                                                                <div class="input-group date">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Select date" id="kt_datepicker_2"
                                                                        name="todate"
                                                                        value="<?php echo $this->session->edate; ?>">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-calendar-check-o"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
														<button type="button" class="btn btn-success btn-sm" onclick="show_record()"><i class="flaticon2-accept"></i> Show Answer </button>
													</div>
													<!--</h3>
                                                </div>-->                                                
											</div>
											<div class="kt-portlet__body">
												<div class="kt-section">												
												<div class="kt-section__content">													
													<table id="table" class="table table-striped" style="width:100%">
														<thead>
															<tr>
                                                            <th>Date</th>
                                                            <th>Guest Name</th>
                                                            <th>Email Address</th>
                                                            <th>Score</th>
                                                            <th>Action</th>
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
					"ajax": { "url": "<?php echo site_url('simin/guest_answer/get_list')?>", "type": "POST" }, // Load data for the table's content from an Ajax source
					"columnDefs": [
						{ "width": "105px", "targets": [ -1 ] },
                        { "width": "150px", "targets": [ -2 ] },
						{  "targets": [ -1 ], "orderable": false, }
  					]
				});

				//set input/textarea/select event when change value, remove class error and remove text help block 
				$("input").change(function(){
					$(this).parent().parent().removeClass('has-error');
					$(this).removeClass('is-invalid');
					$(this).next().empty();
				});						
			});	

            function show_record() {
				$.ajax({
					url : "<?php echo site_url('simin/guest_answer/get_range')?>",
					type: "POST",
					data: $('#form-show_activity').serialize(),
					dataType: "JSON",					
					success: function(data) {                                                
						reload_table();														
					}
				});
            }    				
			
			function reload_table() {
				table.ajax.reload(null,false); //reload datatable ajax 
			}

			function show_detail(id) {
				window.location.href = "/simin/guest_answer/detail/"+id;
			} 
			
									
		</script>
	</body>

	<!-- end::Body -->
</html>