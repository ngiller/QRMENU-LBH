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
															<input type="text" class="form-control" placeholder="Select date" id="kt_datepicker_1" name="fromdate" value="<?php echo $this->session->bdate; ?>">
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
													<label class="col-form-label col-lg-3 col-sm-12 text-right">To
														date</label>
													<div class="col-lg-8 col-md-9 col-sm-12">
														<div class="input-group date">
															<input type="text" class="form-control" placeholder="Select date" id="kt_datepicker_2" name="todate" value="<?php echo $this->session->edate; ?>">
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
												<button type="button" class="btn btn-success btn-sm" onclick="show_record()"><i class="flaticon2-accept"></i> Show Record</button>
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
																<th>ID</th>
																<th>Date</th>
																<th>Table</th>
																<th>Pax</th>
																<th>Guest Name</th>
																<th>Total</th>
																<th>Status</th>
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
					"url": "<?php echo site_url('simin/order/ajax_list') ?>",
					"type": "POST"
				}, // Load data for the table's content from an Ajax source
				"columnDefs": [{
						"width": "115px",
						"targets": [-1]
					},
					{
						"width": "150px",
						"targets": [-2]
					},
					{
						"targets": [-1],
						"orderable": false,
					}
				],
				"dom": 'Bfrtip',
				buttons: [{
						extend: 'csv',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5]
						},
						title: 'Order export'
					},
					{
						extend: 'excelHtml5',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5]
						},
						title: 'Order export'
					},
					{
						extend: 'pdfHtml5',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5]
						},
						title: 'order-export'
					}

				],
				"fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
					if (aData[6] == "CANCEL") {
						$('td', nRow).css('background-color', '#afaeae');
						$('td', nRow).css('color', '#fff');
					} else if (aData[6] == "WAITING") {
						$('td', nRow).css('background-color', '#f8ebbe');
					} else {
						$('td', nRow).css('background-color', '#fff');
					}
				}

			});

			//set input/textarea/select event when change value, remove class error and remove text help block 
			$("input").change(function() {
				$(this).parent().parent().removeClass('has-error');
				$(this).removeClass('is-invalid');
				$(this).next().empty();
			});
		});

		function show_record() {
			$.ajax({
				url: "<?php echo site_url('simin/order/show_record') ?>",
				type: "POST",
				data: $('#form-show_activity').serialize(),
				dataType: "JSON",
				success: function(data) {
					reload_table();
				}
			});
		}

		function reload_table() {
			table.ajax.reload(null, false); //reload datatable ajax 
		}

		function edit_record(id) {
			window.location.href = "/simin/order/detail/" + id;
		}
	</script>



	<?php $this->load->view("simin/_includes/delete_dialog.php"); ?>
</body>

<!-- end::Body -->

</html>