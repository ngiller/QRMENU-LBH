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
        <?php $this->load->view($this->session->template_folder."/_includes/header_room.php"); ?>
    
        <div class="content-wrapper clearfix">
            <?php
              if (count($whatson_data) > 0) { 
            ?>
            <div class="text-center"><?php if ($guest_name != "") { echo "<h5>Dear " . $guest_name.",</h5>"; } ?><h4>Welcome to<br>Fivelements Retreat Bali</h4></div>
            
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
                            $link = "/page/".$items->link;
                        }
                ?>
                <div class="item">                    
                        <a href="<?php echo $link; ?>">
                            <img src="<?php echo $items->homeimage; ?>">
                            <div class="custom_overlay">
                                <span class="custom_overlay_inner">
                                    <h4><?php echo wordwrap($items->title,30,"<br>\n"); ?></h4>
                                </span>
                            </div>
                        </a>                    
                </div>
                <?php } ?>                
            </div>
            <?php } ?>
            <h4 class="text-center">Experience</h4>
            <div class="h4line"></div>
        </div>
    
        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix">

                <?php
                    foreach ($outlet_data as $outlet) {
                ?>
                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    <?php
                        if ($outlet->code == 999) {
                            $link = "/page/room_directory";
                        } else {
                            $link = "/room/to_outlet/".$outlet->id;
                        }
                    ?>
                    <a href="<?php echo $link; ?>">
                        <img src="<?php echo $outlet->image; ?>" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <h4 style="text-shadow: 3px 2px 3px rgba(69, 66, 66, 1);"><?php echo $outlet->name; ?></h4>
                        </div>
                    </a>
                </div>

                <?php
                    } 
                ?>
                
            </div>
        </div>
        <!-- Product Catagories Area End -->
    </div>
    
    <!-- ##### Main Content Wrapper End ##### -->

    

    <?php $this->load->view($this->session->template_folder."/_includes/js_page.php"); ?>

</body>

</html>