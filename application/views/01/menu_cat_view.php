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

        <div class="content-wrapper clearfix">
            <?php
            if (count($whatson_data) > 0) {
            ?>
                <h4 class="text-center"><?php if ($guest_name != "") {
                                            echo "Dear " . $guest_name . ",";
                                        } ?><br>Welcome to<br>Legian Beach Hotel</h4>

                <div class="h4line"></div>
                <?php
                if (count($whatson_data) > 1) {
                    $class = "favourite-slider hero-slider owl-carousel owl-theme";
                } else {
                    $class = "favourite-slider1 hero-slider owl-carouse1 owl-theme mb-5";
                }
                ?>
                <div class="<?php echo $class; ?>">
                    <?php
                    foreach ($whatson_data as $items) {
                        if ($items->link_to_url != "") {
                            $link = $items->link_to_url;
                        } else {
                            $link = "/page/" . $items->link;
                        }
                    ?>
                        <div class="item">
                            <a href="<?php echo $link; ?>">
                                <img src="<?php echo $items->homeimage; ?>">
                                <div class="custom_overlay">
                                    <span class="custom_overlay_inner">
                                        <h4><?php echo wordwrap($items->title, 30, "<br>\n"); ?></h4>
                                    </span>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <h4 class="text-center">Menu Category</h4>
            <div class="h4line"></div>
        </div>

        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix">

                <?php
                foreach ($menucat_data as $menucat) {
                    if ($menucat->active == 0) {
                        if (($this->session->outletoriginid == -1 and $menucat->order_other_outlet == 0) or ($this->session->outletoriginid != -1)) {
                ?>
                            <!-- Single Catagory -->
                            <div class="single-products-catagory clearfix">
                                <a href="/menu/item/<?php echo $menucat->id; ?>">
                                    <img src="<?php echo $menucat->image; ?>" alt="">
                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <div class="line"></div>
                                        <h4 style="text-shadow: 3px 2px 3px rgba(69, 66, 66, 1);"><?php echo $menucat->name; ?></h4>
                                    </div>
                                </a>
                            </div>

                <?php
                        }
                    }
                }
                ?>

            </div>
        </div>
        <!-- Product Catagories Area End -->
    </div>

    <?php $this->load->view($this->session->template_folder . "/_includes/bottom_sticky.php"); ?>

    <?php $this->load->view($this->session->template_folder . "/_includes/js_page.php"); ?>

</body>

</html>