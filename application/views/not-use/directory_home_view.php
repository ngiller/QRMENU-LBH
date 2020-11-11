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
            <div class="welcome"><?php echo $welcome->descriptions ?></div>
            <div class="text-center"><strong><a class="discover-btn-black" href="/room/show/<?php echo $this->session->tableno; ?>">START</a></strong></div>
        </div>
    </div>

    <?php $this->load->view("_includes/js_home.php"); ?>
</body>

</html>