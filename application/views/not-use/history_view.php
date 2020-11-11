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

        <div class="cart-table-area section-padding-100" style="padding-top:30px;height: 100%;">
            <div class="container-fluid">
                <div class="cart-title text-center">
                    <h3>Order History</h3>                            
                </div>
                <div class="card mt-30">                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                Email :
                            </div>
                            <div class="col-8">
                                <?php echo $guest->email; ?>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4">
                                Name :
                            </div>
                            <div class="col-8">
                                <?php echo $guest->name; ?>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4">
                                Phone :
                            </div>
                            <div class="col-8">
                                <?php echo $guest->phone; ?>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4">
                                Country :
                            </div>
                            <div class="col-8">
                                <?php echo ucfirst(strtolower($guest->countryname)); ?>
                            </div>
                        </div>                        
                    </div>
                </div>
                <?php
                    foreach($order_history as $items) {
                ?>
                <div class="card mt-3" style="font-weight: normal;">                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <?php echo $this->session->outletname; ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                Order # :
                            </div>
                            <div class="col-7">
                                : <?php echo $items->id; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                Date :
                            </div>
                            <div class="col-7">
                                : <?php echo $items->orderdate; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                Table # :
                            </div>
                            <div class="col-7">
                                : <?php echo $items->table_num; ?>
                            </div>
                        </div>
                        <!--<div class="row">
                            <div class="col-4">
                                Pax :
                            </div>
                            <div class="col-7">
                                : <?php echo $items->pax; ?>
                            </div>
                        </div>-->
                        <div class="row">
                            <div class="col-4">
                                Total 
                            </div>
                            <div class="col-7">
                                : <?php echo number_format($items->total,0,",","."); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                Status 
                            </div>
                            <div class="col-7">
                                : <?php
                                    switch ($items->status) {
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
                        </div>                        
                        <div class="row">
                            <div class="col-4">
                                Payment :
                            </div>
                            <div class="col-7">
                                : <?php
                                    switch ($items->payment) {
                                        case 1:
                                            echo "Cash";
                                            break;
                                        case 2:
                                            echo "Charge to room";
                                            break;
                                        case 3:
                                            echo "Credit card";
                                            break;
                                        case 4:
                                            echo "QRIS";
                                            break;
                                    } 
                                  ?>
                            </div>
                        </div>
                        <?php
                            if ($items->note <> '') { 
                        ?>
                        <div class="row mt-2">
                            <div class="col-4">
                                Note :
                            </div>
                            <div class="col-8">
                                <?php echo $items->note; ?>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        
                        <div class="row mt-3">
                            <div class="col-6"></div>
                            <div class="col-6 d-flex justify-content-end">
                            <a href="/history/detail/<?php echo $items->id; ?>" class="btn amado-btn w-100" style="height:40px;font-size:16px;min-width:0px">View Detail</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    
    
    </div>
    
    <?php $this->load->view("_includes/bottom_sticky.php"); ?>
    
    <!-- ##### Main Content Wrapper End ##### -->

    

    <?php $this->load->view("_includes/js_page.php"); ?>

</body>

</html>