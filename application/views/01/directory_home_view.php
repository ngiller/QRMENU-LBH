<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<?php $this->load->view($this->session->template_folder . "/_includes/head_home.php"); ?>

<body>

    <div class="homepage-header">
        <div class="d-flex align-items-center flex-column justify-content-center h-100 text-white">

            <img src="<?php echo base_url('assets/img/logo.png'); ?>">
            <div class="welcome"><?php echo $welcome->descriptions ?></div>
            <div class="text-center"><strong><a class="discover-btn-black" href="/room/show/<?php echo $this->session->tableno; ?>">START</a></strong></div>

        </div>
    </div>

    <script type="text/javascript">
        backimage = '/uploads/user/home-slider/home.jpg';
    </script>

    <?php $this->load->view($this->session->template_folder . "/_includes/js_home.php"); ?>

    <script type="text/javascript">
        var modal = new Custombox.modal({
            content: {
                effect: 'flip',
                target: '#greeting'
            }
        });
        $(document).ready(function() {
            <?php if ($popup==0) { echo "modal.open();"; } ?>
        });

        function close_dialog() {
            Custombox.modal.close();
        }
    </script>

    <!-- Modal -->
    <div class="modal" id="greeting" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body" style="color: #000;">
                    <?= $popup_content; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="close_dialog();">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>