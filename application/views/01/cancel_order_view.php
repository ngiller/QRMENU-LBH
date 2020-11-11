<!DOCTYPE html>
<html lang="en">

<?php $this->load->view($this->session->template_folder."/_includes/head_page.php"); ?>

<body>
    <!-- Search Wrapper Area Start -->
    <?php $this->load->view($this->session->template_folder."/_includes/search.php"); ?>

    
    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <?php $this->load->view($this->session->template_folder."/_includes/mobile_nav.php"); ?>

        <!-- Header Area Start -->
        <?php $this->load->view($this->session->template_folder."/_includes/header.php"); ?>

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="cart-title mt-30 text-center">
                            <h3>Thank you</h3>
                            <h4>your order canceled</h4>
                            
                        </div>
                        <div class="card mt-30">
                            <div class="card-header">
                                ORDER # : <?php echo $order_master->id; ?>
                                <div class="mt-2">
                                    DATE : <?php echo $order_master->orderdate; ?>
                                </div>
                                <div class="mt-2">STATUS : 
                                <?php
                                    switch ($order_master->status) {
                                        case 0:
                                            echo "WAITING";
                                            break;
                                        case 1:
                                            echo "CONFIRM";
                                            break;
                                        case 2:
                                            echo "CANCEL";
                                            break;
                                    } 
                                ?>
                                </div>
                                <div class="mt-2">
                                    TABLE # : <?php echo $order_master->table_num; ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        Email :
                                    </div>
                                    <div class="col-8">
                                        <?php echo $order_master->email; ?>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">
                                        Name :
                                    </div>
                                    <div class="col-8">
                                        <?php echo $order_master->guestname; ?>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">
                                        Phone :
                                    </div>
                                    <div class="col-8">
                                        <?php echo $order_master->phone; ?>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">
                                        Country :
                                    </div>
                                    <div class="col-8">
                                        <?php echo ucfirst(strtolower($order_master->countryname)); ?>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">
                                        Note :
                                    </div>
                                    <div class="col-8">
                                        <?php echo $order_master->note; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cart-table clearfix">
                            <?php 
                                foreach($order_detail as $items) {
                            ?>
                            <div class="card mt-30">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 style="font-size: 18px;">Order Items</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="menu_name_cart"><?php echo wordwrap($items->name,40,"<br>\n"); ?></h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            Qty : <?php echo $items->qty; ?>
                                        </div>
                                        <div class="col-7 d-flex justify-content-end">
                                            @ Rp. <?php echo number_format($items->price,0,",","."); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            Sub Total :
                                        </div>
                                        <div class="col-7 d-flex justify-content-end">
                                            Rp. <?php echo number_format($items->price * $items->qty,0,",","."); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <?php
                                }
                            ?>                            
                        </div>                        
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="cart-summary">
                            <h5>Order Total</h5>
                            
                            <div class="row mt-30">
                                <div class="col-6">
                                    Sub Total :
                                </div>
                                <div class="col-6" style="text-align:right">
                                    Rp. <span id="subtotal"><?php echo number_format($order_master->subtotal,0,",","."); ?></span>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-6">
                                    Tax <span id="tax-percent"><?php echo $tax_data->value; ?></span>% :
                                </div>
                                <div class="col-6" style="text-align:right">
                                    Rp. <span id="tax-value"><?php echo number_format($order_master->subtotal * $tax_data->value / 100,0,",","."); ?></span>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-6">
                                    Service <span id="service-percent"><?php echo $service_data->value; ?></span>% :
                                </div>
                                <div class="col-6" style="text-align:right">
                                    Rp. <span id="service-value"><?php echo number_format($order_master->subtotal * $service_data->value / 100,0,",","."); ?></span>
                                </div>
                            </div>

                            <div class="row"><div class="col-12"><hr></div></div>
                            <div class="row">
                                <div class="col-6">
                                    <strong>Total:</strong>
                                </div>
                                <div class="col-6" style="text-align:right">
                                <strong>Rp.</strong> <span id="total"><strong><?php echo number_format($order_master->subtotal+($order_master->subtotal*$tax_data->value/100)+($order_master->subtotal*$service_data->value/100),0,",","."); ?></strong></span>
                                </div>
                            </div>                            
                            <div class="row"><div class="col-12"><hr></div></div>

                            <div class="cart-btn mt-30">
                            <?php
                                if ($order_master->status == 0) {
                            ?>
                                <a href="/checkout/cancel" class="btn amado-btn w-100">Cancel Order</a>
                            <?php } ?>
                            
                                
                                <a href="/menu/category" style="margin-top: 10px;" class="btn amado-btn w-100">Continue Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
    </div>
    

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <?php $this->load->view($this->session->template_folder."/_includes/js_page.php"); ?>

    <script>
        function updatetotal() {
            $.ajax({
                url : "<?php echo site_url('cart/show_total');?>",
                method : "GET",
                dataType: "JSON",
                success: function(data){                  
                    $('#subtotal').html(formatNumber(data));
                    var tax = document.getElementById('tax-percent').innerHTML;
                    var taxvalue = (data * tax) / 100; 
                    $('#tax-value').html(formatNumber(taxvalue));

                    var service = document.getElementById('service-percent').innerHTML;
                    var servicevalue = (data * service) / 100;
                    $('#service-value').html(formatNumber(servicevalue)); 

                    $('#total').html(formatNumber(data + taxvalue + servicevalue));

                },
					error: function (jqXHR, textStatus, errorThrown) {
					    alert('Error updating data');
				}
            });
            
        }
        function formatNumber(num) {
            return (
                num
                .toFixed(0)
                .replace('.', ',') // replace decimal point character with ,
                .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
            )
        }

        function change_qty(rowid, qty) {
            $.ajax({
                url : "<?php echo site_url('cart/update');?>/"+rowid+"/"+qty,
                method : "GET",
                dataType: "JSON",
                success: function(data){                    
                    $('#subtot-'+rowid).html(formatNumber(data.subtotal));
                    updatetotal();
                },
					error: function (jqXHR, textStatus, errorThrown) {
					    alert('Error updating data');
				}
            });
        }

        function remove(rowid) {
            $.ajax({
                url : "<?php echo site_url('cart/remove');?>/"+rowid,
                method : "POST",
                dataType: "JSON",
                success: function(data){                    
                    $('#row-'+rowid).css("display", "none");

                    updatetotal();
                },
					error: function (jqXHR, textStatus, errorThrown) {
					    alert('Error updating data');
				}
            });
        }
    </script>

</body>

</html>