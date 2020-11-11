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
													<table id="table" class="table table-striped" style="width:100%">
														<thead>
															<tr>
                                                                <th>Active</th>
                                                                <th>Code</th>
                                                                <th>Discount Name</th>
                                                                <th>Disc %</th>																
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
						url : "<?php echo base_url();?>simin/menudisc/change_property/",
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
						url : "<?php echo base_url();?>simin/menudisc/change_outlet/",
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
					"ajax": { "url": "<?php echo site_url('simin/menudisc/ajax_list')?>", "type": "POST" }, // Load data for the table's content from an Ajax source
					"columnDefs": [
						{ "width": "33px", "targets": [ -1 ] },
						{ "width": "75px", "targets": [ -2 ] },
						{ "width": "75px", "targets": [ -3 ] },	
                        { "width": "75px", "targets": [ -3 ] },
                        { "width": "75px", "targets": [ -5 ] },
                        { "width": "40px", "targets": [ -6 ] },					
						{  "targets": [ -1 ], "orderable": false, },
						{  "targets": [ -2 ], "orderable": false, },
						{  "targets": [ -4 ], "orderable": false, }
  					]

				});

				//set input/textarea/select event when change value, remove class error and remove text help block 
				$("input").change(function(){
					$(this).parent().parent().removeClass('has-error');
					$(this).removeClass('is-invalid');
					$(this).next().empty();
                });		
                
                $('#allday').click(function(){
                    if($(this).prop("checked") == true){                        
                        $('#sun').prop( "checked", true );
                        $('#mon').prop( "checked", true );
                        $('#tue').prop( "checked", true );
                        $('#wed').prop( "checked", true );
                        $('#thu').prop( "checked", true );
                        $('#fri').prop( "checked", true );
                        $('#sat').prop( "checked", true );
                    }                    
                });
                $('#sun').click(function(){
                    if($(this).prop("checked") == false){
                        $('#allday').prop( "checked", false );
                    } else {
                        if (($('#mon').prop("checked") == true) & ($('#tue').prop("checked") == true) & ($('#wed').prop("checked") == true) & ($('#thu').prop("checked") == true) & ($('#fri').prop("checked") == true) & ($('#sat').prop("checked") == true)){
                            $('#allday').prop( "checked", true );
                        }
                    }
                });
                $('#mon').click(function(){
                    if($(this).prop("checked") == false){
                        $('#allday').prop( "checked", false );
                    } else {
                        if (($('#sun').prop("checked") == true) & ($('#tue').prop("checked") == true) & ($('#wed').prop("checked") == true) & ($('#thu').prop("checked") == true) & ($('#fri').prop("checked") == true) & ($('#sat').prop("checked") == true)){
                            $('#allday').prop( "checked", true );
                        }
                    }
                });
                $('#tue').click(function(){
                    if($(this).prop("checked") == false){
                        $('#allday').prop( "checked", false );
                    } else {
                        if (($('#sun').prop("checked") == true) & ($('#mon').prop("checked") == true) & ($('#wed').prop("checked") == true) & ($('#thu').prop("checked") == true) & ($('#fri').prop("checked") == true) & ($('#sat').prop("checked") == true)){
                            $('#allday').prop( "checked", true );
                        }
                    }
                });
                $('#wed').click(function(){
                    if($(this).prop("checked") == false){
                        $('#allday').prop( "checked", false );
                    } else {
                        if (($('#sun').prop("checked") == true) & ($('#mon').prop("checked") == true) & ($('#tue').prop("checked") == true) & ($('#thu').prop("checked") == true) & ($('#fri').prop("checked") == true) & ($('#sat').prop("checked") == true)){
                            $('#allday').prop( "checked", true );
                        }
                    }
                });
                $('#thu').click(function(){
                    if($(this).prop("checked") == false){
                        $('#allday').prop( "checked", false );
                    } else {
                        if (($('#sun').prop("checked") == true) & ($('#mon').prop("checked") == true) & ($('#tue').prop("checked") == true) & ($('#wed').prop("checked") == true) & ($('#fri').prop("checked") == true) & ($('#sat').prop("checked") == true)){
                            $('#allday').prop( "checked", true );
                        }
                    }
                });
                $('#fri').click(function(){
                    if($(this).prop("checked") == false){
                        $('#allday').prop( "checked", false );
                    } else {
                        if (($('#sun').prop("checked") == true) & ($('#mon').prop("checked") == true) & ($('#tue').prop("checked") == true) & ($('#wed').prop("checked") == true) & ($('#thu').prop("checked") == true) & ($('#sat').prop("checked") == true)){
                            $('#allday').prop( "checked", true );
                        }
                    }
                });
                $('#sat').click(function(){
                    if($(this).prop("checked") == false){
                        $('#allday').prop( "checked", false );
                    } else {
                        if (($('#sun').prop("checked") == true) & ($('#mon').prop("checked") == true) & ($('#tue').prop("checked") == true) & ($('#wed').prop("checked") == true) & ($('#thu').prop("checked") == true) & ($('#fri').prop("checked") == true)){
                            $('#allday').prop( "checked", true );
                        }
                    }
                });
			});			
			
			function reload_table() {
				table.ajax.reload(null,false); //reload datatable ajax 
			}

			function add_record() {
                save_method = 'add';
				$('#form')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error class
				$('#code').removeClass('is-invalid');				
				$('#name').removeClass('is-invalid');
                $('#disc').removeClass('is-invalid');
                $('[name="starttime"]').val('00:00:00');	
                $('[name="endtime"]').val('00:00:00');					
				$('.invalid-feedback').empty(); // clear error string
				$('#modal_form').modal('show'); // show bootstrap modal
				$('.modal-title').text('Add Discount'); // Set Title to Bootstrap modal title
			}

			function save() {
				$('#btnSave').text('saving...'); //change button text
				$('#btnSave').attr('disabled',true); //set button disable 
				var url;
				
				if(save_method == 'add') {
					url = "<?php echo site_url('simin/menudisc/add_save')?>";
				} else {
					url = "<?php echo site_url('simin/menudisc/ajax_update')?>";
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
						alert('Error adding / update data - '+errorThrown);
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
								url : "<?php echo site_url('simin/menudisc/delete')?>/"+id,
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
			
				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('simin/menudisc/ajax_edit/')?>/" + id,
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
						$('[name="oldcode"]').val(data.code);
						$('[name="oldname"]').val(data.name);
                        $('[name="code"]').val(data.code);
						$('[name="name"]').val(data.name);
                        $('[name="disc"]').val(data.disc);
                        strdate = data.date_start; 
                        strdate = strdate.substr(8, 2) + "-"+ strdate.substr(5, 2)+"-"+strdate.substr(0, 4);
                        $('[name="startdate"]').val(strdate);
                        strdate = data.date_end; 
                        strdate = strdate.substr(8, 2) + "-"+ strdate.substr(5, 2)+"-"+strdate.substr(0, 4);
						$('[name="enddate"]').val(strdate);
                        $('[name="starttime"]').val(data.time_start);
                        $('[name="endtime"]').val(data.time_stop);
                        if (data.allday == 0) {
							$( "#allday" ).prop( "checked", true );
						} else {
							$( "#allday" ).prop( "checked", false );
                        }
                        if (data.sun == 0) {
							$( "#sun" ).prop( "checked", true );
						} else {
							$( "#sun" ).prop( "checked", false );
                        }
                        if (data.mon == 0) {
							$( "#mon" ).prop( "checked", true );
						} else {
							$( "#mon" ).prop( "checked", false );
                        }	
                        if (data.tue == 0) {
							$( "#tue" ).prop( "checked", true );
						} else {
							$( "#tue" ).prop( "checked", false );
                        }		
                        if (data.wed == 0) {
							$( "#wed" ).prop( "checked", true );
						} else {
							$( "#wed" ).prop( "checked", false );
                        }	
                        if (data.thu == 0) {
							$( "#thu" ).prop( "checked", true );
						} else {
							$( "#thu" ).prop( "checked", false );
                        }		
                        if (data.fri == 0) {
							$( "#fri" ).prop( "checked", true );
						} else {
							$( "#fri" ).prop( "checked", false );
                        }		
                        if (data.sat == 0) {
							$( "#sat" ).prop( "checked", true );
						} else {
							$( "#sat" ).prop( "checked", false );
                        }			
						$('#first-create').text(data.datefirst+' by '+data.firstname);  
						$('#last-update').text(data.datelast+' by '+data.lastname);     						
						$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
						$('.modal-title').text('Edit Property'); // Set title to Bootstrap modal title
			
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
									url : "<?php echo site_url('simin/menudisc/del_selected')?>",
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
    	

			
		</script>

	<!-- Bootstrap modal -->
	<div class="modal fade" id="modal_form" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body form">
					<form action="#" id="form" class="form-horizontal">
						<div class="kt-section__body">
                            <div class="row">	
                                <div class="col-sm-6">
                                    <input type="hidden" value="" name="id"/> 
									<input type="hidden" value="" name="oldcode"/> 
									<input type="hidden" value="" name="oldname"/>
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
                                        <label class="col-sm-4 col-form-label">Code</label>		
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="code" required="true" id="code" placeholder="Discount Code">																				
                                            <span class="error invalid-feedback"></span>
                                        </div>
                                    </div>				 
                                    <div class="form-group row">							
                                        <label class="col-sm-4 col-form-label">Discount Name</label>		
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="name" required="true" id="name" placeholder="Discount Name">																				
                                            <span class="error invalid-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">							
                                        <label class="col-sm-4 col-form-label">Disc %</label>		
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="disc" required="true" id="disc" placeholder="Discount %">																				
                                            <span class="error invalid-feedback"></span>
                                        </div>
                                    </div>	
                                    
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-4">Start Date</label>
                                        <div class="col-sm-8">
                                            <div class="input-group date">
                                                <input type="text" class="form-control" readonly="" placeholder="Select date" id="kt_datepicker_2" name="startdate">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar-check-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-4">End Date</label>
                                        <div class="col-sm-8">
                                            <div class="input-group date">
                                                <input type="text" class="form-control" readonly="" placeholder="Select date" id="kt_datepicker_2" name="enddate">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar-check-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
										<label class="col-form-label col-sm-4">Start Time</label>
										<div class="col-sm-8">
												<div class="input-group timepicker">
													<input class="form-control" id="starttime" name="starttime" placeholder="Select time" type="text">
													<div class="input-group-append">
														<span class="input-group-text">
														<i class="la la-clock-o"></i>
													</span>
												</div>
											</div>
										</div>
                                    </div>
                                    <div class="form-group row">
										<label class="col-form-label col-sm-4">End Time</label>
										<div class="col-sm-8">
												<div class="input-group timepicker">
													<input class="form-control" id="endtime" name="endtime" placeholder="Select time" type="text">
													<div class="input-group-append">
														<span class="input-group-text">
														<i class="la la-clock-o"></i>
													</span>
												</div>
											</div>
										</div>
                                    </div>
                                    
                                    <div class="form-group row">													
										<div class="kt-checkbox-list">
											<label class="kt-checkbox" style="margin-left: 10px;margin-top: 20px;">
											    <input type="checkbox" name="allday" id="allday"> All day
												<span></span>
											</label>														
										</div>
                                    </div>
                                    <div class="form-group row" style="margin-left: 10px;">
										<label>Or select days</label>
										<div class="kt-checkbox-inline">
											<label class="kt-checkbox">
                                                <input type="checkbox" name="sun" id="sun"> Sunday&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <span></span>
                                            </label>
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="mon" id="mon"> Monday&nbsp;&nbsp;&nbsp;&nbsp;
                                                <span></span>
                                            </label>
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="tue" id="tue"> Tuesday
                                                <span></span>
                                            </label>
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="wed" id="wed"> Wednesday
                                                <span></span>
                                            </label>
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="thu" id="thu"> Thursday&nbsp;&nbsp;
                                                <span></span>
                                            </label>
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="fri" id="fri"> Friday
                                                <span></span> 
                                            </label>
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="sat" id="sat"> Saturday
                                                <span></span>
											</label>														
										</div>													
									</div>

                                <div>
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

	<?php $this->load->view("simin/_includes/delete_dialog.php"); ?>
	</body>

	<!-- end::Body -->
</html>