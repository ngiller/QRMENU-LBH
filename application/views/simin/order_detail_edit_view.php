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
                            <div class="kt-portlet">
                                <div class="kt-portlet__head" style="display: block;">                                        
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <div class="row">
                                                <label class="col-3 d-flex justify-content-end">
                                                    <h6>Order # :</h6>
                                                </label>
                                                <div class="col-9" id="orderid"
                                                    data-id="<?php echo $order_data->id; ?>">
                                                    <?php echo $order_data->id; ?></div>
                                            </div>
                                            <div class="row">
                                                <label class="col-3 d-flex justify-content-end">
                                                    <h6>Date :</h6>
                                                </label>
                                                <div class="col-9"><?php echo $order_data->orderdate; ?></div>
                                            </div>                                            
                                            <div class="row d-flex justify-content-end ">
                                                <label class="col-3 d-flex justify-content-end">
                                                    <h6>Payment :</h6> 
                                                </label>
                                                <div class="col-9">
                                                    <?php 
                                                        switch($order_data->payment) {
                                                            case 1 :    echo " CASH";
                                                                        break;
                                                            case 2 :    echo " CHARGE TO ROOM";
                                                                         break;
                                                            case 3 :    echo " CREDIT CARD";
                                                                        break;
                                                        }                                                            
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-3 d-flex justify-content-end">
                                                    <h6>STATUS :</h6>
                                                </label>
                                                <div class="col-9">
                                                    <h6>
                                                        <div id="status" data-id="<?php echo $order_data->status;?>">
                                                            <?php 
                                                            switch($order_data->status) {
                                                                case 0 :    echo " WAITING";
                                                                            break;
                                                                case 1 :    echo " CONFIRM";
                                                                            break;
                                                                case 2 :    echo " CANCEL";
                                                                            break;
                                                            }                                                            
                                                        ?></div>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">

                                            <div class="row d-flex justify-content-end mb-3">
                                                <span class="mt-2 mr-3">
                                                    <h6>Change Status to : </h6>
                                                </span>
                                                <span><button type="button" class="btn btn-danger btn-sm mr-2"
                                                        id="cancel">CANCEL</button></span>
                                                <span><button type="button" class="btn btn-primary btn-sm"
                                                        id="confirm">CONFIRM</button></span>
                                            </div>                                            
                                        </div>
                                    </div>

                                </div>
                                <div class="kt-portlet__head mb-2" style="display: block;">
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <div class="row">
                                                <label class="col-3 d-flex justify-content-end">
                                                    <h6>Table # :</h6>
                                                </label>
                                                <div class="col-9" id="orderid"
                                                    data-id="<?php echo $order_data->id; ?>">
                                                    <?php echo $order_data->table_num; ?></div>
                                            </div>
                                            <!--<div class="row">
                                                <label class="col-3 d-flex justify-content-end">
                                                    <h6>Pax :</h6>
                                                </label>
                                                <div class="col-9"><?php echo $order_data->pax; ?></div>
                                            </div>-->
                                            <div class="row">
                                                <label class="col-3 d-flex justify-content-end">
                                                    <h6>Room No :</h6>
                                                </label>
                                                <div class="col-9">
                                                    <div class="col-9"><?php echo $order_data->roomno; ?></div>                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <label class="col-3 d-flex justify-content-end">
                                                    <h6>Email : </h6>
                                                </label>
                                                <div class="col-9" id="orderid">
                                                    <?php echo $order_data->email; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-3 d-flex justify-content-end">
                                                    <h6>Name : </h6>
                                                </label>
                                                <div class="col-9"><?php echo $order_data->guestname; ?></div>
                                            </div>
                                            <div class="row">
                                                <label class="col-3 d-flex justify-content-end">
                                                    <h6>Phone : </h6>
                                                </label>
                                                <div class="col-9">
                                                    <?php echo $order_data->phone; ?>                                             
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div>
                                <div class="kt-portlet__body mt-2">
                                    <!--begin::Section-->
                                    <div class="kt-section">                                        
                                        <div class="kt-section__content">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20px;">#</th>
                                                        <th>Menu Name</th>
                                                        <th style="text-align: right;">Qty</th>
                                                        <th style="text-align: right;">Price</th>
                                                        <th style="text-align: right;">Disc</th>
                                                        <th style="text-align: right;">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $line = 1;
                                                        foreach ($detail_data as $items) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $line++; ?></td>
                                                        <td><?php echo $items->name; ?></td>
                                                        <td style="text-align: right;"><?php echo $items->qty; ?></td>
                                                        <td style="text-align: right;">Rp. <?php echo number_format($items->price,0,",","."); ?></td>
                                                        <td style="text-align: right;"><?php echo $items->disc; ?></td>
                                                        <td style="text-align: right;">Rp. <?php echo number_format(($items->price - ($items->price * $items->disc / 100)) * $items->qty ,0,",","."); ?></td>
                                                    </tr>
                                                    <?php
                                                        if ($items->note != "") {
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Note : <?php echo $items->note; ?></td>
                                                        
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;"></td>
                                                    </tr>
                                                    <?php        
                                                        }
                                                    ?>
                                                    <?php
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;">Sub Total</td>
                                                        <td style="text-align: right;">Rp. <?php echo number_format($order_data->subtotal ,0,",","."); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td style="border: none;">Order Note :</td>
                                                        <td style="text-align: right;border: none;"></td>
                                                        <td style="text-align: right;border: none;"></td>
                                                        <td style="text-align: right;">Tax <?php echo $tax_data->value; ?> %</td>
                                                        <td style="text-align: right;">Rp. <?php echo number_format($order_data->subtotal * $tax_data->value / 100 ,0,",","."); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td style="border: none;"><?php echo wordwrap($order_data->note,30,"<br>\n"); ?></td>
                                                        <td style="text-align: right;border: none;"></td>
                                                        <td style="text-align: right;border: none;"></td>
                                                        <td style="text-align: right;">Service <?php echo $service_data->value; ?> %</td>
                                                        <td style="text-align: right;">Rp. <?php echo number_format($order_data->subtotal * $service_data->value / 100 ,0,",","."); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td style="border: none;"></td>
                                                        <td style="text-align: right;border: none;"></td>
                                                        <td style="text-align: right;border: none;"></td>
                                                        <td style="text-align: right;"><h6>Total</h6></td>
                                                        <td style="text-align: right;"><h6><?php echo number_format($order_data->total ,0,",","."); ?></h6></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--end::Section--> 
                                    
                                    <div class="kt-section">                                        
                                        <hr>
                                        <div class="kt-section__content d-flex justify-content-end">                                            
                                            <button class="btn btn-sm btn-info" onclick="javascript:window.location.href ='<?php echo base_url().$back_to; ?>'">Close</button>
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
 
      		$(document).ready(function() {	

                var id = $('#status').attr("data-id");
                if (id == '2') {
                    $('#cancel').css("display", "none");
                } else {
                    if (id == '1') {
                        $('#confirm').css("display", "none"); 
                    }
                }			

				$('#select_property').change(function(){
					var id=$(this).val();					
					$.ajax({
						url : "<?php echo base_url();?>simin/menu/change_property/",
						method : "POST",
						data : {id: id},						
						dataType : 'JSON',
						success: function(emp){
							
							
						}
					});
				});

                $('#confirm').click(function(){
                    var id = $('#orderid').attr("data-id"); 
                    $.ajax({
						url : "<?php echo base_url();?>simin/order/change_status/",
						method : "POST",
						data : {id: id, status: 1},						
						dataType : 'JSON',
						success: function(emp){
							$("#confirm").css("display", "none");
							$("#cancel").show();
						}
					});   
                });	
                
                $('#cancel').click(function(){
                    var id = $('#orderid').attr("data-id"); 
                    $.ajax({
						url : "<?php echo base_url();?>simin/order/change_status/",
						method : "POST",
						data : {id: id, status: 2},						
						dataType : 'JSON',
						success: function(emp){
							$("#cancel").css("display", "none");
							$("#confirm").show();
						}
					});   
                });											
			});	
									
		</script>

	

	<?php $this->load->view("simin/_includes/delete_dialog.php"); ?>
	</body>

	<!-- end::Body -->
</html>