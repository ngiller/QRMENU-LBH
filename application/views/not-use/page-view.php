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
        <?php $this->load->view("_includes/header_room.php"); ?>
    
        <div class="content-wrapper clearfix">
            <?php
              if (count($whatson_data) > 0) { 
            ?>
            <h4 class="text-center">Special Offers</h4>
            
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
                ?>
                <div class="item">                    
                        <a href="/menu/detail/<?php echo $items->id; ?>">
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
           
            <div class="h4line"></div>
        </div>

        <div class="container">
            <?php echo $dt->descriptions; ?>
        </div>
    
        
    </div>
    
    <!-- ##### Main Content Wrapper End ##### -->

    

    <?php $this->load->view("_includes/js_page.php"); ?>

</body>

</html>