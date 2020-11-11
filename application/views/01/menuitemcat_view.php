<!DOCTYPE html>
<html lang="en">

<?php $this->load->view($this->session->template_folder . "/_includes/head_page.php"); ?>

<body>
    <!-- Search Wrapper Area Start -->
    <?php $this->load->view($this->session->template_folder . "/_includes/search.php"); ?>
    <!-- Search Wrapper Area End -->


    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <?php $this->load->view($this->session->template_folder . "/_includes/mobile_nav.php"); ?>

        <!-- Header Area Start -->
        <?php $this->load->view($this->session->template_folder . "/_includes/header.php"); ?>

        <div class="shop_sidebar_area">
            <div class="bar_close">
                <div class="cat_close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </div>
            </div>
        </div>

        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">
                <!--<div style="margin-bottom: 20px;">
                    <a href="#" class="cat-btn">CATEGORIES</a>
                </div>-->
                <h4 class="text-center"><?php echo $menucat_data->name; ?></h4>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <!--pagination-->
                        <?php echo $pagination; ?>
                    </div>
                </div>
                <br>

                <div class="row">

                    <?php
                    $catname = $menucat_data->name;
                    foreach ($menu_data as $menu) {
                        if ($menu->active == 0) {
                            if ($menu->catname <> $catname) {
                                $catname = $menu->catname;
                                echo "</div><h5 class='text-center'>" . $menu->catname . "</h5><div class='h4line' style='margin-bottom:30px'></div><div class='row'>";
                            }

                            if (($this->session->outletoriginid == -1 and $menu->order_other_outlet == 0) or ($this->session->outletoriginid != -1)) {

                                if (($menu->limited_stock == 0 and $menu->stock > 0) or ($menu->limited_stock == 1)) {
                    ?>
                                    <!-- Single Product Area -->
                                    <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                                        <div class="single-product-wrapper">
                                            <!-- Product Image -->
                                            <div class="product-img">

                                                <?php
                                                if ($orderable == 0) {
                                                ?>
                                                    <a href="/menu/detail/<?php echo $menu->id; ?>"><img src="<?php echo $menu->image; ?>" alt=""></a>

                                                    <?php
                                                    $disc_show = check_disc_day($menu);
                                                    //if ($disc_show == 0) {     
                                                    ?>
                                                    <!--<span class="ribbon2"><span>Disc<br><?php //echo $menu->discpersen; 
                                                                                            ?> %</span></span>-->
                                                    <?php
                                                    //}
                                                    ?>
                                                    <?php
                                                    $pos = 10;
                                                    if ($menu->halal == 0) {
                                                    ?>
                                                        <span class="badge badge-danger badge-style" style="top:<?php echo $pos; ?>px;">Heated</span>
                                                    <?php
                                                    }
                                                    if ($menu->chefrecomend == 0) {
                                                        $pos = $pos + 25;
                                                    ?>
                                                        <span class="badge badge-warning badge-style" style="top:<?php echo $pos; ?>px;">Chef Recommendation</span>
                                                    <?php
                                                    }
                                                    if ($menu->special == 0) {
                                                        $pos = $pos + 25;
                                                    ?>
                                                        <span class="badge badge-info badge-style" style="top:<?php echo $pos; ?>px;">Special Menu</span>
                                                    <?php
                                                    }
                                                    if ($menu->favourite == 0) {
                                                        $pos = $pos + 25;
                                                    ?>
                                                        <span class="badge badge-success badge-style" style="top:<?php echo $pos; ?>px;">Favourite Menu</span>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <img src="<?php echo $menu->image; ?>" alt="">
                                                <?php
                                                }
                                                ?>
                                            </div>

                                            <!-- Product Description -->
                                            <div class="product-description">
                                                <!-- Product Meta Data -->
                                                <div class="product-meta-data">

                                                    <a href="detail.html">
                                                        <a href="/menu/detail/<?php echo $menu->id; ?>">
                                                            <h6><?php echo wordwrap($menu->name, 30, '<br>'); ?></h6>
                                                        </a>
                                                    </a>
                                                    <div class="line"></div>
                                                </div>

                                                <?php
                                                if ($orderable == 0) {
                                                    if ($menu->price > 0) {
                                                        if ($disc_show == 0) {
                                                ?>
                                                            <p>
                                                                <del>
                                                                    <span>Rp. <?php echo number_format($menu->price, 0, ",", "."); ?> </span>
                                                                </del>
                                                                <span class="product-price ml-3"> Rp. <?php echo number_format($menu->price - ($menu->price * $menu->discpersen / 100), 0, ",", "."); ?></span>
                                                                <span class="badge badge-success badge-style">disc <?php echo $menu->discpersen; ?> %</span>
                                                            </p>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <p class="product-price">Rp. <?php echo number_format($menu->price, 0, ",", "."); ?></p>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- Ratings & Cart -->
                                                    <div class="d-flex justify-content-end">
                                                        <span style="margin-right: 8px;"><a href="/menu/detail/<?php echo $menu->id; ?>"><button type="reset" class="cart-link">DETAIL</button></a></span>
                                                        <?php
                                                        //---- If any sub menu redirect to detail menu------------------
                                                        $num_submenu = $this->sub_menu_model->count_filtered($menu->id);
                                                        if ($num_submenu > 0) {
                                                        ?>
                                                            <span style="margin-right: 8px;"><a href="/menu/detail/<?php echo $menu->id; ?>"><button type="reset" class="cart-link">ORDER</button></a></span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <form method="post" action="/cart/add">
                                                                <input name="menuid" type="hidden" value="<?php echo $menu->id ?>" />
                                                                <input name="quantity" type="hidden" value="1" />
                                                                <button type="submit" class="cart-link">ORDER</button>
                                                            </form>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                    <?php
                                } //------if ($menu->limeted_stock == 0 AND $menu->stock > 0) {
                            } //-----if (($this->session->outletoriginid ==-1 and $menu->order_other_outlet == 0) or ...
                        } //-----if ($menu->active == 0) {  
                    } //----foreach ($menu_data as $menu) { 
                    ?>


                </div>

                <div class="row" style="margin-top: -30px;">
                    <div class="col-12">
                        <!--pagination-->
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <?php $this->load->view($this->session->template_folder . "/_includes/bottom_sticky.php"); ?>

    <!-- ##### Main Content Wrapper End ##### -->
    <?php $this->load->view($this->session->template_folder . "/_includes/js_page.php"); ?>

</body>

</html>