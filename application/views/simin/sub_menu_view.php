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
								<div class ="col-lg-6">	
                                    <div class="kt-portlet kt-portlet--mobile">
                                        <div class="kt-portlet__head">
                                            <div class="kt-portlet__head-label">
                                                <h3 class="kt-portlet__head-title">
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#show_record" onclick="add_record()"><i class="flaticon-add-circular-button"></i> Add Record</button> <button type="button" name="btnDelete"  class="btn btn-danger btn-sm"  value="Delete" onclick="del_record()" ><i class="flaticon-delete"></i> Delete Record</button> <button type="button" name="btnDelete"  class="btn btn-warning btn-sm"  onclick="back_to_menu()" > Back to menu</button>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body">
                                            <table id="submenu_table" class="table table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Active</th>
                                                        <th>Order#</th>
                                                        <th>Sub Menu Name</th>
                                                        <th>Items</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>																										
                                                                                                                                                        
                                                </tbody>													
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="kt-portlet kt-portlet--solid-grey kt-portlet--height-fluid" data-ktportlet="true" id="submenuitem">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title" id="item-title">
													Portlet Title
												</h3>
											</div>
											<div class="kt-portlet__head-toolbar">
												<div class="kt-portlet__head-group">
													<a href="#" class="btn btn-sm btn-icon btn-outline-danger btn-icon-md" aria-describedby="tooltip_beoxfnr08e" id="close_item"><i class="la la-close"></i></a>
												<div class="tooltip tooltip-portlet tooltip bs-tooltip-top" role="tooltip" id="tooltip_beoxfnr08e" aria-hidden="true" x-placement="top" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(335px, -38px, 0px); visibility: hidden;">                            <div class="tooltip-arrow arrow" style="left: 32px;"></div>                            <div class="tooltip-inner">Remove</div>                        </div></div>
											</div>
										</div>
                                        <div class="kt-portlet__body">
										    <table id="subitem_table" class="table table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Active</th>
                                                        <th>Order#</th>
                                                        <th>Sub Menu Item</th>
                                                        <th>Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>																										
                                                                                                                                                        
                                                </tbody>													
                                            </table>
                                        </div>
                                        <div class="kt-portlet__foot">
                                            <div class="">
                                                <button class="btn btn btn-outline-brand btn-sm" data-id="10" data-num="" id="btn_add_item">New Item</button>
                                                <button type="reset" class="btn btn-secondary btn-sm" id="close-item">Close</button>
                                            </div>
                                        </div>
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
            var menuid = <?php echo $menuid; ?>;

      		$(document).ready(function() {		

                $('#submenuitem').hide();	

                $('#close_item').click(function(){
                    $('#submenuitem').hide();
                });
                $('#close-item').click(function(){
                    $('#submenuitem').hide();
                });	

                $('#btn_add_item').click(function(){
                    save_method = 'add';
                    var submenuid = $('#btn_add_item').attr("data-id");
					var submenuname = $('#btn_add_item').attr("data-num"); 

                    $('[name="submenuid"]').val(submenuid);		
                    $('#item_form').modal('show'); // show bootstrap modal
                    $('.item-title').text('Add Item of '+submenuname); // Set Title to Bootstrap modal title
                })

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

                subtable = $('#submenu_table').DataTable({ 
					"paging":   false,
        			"ordering": false,
					"lengthChange": false,
					"searching": false,
					"responsive": true,									
					"pageLength": 25,
					"processing": true, //Feature control the processing indicator.
					"serverSide": true, //Feature control DataTables' server-side processing mode.
					"order": [], //Initial no order.			
					"ajax": { "url": "/simin/submenu/ajax_list/"+menuid, "type": "POST" }, // Load data for the table's content from an Ajax source
					"columnDefs": [
						{ "width": "70px", "targets": [ -1 ] },
						{ "width": "70px", "targets": [ -2 ] },
						{ "width": "33px", "targets": [ -4 ] },
                        { "width": "33px", "targets": [ -5 ] }
  					]
				});

                subitemtable = $('#subitem_table').DataTable({ 
					"paging":   false,
        			"ordering": false,
					"lengthChange": false,
					"searching": false,
					"responsive": true,									
					"pageLength": 25,
					"processing": true, //Feature control the processing indicator.
					"serverSide": true, //Feature control DataTables' server-side processing mode.
					"order": [], //Initial no order.			
					"ajax": { "url": "/simin/submenuitem/ajax_list/1", "type": "POST" }, // Load data for the table's content from an Ajax source
					"columnDefs": [
						{ "width": "33px", "targets": [ 0 ] }
  					]
				});


				//set input/textarea/select event when change value, remove class error and remove text help block 
				$("input").change(function(){
					$(this).parent().parent().removeClass('has-error');
					$(this).removeClass('is-invalid');
					$(this).next().empty();
				});		

			});					
			
			function reload_table() {
				subtable.ajax.reload(null,false); //reload datatable ajax 
			}

            function reload_item_table() {
				subitemtable.ajax.reload(null,false); //reload datatable ajax 
			}

			function add_record() {
				save_method = 'add';
				$('#form_menu')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error class
				$('[name="menuid"]').val(menuid);
				$('#name').removeClass('is-invalid');			
				$('.invalid-feedback').empty(); // clear error string
				$('#modal_form').modal('show'); // show bootstrap modal
				$('.modal-title').text('Add Sub Menu'); // Set Title to Bootstrap modal title
			}

            function back_to_menu() {
                window.location.href = "/simin/menu/";
            }

			function save() {
				$('#btnSave').text('saving...'); //change button text
				$('#btnSave').attr('disabled',true); //set button disable 
				var url;
				
				if(save_method == 'add') {
					url = "<?php echo site_url('simin/submenu/add_save')?>";
				} else {
					url = "<?php echo site_url('simin/submenu/ajax_update')?>";
				}
				
				// ajax adding data to database
				$.ajax({
					url : url,
					type: "POST",
					data: $('#form_menu').serialize(),
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
                        reload_table();
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
								url : "<?php echo site_url('simin/submenu/delete')?>/"+id,
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
				$('#form_menu')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error class
				$('.help-block').empty(); // clear error string
			
				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('simin/submenu/ajax_edit/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{			
						$('[name="id"]').val(data.id);
						$('[name="menuid"]').val(data.menuid);
						if (data.active == 0) {
							$( "#active" ).prop( "checked", true );
						} else {
							$( "#active" ).prop( "checked", false );
						}
						$('[name="position"]').val(data.position);
						$('[name="name"]').val(data.name);
						$('#first-create').text(data.datefirst+' by '+data.firstname);  
						$('#last-update').text(data.datelast+' by '+data.lastname);     						
						$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
						$('.modal-title').text('Edit Sub Menu'); // Set title to Bootstrap modal title
			
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
									url : "<?php echo site_url('simin/submenu/del_selected/')?>"+menuid,
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

            function item_sub_menu(id) {
                
                $('#btn_add_item').attr("data-id", id);
                
                subitemtable.ajax.url('/simin/submenuitem/ajax_list/'+id).load();

                $.ajax({
					url : "<?php echo site_url('simin/submenu/ajax_edit')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data) {			
                        $('#item-title').text('Sub Menu of '+data.name);
						$('#btn_add_item').attr("data-num", data.name);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						alert('Error get data from ajax');
					}
				});
             
                $('#form_item')[0].reset(); // reset form on modals
                $('#submenuitem').show();
            }

            function itemsave() {
                $('#btnItemSave').text('saving...'); //change button text
				$('#btnItemSave').attr('disabled',true); //set button disable 
				var url;
				
				if(save_method == 'add') {
					url = "<?php echo site_url('simin/submenuitem/add_save')?>";
				} else {
					url = "<?php echo site_url('simin/submenuitem/ajax_update')?>";
				}
				
				// ajax adding data to database
				$.ajax({
					url : url,
					type: "POST",
					data: $('#form_item').serialize(),
					dataType: "JSON",					
					success: function(data) {    
						if(data.status) {
							$('#item_form').modal('hide');
                            //subitemtable.ajax.url('/simin/submenuitem/ajax_list/'+data.data.submenuid).load();							
							reload_item_table();								
						} else  {
							for (var i = 0; i < data.inputerror.length; i++) {
								$('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
								$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
								$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
							}
						}
						$('#btnItemSave').text('save'); //change button text
						$('#btnItemSave').attr('disabled',false); //set button enable             
					},
					error: function (jqXHR, textStatus, errorThrown) {
                        reload_item_table();
						$('#btnItemSave').text('save'); //change button text
						$('#btnItemSave').attr('disabled',false); //set button enable          
					}
				});
            }

			function edit_item(id) {
				save_method = 'update';
				var submenuname = $('#btn_add_item').attr("data-num");

				$('#form_item')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error class
				$('.help-block').empty(); // clear error string
			
				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('simin/submenuitem/ajax_edit/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{			
						$('[name="itemid"]').val(data.id);
						$('[name="submenuid"]').val(data.menuid);
						if (data.active == 0) {
							$( "#itemactive" ).prop( "checked", true );
						} else {
							$( "#itemactive" ).prop( "checked", false );
						}
						$('[name="itemposition"]').val(data.position);
						$('[name="itemname"]').val(data.name);
						$('[name="price"]').val(data.price);
						$('#item-first-create').text(data.datefirst+' by '+data.firstname);  
						$('#item-last-update').text(data.datelast+' by '+data.lastname);     						
						$('#item_form').modal('show'); // show bootstrap modal when complete loaded
						$('.item-title').text('Edit Item of '+submenuname); // Set title to Bootstrap modal title
			
					},
					error: function (jqXHR, textStatus, errorThrown) {
						alert('Error get data from ajax');
					}
				});
			}

			function delete_item(id) {
                
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
								url : "<?php echo site_url('simin/submenuitem/delete')?>/"+id,
								type: "POST",
								dataType: "JSON",
								success: function(data) {	
									reload_item_table();																		
								},
								error: function (jqXHR, textStatus, errorThrown) {
									alert('Error deleting data');
								}
							});
						}
					}
				});
			}
            
		</script>

	<!--------------- ADD SUB MENU --------------------------------------------------------------------------------------->
	<div class="modal fade" id="modal_form" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_menu" name="form_menu" class="form-horizontal">	
					<div class="modal-body form">										
						<div class="row">
							<div class="col-sm-11">
								<div class="kt-section__body">
                                    <input type="hidden" value="" name="id"/> 
                                    <input type="hidden" value="" name="menuid"/> 
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Active</label>
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
										<label for="name" class="col-sm-3 col-form-label">Order#</label>		
										<div class="col-sm-4">
											<input type="text" class="form-control" name="position" required="true" id="position" placeholder="Order number">																				
											<span class="error invalid-feedback"></span>
										</div>
									</div>
									<div class="form-group row">																			
										<label for="name" class="col-sm-3 col-form-label">Sub Menu Name</label>	
										<div class="col-sm-9">							
											<input type="text" class="form-control" name="name" required="true" id="name" placeholder="Sub menu name">																				
											<span class="error invalid-feedback"></span>
										</div>
									</div>
								</div>
							</div>							
						</div>						
						<div class="kt-section__body">
							<div class="kt-separator kt-separator--border-dashed"></div>     									
							<div class="row">
								<div class="col-sm-6">
									<div class="row">
										<div class="col-sm-3">
											Create :
										</div>
										<div class="col-sm-9" id="first-create"></div>														
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="row">
										<div class="col-sm-3">
											Update :
										</div>
										<div class="col-sm-9" id="last-update"></div>														
									</div>
								</div>
							</div>
						</div>
						
					
					</div>
					<div class="modal-footer">
						<button type="button" id="btnSave" onclick="save()" class="btn btn-success btn-sm">Save</button>
						<!--<button type="button" id="btnSave" class="btn btn-success btn-sm" type="submit">Save</button>-->
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
    <!-- End Bootstrap modal -->
    
    <!--------------- ADD ITEM SUB MENU --------------------------------------------------------------------------------------->
	<div class="modal fade" id="item_form" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="item-title" id="exampleModalLongTitle">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_item" name="form_item" class="form-horizontal">	
					<div class="modal-body form">										
						<div class="row">
							<div class="col-sm-11">
								<div class="kt-section__body">
                                    <input type="hidden" value="" name="itemid"/> 
                                    <input type="hidden" value="" name="submenuid"/> 
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Active</label>
										<div class="col-sm-8">
											<span class="kt-switch kt-switch--sm">
												<label>
													<input type="checkbox" checked="checked" name="itemactive" value="0" id="itemactive">
													<span></span>
												</label>
											</span>
										</div>
									</div>		
									<div class="form-group row">							
										<label for="name" class="col-sm-3 col-form-label">Order#</label>		
										<div class="col-sm-4">
											<input type="text" class="form-control" name="itemposition" required="true" id="itemposition" placeholder="Order number">																				
											<span class="error invalid-feedback"></span>
										</div>
									</div>
									<div class="form-group row">																			
										<label for="name" class="col-sm-3 col-form-label">Item Name</label>	
										<div class="col-sm-9">							
											<input type="text" class="form-control" name="itemname" required="true" id="itemname" placeholder="Item name">																				
											<span class="error invalid-feedback"></span>
										</div>
                                    </div>
                                    <div class="form-group row">																			
										<label for="name" class="col-sm-3 col-form-label">Price</label>	
										<div class="col-sm-9">							
											<input type="text" class="form-control" name="price" required="true" id="price" placeholder="Item price">																				
											<span class="error invalid-feedback"></span>
										</div>
									</div>
								</div>
							</div>							
						</div>						
						<div class="kt-section__body">
							<div class="kt-separator kt-separator--border-dashed"></div>     									
							<div class="row">
								<div class="col-sm-6">
									<div class="row">
										<div class="col-sm-3">
											Create :
										</div>
										<div class="col-sm-9" id="item-first-create"></div>														
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="row">
										<div class="col-sm-3">
											Update :
										</div>
										<div class="col-sm-9" id="item-last-update"></div>														
									</div>
								</div>
							</div>
						</div>
						
					
					</div>
					<div class="modal-footer">
						<button type="button" id="btnItemSave" onclick="itemsave()" class="btn btn-success btn-sm">Save</button>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- End Bootstrap modal -->


	<?php $this->load->view("simin/_includes/delete_dialog.php"); ?>
	</body>

	<!-- end::Body -->
</html>