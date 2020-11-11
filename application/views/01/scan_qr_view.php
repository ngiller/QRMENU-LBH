<!DOCTYPE html>
<html lang="en">

<?php $this->load->view($this->session->template_folder."/_includes/head_page.php"); ?>

<body>
    <!-- Search Wrapper Area Start -->
    <?php $this->load->view($this->session->template_folder."/_includes/search.php"); ?>
    
    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix" style="height: 100vh;">

        <!-- Mobile Nav (max width 767px)-->
        <?php $this->load->view($this->session->template_folder."/_includes/mobile_nav.php"); ?>

        <!-- Header Area Start -->
        <?php $this->load->view($this->session->template_folder."/_includes/header.php"); ?>
    
        <div class="single-product-area section-padding-100 clearfix text-center">
            <h4 style="margin-top:100px; font-weight: 600;">PLEASE SCAN<br>THE QR CODE</h4>
            <div >
            <img src="/assets/img/scan-qr.png" width="250 px">
            </div>
           
        </div>
        <!-- Product Catagories Area End -->
    </div>
    
    <?php $this->load->view($this->session->template_folder."/_includes/js_home.php"); ?>

</body>

</html>