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
                    <form id="checkout_form" name="checkout_form" method="POST" action="/checkout/save">

                        <div class="col-12 col-lg-8">
                            <div class="checkout_details_area mt-30 clearfix">

                                <div class="cart-title">
                                    <h2>Checkout</h2>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?php echo (!empty($guest_data)) ? $guest_data->email : "" ?>" required>
                                        <span class="error invalid-feedback"></span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo (!empty($guest_data)) ? $guest_data->name : "" ?>" placeholder="Your Name" required>
                                        <span class="error invalid-feedback"></span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo (!empty($guest_data)) ? $guest_data->phone : "" ?>" placeholder="Phone" required>
                                        <span class="error invalid-feedback"></span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <select class="w-100 form-control" id="country" name="country" required>
                                            <option value="" <?php echo ($guest_data == "") ? "selected" : "" ?>>Country of origin</option>
                                            <?php
                                            $select = "";
                                            foreach ($country_data as $country) {
                                                if ($guest_data != "") {
                                                    if ($guest_data->country == $country->id) {
                                                        $select = "selected";
                                                    } else {
                                                        $select = "";
                                                    }
                                                }
                                            ?>
                                                <option value="<?php echo $country->id; ?>" <?php echo $select; ?>>
                                                    <?php echo ucfirst(strtolower($country->name)); ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="error invalid-feedback"></span>
                                    </div>
                                    <!--<div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="roomno" name="roomno"
                                            placeholder="Room number if available" value="<?php //echo (!empty($guest_data))? $this->session->roomno: ""
                                                                                            ?>">
                                    </div>-->
                                    <!--<div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="pax" name="pax" placeholder="Number of Pax" value="<?php //echo (!empty($guest_data))? $this->session->pax: ""
                                                                                                                                        ?>" required>
                                        <span class="error invalid-feedback"></span>
                                    </div>-->
                                    <div class="col-12 mb-3">
                                        <select class="form-control" id="payment" name="payment" required>
                                            <option value="" <?php echo (empty($guest_data)) ? "selected" : "" ?>>Payment method</option>
                                            <option value="1" <?php echo ($this->session->payment == 1) ? "selected" : "" ?>>Cash</option>
                                            <!--<option value="2" <?php //echo ($this->session->payment == 2) ? "selected" : "" ?>>Charge to room</option>-->
                                            <option value="3" <?php echo ($this->session->payment == 3) ? "selected" : "" ?>>Credit Card</option>
                                            <option value="3" <?php echo ($this->session->payment == 4) ? "selected" : "" ?>>QRIS</option>
                                        </select>
                                        <span class="error invalid-feedback"></span>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea name="note" class="form-control">Note</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                        //--------------if stock not available---------------------
                        if ($error_msg <> '') {
                        ?>
                            <div class="col-12">
                                <div class="card mt-30">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12" style="border: 1px dashed red; color: red">
                                                <?php echo $error_msg; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="col-12">
                            <div class="card mt-30">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 style="font-size: 18px;">Order Items</h5>
                                        </div>
                                    </div>
                                    <?php
                                    foreach ($this->cart->contents() as $items) {
                                    ?>
                                        <div class="row">
                                            <div class="col-12">
                                                <hr style="border-top: 1px solid;">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                            <?php
                                                $menu = $this->menu_model->get_by_id($items['id']);
                                            ?>
                                                <h6 class="menu_name_cart" style="font-weight: 600;"><?php echo wordwrap($menu->name, 40, "<br>\n"); ?></h6>
                                            </div>
                                        </div>
                                        <?php
                                        if ($this->cart->has_options($items['rowid'])) {
                                            $options = $this->cart->product_options($items['rowid']);
                                            foreach ($options as $opt_item) {
                                        ?>
                                                <div class="row">
                                                    <div class="col-12" style="font-weight: normal;">
                                                        <?php echo $opt_item[1]; ?> :<br> <?php echo $opt_item[3];
                                                                                            echo ($opt_item[4] > 0) ? " Rp. " . number_format($opt_item[4]) : "" ?>
                                                    </div>
                                                </div>
                                                <hr style="border-top: 1px dashed rgba(0,0,0,.3);margin-top: 8px; margin-bottom: 8px;">
                                        <?php
                                            }
                                        }
                                        ?>
                                        <div class="row mt-2">
                                            <div class="col-5" style="font-weight: normal;">
                                                Qty : <?php echo $items['qty']; ?>
                                            </div>
                                            <?php if ($items['price'] > 0) { ?>
                                                <div class="col-7 d-flex justify-content-end" style="font-weight: normal;">
                                                    @ Rp. <?php echo number_format($items['price'], 0, ",", "."); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        if (!empty($items['note'])) {
                                        ?>
                                            <hr>
                                            <div class="row mt-3">
                                                <div class="col-12" style="font-weight:normal">
                                                    Note :
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-12 d-flex justify-content-start" style="font-weight:normal">
                                                    <?php echo $items['note']; ?>
                                                </div>
                                            </div>
                                        <?php
                                        }

                                        if ($items['price'] > 0) {
                                        ?>

                                            <div class="row">
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-5" style="font-weight: normal;">
                                                    Sub Total :
                                                </div>
                                                <div class="col-7 d-flex justify-content-end">
                                                    Rp. <?php echo number_format($items['price'] * $items['qty'], 0, ",", "."); ?>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="cart-summary">
                                <?php
                                if ($this->cart->total() > 0) {
                                ?>
                                    <h5>Cart Total</h5>

                                    <div class="row mt-30">
                                        <div class="col-6">
                                            Subtotal:
                                        </div>
                                        <div class="col-6" style="text-align:right">
                                            Rp. <span id="subtotal"><?php echo number_format($this->cart->total(), 0, ",", "."); ?></span>
                                        </div>
                                    </div>

                                    <div class="row mt-30">
                                        <div class="col-6">
                                            Service :
                                        </div>
                                        <div class="col-6" style="text-align:right">
                                            Rp. <span id="service-value"><?php echo number_format($this->cart->total() * $service->value / 100, 0, ",", "."); ?></span>
                                        </div>
                                    </div>

                                    <div class="row mt-30">
                                        <div class="col-6">
                                            G.Tax :
                                        </div>
                                        <div class="col-6" style="text-align:right">
                                            Rp. <span id="tax-value"><?php echo number_format($this->cart->total() * $tax->value / 100, 0, ",", "."); ?></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <strong>Total:</strong>
                                        </div>
                                        <div class="col-6" style="text-align:right">
                                            <strong>Rp.</strong> <span id="total"><strong><?php echo number_format($this->cart->total() + ($this->cart->total() * $tax->value / 100) + ($this->cart->total() * $service->value / 100), 0, ",", "."); ?></strong></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="cart-btn mt-30">
                                    <button class="btn amado-btn w-100" type="submit">Place Order</button>
                                    <!--<button class="btn amado-btn w-100" onclick="save()">Place Order</button>-->
                                    <a href="/cart" style="margin-top: 10px;" class="btn amado-btn w-100">Modify Order</a>
                                    <a href="/menu/category" style="margin-top: 10px;" class="btn amado-btn w-100">Continue Order</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <?php $this->load->view("_includes/js_page.php"); ?>
    <script type="text/javascript" src="/assets/js/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#checkout_form").validate();

            $('#email').change(function() {

                url = "<?php echo site_url('/checkout/find_guest') ?>";

                // ajax adding data to database
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#checkout_form').serialize(),
                    dataType: "JSON",
                    success: function(data) {
                        $("#name").val(data.name);
                        $("#phone").val(data.phone);
                        $('#country').val(data.country);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                    }
                });
            });
        });
        /*
                    function save() {				
                        
        				url = "<?php echo site_url('/checkout/save') ?>";
        				
        				// ajax adding data to database
        				$.ajax({
        					url : url,
        					type: "POST",
        					data: $('#checkout_form').serialize(),
        					dataType: "JSON",					
        					success: function(data) {    
        						if(data.status) {
                                    window.location.replace("/checkout/finish");
        						} else  {
        							for (var i = 0; i < data.inputerror.length; i++) {                                
        								$('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
        								$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
        								$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
        							}
        						}					
        					},
        					error: function (jqXHR, textStatus, errorThrown) {
        						alert('Error adding / update data ' +  errorThrown);  
        					}
        				});
        			}
                
        */
    </script>

</body>

</html>