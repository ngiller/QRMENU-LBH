<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<?php $this->load->view("_includes/head_home.php"); ?>

<body>

    <div class="homepage-header">
        <div class="d-flex align-items-center flex-column justify-content-center h-100 text-white">

            <img src="<?php echo base_url('assets/img/logo.png'); ?>">
			<p>
            <div class="outlet-name"><?php echo $this->session->outletname ?></div>
            <div class="text-center ">
                <?php
                if ($outlet_msg == '') { 
                ?>
                <strong><a class="discover-btn-black" href="/menu/category/<?php echo $this->session->tableno; ?>">START ORDER</a></strong>
                <?php
                } else { echo "<h3>".$outlet_msg."</h3>"; }
                ?>
            </div>
        </div>
    </div>


    <?php $this->load->view("_includes/js_home.php"); ?>
</body>

</html>