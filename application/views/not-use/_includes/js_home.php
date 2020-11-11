        <script src="<?php echo base_url('assets/js/jquery-2.2.4.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/vegas.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/home.js'); ?>"></script>

        <!--------- AUTO LOGOUT---------------------------------------------------------------->
        <script>
        var maxMinutes  = <?php echo $this->session->guest_session; ?>; 
        </script>
        <script src="<?php echo base_url('assets/js/autologout.js'); ?>"></script>