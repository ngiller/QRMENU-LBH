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

        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-100 clearfix">
            <div class="detail-container container-fluid">

                <h5 class="text-center" style="padding-top:30px;font-size: 16px;"><?php echo $menu_data->name; ?></h5>
                <div class="h4line"></div>

                <div class="row">
                    <form id="detail_form" name="detail_form" class="cart clearfix" method="post" action="/cart/add">
                        <div class="col-12 col-lg-4">
                            <div class="single_product_thumb">
                                <img src="<?php echo $menu_data->image; ?>">
                                <?php
                                $disc_show = check_disc_day($menu_data);
                                //if ($disc_show == 0) {     
                                ?>
                                <!--<span class="ribbon2"><span>Disc<br><?php echo $menu_data->discpersen; ?> %</span></span>-->
                                <?php
                                //}
                                ?>
                                <?php
                                $pos = 10;
                                if ($menu_data->halal == 0) {
                                ?>
                                    <span class="badge badge-danger badge-style" style="top:<?php echo $pos; ?>px;">Heated</span>
                                <?php
                                }
                                if ($menu_data->chefrecomend == 0) {
                                    $pos = $pos + 25;
                                ?>
                                    <span class="badge badge-warning badge-style" style="top:<?php echo $pos; ?>px;">Chef Recommendation</span>
                                <?php
                                }
                                if ($menu_data->special == 0) {
                                    $pos = $pos + 25;
                                ?>
                                    <span class="badge badge-info badge-style" style="top:<?php echo $pos; ?>px;">Special Menu</span>
                                <?php
                                }
                                if ($menu_data->favourite == 0) {
                                    $pos = $pos + 25;
                                ?>
                                    <span class="badge badge-success badge-style" style="top:<?php echo $pos; ?>px;">Favourite Menu</span>
                                <?php
                                }
                                ?>
                            </div>

                            <?php
                            if (count($submenu_list) > 0) {
                                echo "<hr>";
                                foreach ($submenu_list as $submenu) {
                            ?>
                                    <div class="submenu">
                                        <div class="row ml-2 mb-1">
                                            <?php echo $submenu->name; ?>
                                        </div>
                                        <div class="row ml-2 mr-2 mb-3">
                                            <select name="sl_<?php echo $submenu->id; ?>" id="sl_<?php echo $submenu->id; ?>" class="form-control" required>
                                                <option id="0">Select one</option>
                                            </select>
                                        </div>
                                    </div>
                            <?php
                                }
                                echo "<hr>";
                            }
                            ?>
                        </div>

                        <div class="col-12 col-lg-5">
                            <div class="single_product_desc">
                                <!-- Product Meta Data -->
                                <div class="product-meta-data">
                                    <?php
                                    if ($menu_data->price > 0) {
                                        if ($disc_show == 0) {
                                    ?>
                                            <p>
                                                <del>
                                                    <span class="product-price-stright">Rp. <?php echo number_format($menu_data->price, 0, ",", "."); ?> </span>
                                                </del>
                                                <span class="product-price ml-3"> Rp. <?php echo number_format($menu_data->price - ($menu_data->price * $menu_data->discpersen / 100), 0, ",", "."); ?></span>
                                                <span class="badge badge-success badge-style">disc <?php echo $menu_data->discpersen; ?> %</span>
                                            </p>
                                        <?php
                                        } else {
                                        ?>
                                            <p class="product-price">Rp. <?php echo number_format($menu_data->price, 0, ",", "."); ?></p>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <hr>
                                <div class="short_overview my-5">
                                    <p><?php echo nl2br($menu_data->descriptions); ?></p>
                                </div>

                                <input type="hidden" name="menuid" value="<?php echo $menu_data->id; ?>">
                                <div class="cart">
                                    <div class="cart-btn d-flex mb-50">
                                        <span class="btn-min"><img src="<?php echo base_url('assets/img/min.png'); ?>"></span>
                                        <p>Qty</p>
                                        <div class="quantity">
                                            <span class="qty-minus" onclick="min_qty()"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            <input type="number" class="qty-text" id="qty" step="1" min="<?php echo $menu_data->min_order; ?>" max="10" name="quantity" value="<?php echo $menu_data->min_order; ?>">
                                            <span class="qty-plus" onclick="plus_qty()"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                                        </div>
                                        <span class="btn-plus"><img src="<?php echo base_url('assets/img/plus.png'); ?>">
                                        </span>
                                    </div>
                                </div>
                                <div class="order-note">
                                    <div class="form-group">
                                        <p>Order note</p>
                                        <textarea name="note" id="order-note" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button name="addtocart" class="btn amado-btn">ORDER</button>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <a href="javascript:history.back()" class="btn amado-btn ml-1">CANCEL</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Product Details Area End -->


    </div>

    <?php $this->load->view($this->session->template_folder . "/_includes/bottom_sticky.php"); ?>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <?php $this->load->view($this->session->template_folder . "/_includes/js_page.php"); ?>
    <script type="text/javascript" src="/assets/js/numeral.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#detail_form").validate();

            <?php
            foreach ($submenu_list as $submenu) {
            ?>
                $.ajax({
                    url: "<?php echo base_url(); ?>menu/view_by_submenuid/<?php echo $submenu->id; ?>",
                    method: "POST",
                    dataType: 'JSON',
                    success: function(response) {

                        var len = response.length;

                        $("#sl_<?php echo $submenu->id; ?>").empty();
                        $("#sl_<?php echo $submenu->id; ?>").append("<option value=''><?php echo $submenu->name; ?></option>");
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id'];
                            var name = response[i]['name'];
                            var price = parseInt(response[i]['price']);
                            if (price > 0) {
                                name = name + ' ( Rp. ' + numeral(price).format('0,0') + ' )';
                            }
                            $("#sl_<?php echo $submenu->id; ?>").append("<option value='" + id + "'>" + name + "</option>");
                        }
                    }
                });
            <?php } ?>
        });

        function min_qty() {
            var effect = document.getElementById('qty');
            var qty = effect.value;
            if (!isNaN(qty) && qty > <?php echo $menu_data->min_order; ?>)
                effect.value--;
            return false;
        }

        function plus_qty() {
            var stock = <?php echo $menu_data->stock; ?>;
            var effect = document.getElementById('qty');
            var qty = effect.value;
            if (stock == 0) {
                if (!isNaN(qty)) effect.value++;
            } else {
                if ((qty + 1) <= stock) {
                    if (!isNaN(qty)) effect.value++;
                }
            }
            return false;
        }

        $(document).on('click', '.btn-plus', function() {
            var stock = <?php echo $menu_data->stock; ?>;
            if (stock == 0) {
                $('.qty-text').val(parseInt($('.qty-text').val()) + 1);
            } else {
                if ((parseInt($('.qty-text').val()) + 1) <= stock) {
                    $('.qty-text').val(parseInt($('.qty-text').val()) + 1);
                }
            }
        });

        $(document).on('click', '.btn-min', function() {
            qty = parseInt($('.qty-text').val()) - 1;
            //console.log(qty);
            if (qty < <?php echo $menu_data->min_order; ?>) {
                $('.qty-text').val(<?php echo $menu_data->min_order; ?>);
            } else {
                $('.qty-text').val(qty);
            }
        });
    </script>
</body>

</html>