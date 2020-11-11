        <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/custombox.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/custombox.legacy.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/vegas.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/home.js'); ?>"></script>

        <!--------- AUTO LOGOUT---------------------------------------------------------------->
        <script>
        var maxMinutes  = <?php echo $this->session->guest_session; ?>; 
        </script>
        <script src="<?php echo base_url('assets/js/autologout.js'); ?>"></script>