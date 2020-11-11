<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("_includes/head_page.php"); ?>

<body>
    <!-- Search Wrapper Area Start -->
    <?php $this->load->view("_includes/search.php"); ?>

    
    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <?php $this->load->view("_includes/mobile_nav.php"); ?>

        <!-- Header Area Start -->
        <?php $this->load->view("_includes/header.php"); ?>

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="cart-title mt-30 text-center">
                            <h4>Thank you for your order</h4>
                            <?php
                                if ($order_master->status == 0) {
                            ?>
                                    <p>Our service staff will attend to your shortly</p>
                            <?php } ?>
                        </div>
                        <div class="card mt-30">
                            <div class="card-header">
                                <div class="mb-2 d-flex justify-content-end">
                                    <?php echo strtoupper($this->session->outletname); ?>
                                </div>
                                <div>
                                    ORDER # : <?php echo $order_master->id; ?>
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
                                <div class="mt-2">
                                    DATE : <?php echo $order_master->orderdate; ?>
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
                            <div class="card mt-30">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 style="font-size: 18px;">Order Items</h5>
                                        </div>
                                    </div>
                                    <?php 
                                        foreach($order_detail as $items) {
                                    ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <hr style="border-top: 1px solid">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="menu_name_cart" style="font-weight: 600"><?php echo wordwrap($items->name,40,"<br>\n"); ?></h6>
                                        </div>
                                    </div>
                                    <?php
                                        if ($this->order_detail_item_model->has_item($order_master->id, $items->menuid) > 0) {
                                            $sub_items = $this->order_detail_item_model->get_by_order($order_master->id, $items->line);
                                            foreach ($sub_items as $subitem) {
                                    ?>
                                    <div class="row mb-2">
                                        <div class="col-12" style="font-weight: normal;">
                                                <?php echo $subitem->subname; ?> :<br> <?php echo $subitem->itemname; echo ($subitem->price > 0)? " Rp. $subitem->price" : ""?> 
                                        </div>
                                    </div>
                                    <hr style="border-top: 1px dashed rgba(0,0,0,.3);margin-top: 8px; margin-bottom: 8px;">
                                    <?php
                                        } }
                                    ?>
                                    <div class="row mt-2">
                                        <div class="col-5" style="font-weight: normal">
                                            Qty : <?php echo $items->qty; ?>
                                        </div>
                                        <?php 
                                            if ($items->price > 0 ) {
                                        ?>
                                        <div class="col-7 d-flex justify-content-end" style="font-weight: normal">
                                            @ Rp. <?php echo number_format($items->price,0,",","."); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php
                                        if(!empty($items->note)) {
                                    ?>
                                   
                                    <hr style="border-top: 1px dashed rgb(0,0,0,0.5);">
                                       
                                    <div class="row mt-3">
                                        <div class="col-12" style="font-weight:normal">
                                            Note :
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-12 d-flex justify-content-start"  style="font-weight:normal">
                                            <?php echo $items->note; ?>
                                        </div>
                                    </div>
                                    <?php
                                        } //----note-----------
                                        if ($items->price > 0 ) {
                                    ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5" style="font-weight: normal">
                                            Sub Total :
                                        </div>
                                        <div class="col-7 d-flex justify-content-end">
                                            Rp. <?php echo number_format($items->price * $items->qty,0,",","."); ?>
                                        </div>
                                    </div>
                                    <?php
                                        } //----- if price --------------
                                    } //--foreach---------
                                    ?>
                                    
                                </div>
                            </div>                                                                                    
                        </div>                        
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="cart-summary">
                            <?php
                                if ($order_master->subtotal > 0) {
                            ?>
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
                            <?php
                                }
                            ?>
                            <div class="cart-btn mt-30">
                            <?php
                                if ($order_master->status == 0) {
                            ?>
                                <a href="/checkout/cancel/<?php echo $order_master->id; ?>" class="btn amado-btn w-100">Cancel Order</a>
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
    <?php $this->load->view("_includes/js_page.php"); ?>


</body>

</html>