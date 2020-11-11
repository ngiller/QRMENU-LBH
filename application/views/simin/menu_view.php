<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
							<div class="col-sm-12">
								<div class="kt-portlet">
									<div class="kt-portlet__head">
										<div class="kt-portlet__head-label">
											<form class="form-select-outlet">
												<div class="row">
													<label class="col-2 label-select-property">Outlet :</label>
													<div class="col-9">
														<select class="form-control select-outlet" id="select_outlet">
															<?php
															foreach ($select_outlet->result() as $row) :
																if ($this->session->outletid  == "") {
																	$this->session->set_userdata('outletid', $row->id);
																}
																if ($this->session->outletid == $row->id) {
															?>
																	<option value="<?php echo $row->id; ?>" selected><?php echo $row->name; ?></option>
																<?php } else { ?>
																	<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
															<?php }
															endforeach; ?>
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
													<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#show_record" onclick="add_record()"><i class="flaticon-add-circular-button"></i> Add Record</button> <button type="button" name="btnDelete" class="btn btn-danger btn-sm" value="Delete" onclick="del_record()"><i class="flaticon-delete"></i> Delete Record</button>
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
																<th>Menu Name</th>
																<th>Category</th>
																<th>Price</th>
																<th>Disc</th>
																<th>Sub Menu</th>
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

			$('#limited_stock').change(function() {
				if (this.checked) {
					$('#stock_div').show();
				} else {
					$('#stock_div').hide();
				}
			})

			$('#select_property').change(function() {
				var id = $(this).val();
				$.ajax({
					url: "<?php echo base_url(); ?>simin/menu/change_property/",
					method: "POST",
					data: {
						id: id
					},
					dataType: 'JSON',
					success: function(emp) {
						reload_table();

					}
				});
			});

			$('#select_outlet').change(function() {
				var id = $(this).val();
				$.ajax({
					url: "<?php echo base_url(); ?>simin/menucat/change_outlet/",
					method: "POST",
					data: {
						id: id
					},
					dataType: 'JSON',
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
				"ajax": {
					"url": "<?php echo site_url('simin/menu/ajax_list') ?>",
					"type": "POST"
				}, // Load data for the table's content from an Ajax source
				"columnDefs": [{
						"width": "30px",
						"targets": [-1]
					},
					{
						"width": "110px",
						"targets": [-2]
					},
					{
						"width": "80px",
						"targets": [-3]
					},
					{
						"className": 'dt-body-right',
						"targets": [-5]
					},
					{
						"width": "40px",
						"targets": [-5]
					},
					{
						"width": "75px",
						"targets": [-8]
					},
					{
						"width": "40px",
						"targets": [-9]
					},
					{
						"targets": [-1],
						"orderable": false,
					},
					{
						"targets": [-2],
						"orderable": false,
					},
					{
						"targets": [-9],
						"orderable": false,
					}
				]

			});

			subtable = $('#submenu_table').DataTable({
				"paging": false,
				"ordering": false,
				"lengthChange": false,
				"searching": false,
				"responsive": true,
				"pageLength": 25,
				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.			
				"ajax": {
					"url": "/simin/submenu/ajax_list/1",
					"type": "POST"
				}, // Load data for the table's content from an Ajax source
				"columnDefs": [{
						"width": "3px",
						"targets": [5]
					},
					{
						"width": "50px",
						"targets": [-2]
					},
					{
						"width": "60px",
						"targets": [-3]
					}
				]

			});

			//set input/textarea/select event when change value, remove class error and remove text help block 
			$("input").change(function() {
				$(this).parent().parent().removeClass('has-error');
				$(this).removeClass('is-invalid');
				$(this).next().empty();
			});

			$("#code").change(function(event) {
				if ($("#loginid").val() == "") {
					var pass = $(this).val();
					$("#loginid").val(pass);
				}
			});

			$("#file").change(function(event) {
				var fd = new FormData();
				var files = $('#file')[0].files[0];
				fd.append('file', files);

				$.ajax({
					url: '<?php echo site_url('simin/menu/do_upload') ?>',
					type: 'POST',
					data: fd,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response != 0) {
							$('#employee-photo').attr('src', '<?php echo site_url('assets/media/users/') ?>' + response);
							$('.custom-file-label').text(response);
							$('#imgPhoto').val(response);
						} else {
							alert('file not uploaded');
						}
					}
				});
				//readURL(this);    
			});

		});

		function reload_table() {
			table.ajax.reload(null, false); //reload datatable ajax 
		}

		function add_record() {
			save_method = 'add';
			$('#form_menu')[0].reset(); // reset form on modals
			$('.form-group').removeClass('has-error'); // clear error class
			$('#code').removeClass('is-invalid');
			$('#name').removeClass('is-invalid');
			$("#other_outlet").prop("checked", true);
			$('#stock_div').hide();
			$('.invalid-feedback').empty(); // clear error string
			$('#modal_form').modal('show'); // show bootstrap modal
			$('.modal-title').text('Add Menu'); // Set Title to Bootstrap modal title
		}

		function save() {
			$('#btnSave').text('saving...'); //change button text
			$('#btnSave').attr('disabled', true); //set button disable 
			var url;

			if (save_method == 'add') {
				url = "<?php echo site_url('simin/menu/add_save') ?>";
			} else {
				url = "<?php echo site_url('simin/menu/ajax_update') ?>";
			}

			// ajax adding data to database
			$.ajax({
				url: url,
				type: "POST",
				data: $('#form_menu').serialize(),
				dataType: "JSON",
				success: function(data) {
					if (data.status) {
						$('#modal_form').modal('hide');
						reload_table();
					} else {
						for (var i = 0; i < data.inputerror.length; i++) {
							$('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
							$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
							$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
						}
					}
					$('#btnSave').text('save'); //change button text
					$('#btnSave').attr('disabled', false); //set button enable             
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert('Error adding / update data');
					$('#btnSave').text('save'); //change button text
					$('#btnSave').attr('disabled', false); //set button enable       
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
				callback: function(result) {
					if (result) {
						// ajax delete data to database
						$.ajax({
							url: "<?php echo site_url('simin/menu/delete') ?>/" + id,
							type: "POST",
							dataType: "JSON",
							success: function(data) {
								reload_table();
							},
							error: function(jqXHR, textStatus, errorThrown) {
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
				url: "<?php echo site_url('simin/menu/ajax_edit/') ?>/" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data) {
					$('[name="id"]').val(data.id);
					$('[name="old-code"]').val(data.code);
					$('[name="old-name"]').val(data.name);
					if (data.active == 0) {
						$("#active").prop("checked", true);
					} else {
						$("#active").prop("checked", false);
					}
					$('[name="code"]').val(data.code);
					$('[name="name"]').val(data.name);
					$('[name="catid"]').val(data.categoryid);
					$('[name="desc"]').val(data.descriptions);
					$('[name="price"]').val(data.price);

					if (data.limited_stock == 0) {
						$("#limited_stock").prop("checked", true);
						$('#stock_div').show();
					} else {
						$("#limited_stock").prop("checked", false);
						$('#stock_div').hide();
					}
					$('[name="stock"]').val(data.stock);
					$('[name="min_order"]').val(data.min_order);
					$('[name="disc"]').val(data.disc);
					if (data.halal == 0) {
						$("#halal").prop("checked", true);
					} else {
						$("#halal").prop("checked", false);
					}
					if (data.chefrecomend == 0) {
						$("#chefrecom").prop("checked", true);
					} else {
						$("#chefrecom").prop("checked", false);
					}
					if (data.special == 0) {
						$("#special").prop("checked", true);
					} else {
						$("#special").prop("checked", false);
					}
					if (data.favourite == 0) {
						$("#favourite").prop("checked", true);
					} else {
						$("#favourite").prop("checked", false);
					}
					if (data.order_other_outlet == 0) {
						$("#other_outlet").prop("checked", true);
					} else {
						$("#other_outlet").prop("checked", false);
					}
					$('#first-create').text(data.datefirst + ' by ' + data.firstname);
					$('#last-update').text(data.datelast + ' by ' + data.lastname);
					$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
					$('.modal-title').text('Edit Menu'); // Set title to Bootstrap modal title

				},
				error: function(jqXHR, textStatus, errorThrown) {
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
				callback: function(result) {
					if (result) {
						var id = [];

						$(':checkbox:checked').each(function(i) {
							id[i] = $(this).val();
						});

						if (id.length === 0) {
							bootbox.alert({
								title: "Warning",
								message: "Please Select at least one checkbox"
							});
						} else {

							// ajax delete data to database
							$.ajax({
								url: "<?php echo site_url('simin/menu/del_selected') ?>",
								type: "POST",
								dataType: "JSON",
								data: {
									id: id
								},
								success: function(data) {
									reload_table();
									var html = '';
									var i;
									for (i = 0; i < data.data.length; i++) {
										html += '<option>' + data.data[i].name + '</option>';
									}
									$('#select_property').html(html);
								},
								error: function(jqXHR, textStatus, errorThrown) {
									alert('Error deleting data');
								}
							});
						}
					}
				}
			});
		}

		function show_gallery(id) {
			window.location.href = "/simin/menu/image/" + id;
		}

		function submenu(id) {
			window.location.href = "/simin/menu/submenu/" + id;
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
				<form id="form_menu" name="form_menu" class="form-horizontal">
					<div class="modal-body form">
						<div class="row">
							<div class="col-sm-11">
								<div class="kt-section__body">
									<input type="hidden" value="" name="id" />
									<input type="hidden" value="" name="old-code" />
									<input type="hidden" value="" name="old-name" />
									<input type="hidden" value="" name="imgPhoto" id="imgPhoto" />
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
										<label for="name" class="col-sm-3 col-form-label">Code</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="code" required="true" id="code" placeholder="menu code">
											<span class="error invalid-feedback"></span>
										</div>
									</div>
									<div class="form-group row">
										<label for="name" class="col-sm-3 col-form-label">Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="name" required="true" id="name" placeholder="Name">
											<span class="error invalid-feedback"></span>
										</div>
									</div>
									<div class="form-group row">
										<label for="name" class="col-sm-3 col-form-label">Category</label>
										<div class="col-sm-9">
											<select class="form-control" id="catid" name="catid">
												<?php
												foreach ($menucat_data as $row) {
													if ($row->sub_of == 0) {
												?>
														<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
													<?php
													} else {
													?>
														<option value="<?php echo $row->id; ?>"><?php echo "&nbsp;&nbsp;&nbsp; > " . $row->name; ?></option>
												<?php

													};
												};
												?>
											</select>
											<span class="error invalid-feedback"></span>
										</div>
									</div>
									<div class="form-group row">
										<label for="name" class="col-sm-3 col-form-label">Short Description</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Price</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" name="price" required="true" id="price">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Limited Stock</label>
										<div class="col-sm-3">
											<span class="kt-switch kt-switch--sm">
												<label>
													<input type="checkbox" name="limited_stock" id="limited_stock">
													<span></span>
												</label>
											</span>
										</div>
										<div class="col-6" id="stock_div">
											<div class="row">
												<label class="col-sm-4 col-form-label">Stock Ready:</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="stock" required="true" id="stock">
												</div>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Minimum Order</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" name="min_order" required="true" id="min_order" value="1">
										</div>
									</div>
									<div class="form-group row" style="margin-bottom:0px">
										<label class="col-sm-3 col-form-label">Disc</label>
										<div class="col-sm-3">
											<select class="form-control" id="disc" name="disc">
												<option value="0"> </option>
												<?php foreach ($menudisc_data as $row) : ?>
													<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group row mt-3">
										<label class="col-sm-3 col-form-label">Allow order from other outlet</label>
										<div class="col-sm-8">
											<span class="kt-switch kt-switch--sm">
												<label>
													<input type="checkbox" checked="checked" name="other_outlet" value="0" id="other_outlet">
													<span></span>
												</label>
											</span>
										</div>
									</div>
									<div class="form-group row mt-3" style="margin-left:0px !important">
										<div class="col-sm-12" style="margin-left:0px !important">
											<div class="row" style="padding-left:0px !important">
												<div class="col-sm-6" style="padding-left:0px !important">
													<div class="form-group row" style="padding-left:0px !important;margin-bottom:0px;">
														<label class="col-sm-6 col-form-label" style="padding-left:0px !important">Heated</label>
														<div class="col-sm-6">
															<span class="kt-switch kt-switch--sm">
																<label>
																	<input type="checkbox" name="halal" value="0" id="halal">
																	<span></span>
																</label>
															</span>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group row" style="margin-bottom:-20px">
														<label class="col-sm-6 col-form-label">Chef Recommendation</label>
														<div class="col-sm-6">
															<span class="kt-switch kt-switch--sm">
																<label>
																	<input type="checkbox" name="chefrecom" value="0" id="chefrecom">
																	<span></span>
																</label>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group row" style="margin-left:0px !important">
										<div class="col-sm-12" style="margin-left:0px !important">
											<div class="row" style="padding-left:0px !important">
												<div class="col-sm-6" style="padding-left:0px !important">
													<div class="form-group row" style="padding-left:0px !important;margin-bottom:0px;">
														<label class="col-sm-6 col-form-label" style="padding-left:0px !important">Favourite Menu</label>
														<div class="col-sm-6">
															<span class="kt-switch kt-switch--sm">
																<label>
																	<input type="checkbox" name="favourite" value="0" id="favourite">
																	<span></span>
																</label>
															</span>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group row">
														<label class="col-sm-6 col-form-label">Special Menu</label>
														<div class="col-sm-6">
															<span class="kt-switch kt-switch--sm">
																<label>
																	<input type="checkbox" name="special" value="0" id="special">
																	<span></span>
																</label>
															</span>
														</div>
													</div>
												</div>
											</div>
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

	<div class="modal fade" id="upload" role="dialog" aria-labelledby="upload" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Photo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="form-horizontal" id="uploadform" action="<?php echo base_url() . 'simin/menu/upload_image' ?>" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<div id='img_contain'>
							<div class="form-group" style="height: 220px;">
								<img id="employee-photo" class="employee-photo" src="<?php echo base_url() . 'assets/media/users/default.jpg' ?>" />
							</div>

							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-danger" id="confirm">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php $this->load->view("simin/_includes/delete_dialog.php"); ?>
</body>

<!-- end::Body -->

</html>