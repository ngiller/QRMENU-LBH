    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="<?php echo base_url('assets/js/jquery-2.2.4.min.js'); ?>"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <!-- Plugins js -->
    <script src="<?php echo base_url('assets/js/plugins.js'); ?>"></script>
    <!-- Active js -->
    <script src="<?php echo base_url('assets/js/active.js'); ?>"></script>

    <!--------- AUTO LOGOUT---------------------------------------------------------------->
    <script>
       var maxMinutes  = <?php echo $this->session->guest_session; ?>; 
    </script>
    <script src="<?php echo base_url('assets/js/autologout.js'); ?>"></script>
       
   