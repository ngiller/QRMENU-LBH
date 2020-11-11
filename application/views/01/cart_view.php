<!DOCTYPE html>
<html lang="en">

<?php $this->load->view($this->session->template_folder . "/_includes/head_page.php"); ?>

<body>
    <!-- Search Wrapper Area Start -->
    <?php $this->load->view($this->session->template_folder . "/_includes/search.php"); ?>


    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <?php $this->load->view($this->session->template_folder . "/_includes/mobile_nav.php"); ?>

        <!-- Header Area Start -->
        <?php $this->load->view($this->session->template_folder . "/_includes/header.php"); ?>

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="cart-title mt-30">
                            <h2>Order Cart</h2>
                        </div>
                        <div class="cart-table clearfix">
                            <?php
                            $last_order = true;
                            $last_cat = -1;
                            foreach ($this->cart->contents(true) as $items) {
                            ?>
                                <div class="row row_cart_line" id="row-<?php echo $items['rowid']; ?>">
                                    <!--<div class="col-5 col-xs-5"><img class="img_cart" src="<?php //echo $items['image']; 
                                                                                                ?>"></div>-->
                                    <div class="col-12">
                                        <?php
                                        $menu = $this->menu_model->get_by_id($items['id']);
                                        if ($last_order) {
                                            $last_cat = $menu->categoryid;
                                            $last_order = false;
                                        }
                                        ?>
                                        <h6 class="menu_name_cart" style="font-weight: 500;"><?php echo $menu->name; ?></h6>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <?php

                                    //----------------- SUB MENU ----------------------------------------------
                                    if (count($items['options']) > 0) {
                                        $x = 0;
                                        //print_r($items['options']);
                                        foreach ($items['options'] as $opitem) {
                                    ?>
                                            <div class="col-12 d-flex justify-content-start">
                                                <?php echo $opitem[1]; ?>
                                            </div>
                                            <div class="col-12 mt-1 mr-2 mb-3">
                                                <select name="sl-<?php echo $items['line'] . "-" . $opitem[0]; ?>" id="sl-<?php echo $items['line'] . "-" . $opitem[0]; ?>" class="form-control" onchange="select_change('<?php echo $items['rowid']; ?>', '<?php echo $opitem[0]; ?>', this);">
                                                    <option id="0">Select one</option>
                                                </select>
                                            </div>
                                        <?php

                                        }
                                        ?>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    <?php } ?>
                                    <div class="col-5">
                                        <?php
                                        //=----------------------- CEK MINIMUM ORDER ----------------------------------
                                        $menu_item = $this->menu_model->get_by_id($items['id']);
                                        ?>
                                        <div class="qty-btn d-flex">
                                            <p>Qty</p>
                                            <div class="quantity">
                                                <span class="qty-minus" onclick="var effect = document.getElementById('qty-<?php echo $items['id']; ?>'); var qty = effect.value; if( !isNaN( qty ) && qty > <?php echo $menu_item->min_order; ?> ) { effect.value--; change_qty('<?php echo $items['rowid']; ?>', parseInt(qty)-1);} return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                <input type="number" class="qty-text" id="qty-<?php echo $items['id']; ?>" step="1" min="<?php echo $menu_item->min_order; ?>" max="10" name="quantity-<?php echo $items['id']; ?>" value="<?php echo $items['qty']; ?>" onchange="var effect = document.getElementById('qty-<?php echo $items['id']; ?>'); var qty = effect.value; change_qty('<?php echo $items['rowid']; ?>', parseInt(qty));">
                                                <span class="qty-plus" onclick="plus_qty(document.getElementById('qty-<?php echo $items['id']; ?>'), '<?php echo $items['rowid']; ?>', <?php echo $menu_item->stock; ?>)"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($items['price'] > 0) { ?>
                                        <div class="col-7" style="padding-top: 36px;text-align: right;">@ Rp. <span id="price-<?php echo $items['rowid']; ?>"><?php echo number_format($items['price'], 0, ",", "."); ?></span></div>
                                    <?php } ?>
                                    <div class="col-12">
                                        <h7 class="d-flex justify-content-start" style="font-weight: normal;">Order Note : </h7>
                                        <div class="d-flex justify-content-start">
                                            <textarea name="note-<?php echo $items['id']; ?>" id="note-<?php echo $items['id']; ?>" rows="2" style="width:100%; padding:7px;" onchange="var effect = document.getElementById('note-<?php echo $items['id']; ?>'); var note = effect.value; note_change('<?php echo $items['rowid']; ?>', note);"><?php echo $items['note']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <?php if ($items['price'] > 0) { ?>
                                        <div class="col-5" style="text-align:right">SubTotal:</div>
                                        <div class="col-7" style="text-align:right;">Rp. <span id="subtot-<?php echo $items['rowid']; ?>"><?php echo number_format($items['subtotal'], 0, ",", "."); ?></span></div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    <?php } ?>
                                    <div class="col-4" style="text-align:right"></div>
                                    <div class="col-12"><img class="trash_cart" id="remove-btn" src="<?php echo base_url('assets/img/trash.png'); ?>" onclick="remove('<?php echo $items['rowid']; ?>')"> <span id="remove-text" onclick="remove('<?php echo $items['rowid']; ?>')">remove</span></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="cart-summary">
                            <?php if ($this->cart->total() > 0) { ?>
                                <h5>Cart Total</h5>

                                <div class="row mt-3">
                                    <div class="col-6">
                                        Subtotal:
                                    </div>
                                    <div class="col-6" style="text-align:right">
                                        Rp. <span id="subtotal"><?php echo number_format($this->cart->total(), 0, ",", "."); ?></span>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-6">
                                        Service :
                                    </div>
                                    <div class="col-6" style="text-align:right">
                                        Rp. <span id="service-value"><?php echo number_format($this->cart->total() * $service->value / 100, 0, ",", "."); ?></span>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-6">
                                        Tax :
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
                                <div class="row" style="font-weight: 500;">
                                    <div class="col-6">
                                        Total:
                                    </div>
                                    <div class="col-6" style="text-align:right">
                                        Rp. <span id="total"><?php echo number_format($this->cart->total() + ($this->cart->total() * $tax->value / 100) + ($this->cart->total() * $service->value / 100), 0, ",", "."); ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="cart-btn mt-30">
                                <?php if ($this->cart->total_items() > 0) { ?>
                                    <a href="/checkout" id="checkout_btn" class="btn amado-btn w-100">Checkout</a>
                                <?php } ?>

                                <a href="/menu/item/<?php echo $last_cat; ?>" style="margin-top: 10px;" class="btn amado-btn w-100">Continue Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <?php $this->load->view($this->session->template_folder . "/_includes/js_page.php"); ?>
    <script type="text/javascript" src="/assets/js/numeral.js"></script>

    <script>
        $(document).ready(function() {
            var price = 0;

            <?php
            foreach ($this->cart->contents() as $items) {
                if (count($items['options']) > 0) {
                    $x = 0;
                    foreach ($items['options'] as $opitem) {
            ?>
                        $.ajax({
                            url: "<?php echo base_url(); ?>menu/view_by_submenuid/<?php echo $opitem[0]; ?>",
                            method: "POST",
                            dataType: 'JSON',
                            success: function(response) {

                                var len = response.length;
                                var val = '';

                                $("#sl-<?php echo $items['line'] . "-" . $opitem[0]; ?>").empty();
                                for (var i = 0; i < len; i++) {
                                    var id = response[i]['id'];
                                    var name = response[i]['name'];
                                    var prc = response[i]['price'];

                                    if (val == '') {
                                        val = id;
                                    } // kalau belum ada pilihan, pilihan pertama masukan variable

                                    if (prc > 0) {
                                        name = name + ' ( Rp. ' + numeral(prc).format('0,0') + ' )';
                                    }
                                    $("#sl-<?php echo $items['line'] . "-" . $opitem[0]; ?>").append("<option value='" + id + "'>" + name + "</option>");
                                }
                                <?php if ($opitem[2] <> '') { ?>
                                    $("#sl-<?php echo $items['line'] . "-" . $opitem[0]; ?>").val('<?php echo $opitem[2]; ?>').change();
                                <?php } else { ?> // kalau belum ada pilihan, pilihan pertama sdi select
                                    $("#sl-<?php echo $items['line'] . "-" . $opitem[0]; ?>").val(val).change();
                                <?php } ?>
                            }
                        });
            <?php }
                }
            } ?>
        });

        function select_change(rowid, submenuid, selectObject) {
            var itemid = selectObject.value;
            if (itemid != '') {
                $.ajax({
                    url: "<?php echo site_url('cart/options_update'); ?>/" + rowid + "/" + submenuid + "/" + itemid,
                    method: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#price-' + rowid).html(formatNumber(data.price));
                        $('#subtot-' + rowid).html(formatNumber(data.subtotal));
                        updatetotal();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error updating data' + errorThrown);
                    }
                });
            }
        }

        function note_change(rowid, note) {
            $.ajax({
                url: "<?php echo site_url('cart/note_update'); ?>/" + rowid + "/" + note,
                method: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#price-' + rowid).html(formatNumber(data.price));
                    $('#subtot-' + rowid).html(formatNumber(data.subtotal));
                    updatetotal();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error updating data' + errorThrown);
                }
            });
        }

        function updatetotal() {
            $.ajax({
                url: "<?php echo site_url('cart/show_total'); ?>",
                method: "GET",
                dataType: "JSON",
                success: function(data) {
                    if (data <= 0) {
                        $('#checkout_btn').hide();
                    } else {
                        $('#checkout_btn').show();
                    }
                    $('#subtotal').html(formatNumber(data));
                    var tax = <?php echo $tax->value; ?>;
                    var taxvalue = (data * tax) / 100;
                    $('#tax-value').html(formatNumber(taxvalue));

                    var service = <?php echo $service->value; ?>;;
                    var servicevalue = (data * service) / 100;
                    $('#service-value').html(formatNumber(servicevalue));

                    $('#total').html(formatNumber(data + taxvalue + servicevalue));

                },
                error: function(jqXHR, textStatus, errorThrown) {
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
            if (qty > 0) {
                $.ajax({
                    url: "<?php echo site_url('cart/update'); ?>/" + rowid + "/" + qty,
                    method: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#subtot-' + rowid).html(formatNumber(data.subtotal));
                        updatetotal();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error updating data');
                    }
                });
            }
        }

        function remove(rowid) {
            $.ajax({
                url: "<?php echo site_url('cart/remove'); ?>/" + rowid,
                method: "POST",
                dataType: "JSON",
                success: function(data) {
                    $('#row-' + rowid).css("display", "none");

                    updatetotal();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error updating data');
                }
            });
        }

        function plus_qty(id, rowid, stock) {
            var qty = id.value;
            if (stock == 0) {
                change_qty(rowid, parseInt(qty) + 1);
                if (!isNaN(qty)) {
                    id.value++;
                }
            } else {
                if ((parseInt(qty) + 1) <= stock) {
                    change_qty(rowid, parseInt(qty) + 1);
                    if (!isNaN(qty)) {
                        id.value++;
                    }
                }
            }
            return false;
        }
    </script>

</body>

</html>