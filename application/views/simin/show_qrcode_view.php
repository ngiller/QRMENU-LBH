<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>

<html lang="en">

<head>
<link href="<?php echo base_url('assets/vendors/general/print-area/PrintArea.css') ?>" rel="stylesheet" type="text/css" />
</head>

<!-- begin::Body -->

<body>
    <div class="qr" id="qr">
        <img src="<?php echo $image; ?>">
        <hr>
        <div class="table_no">
            <?php echo $table_no; ?>
        </div>
    </div>
    <div>
    <button id="print" class="btn pull-right">Print</button>
        </h3>
    </div>

    <script src="<?php echo base_url('assets/vendors/general/jquery/dist/jquery.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/vendors/general/print-area/jquery.PrintArea.js'); ?>" type="text/javascript"></script>

    <script>
        (function($) {
            // fungsi dijalankan setelah seluruh dokumen ditampilkan
            $(document).ready(function(e) {
                 
                // aksi ketika tombol cetak ditekan
                $("#print").bind("click", function(event) {
                    // cetak data pada area <div id="#data-mahasiswa"></div>
                    $('#qr').printArea();
                });
            });
        }) (jQuery);
    </script>
</body>

<!-- end::Body -->

</html>