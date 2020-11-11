<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <?php $this->load->view("simin/_includes/head.php"); ?>
</head>

<!-- begin::Body -->

<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->
    <?php $this->load->view("simin/_includes/headmobile.php"); ?>

    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

            <?php $this->load->view("simin/_includes/sidemenu.php"); ?>

            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                <?php $this->load->view("simin/_includes/topheader.php"); ?>

                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

                    <?php $this->load->view("simin/_includes/pagetitle.php"); ?>

                    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">

                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-group">
                                        <a href="#" onclick="javascript:window.location.href = '/simin/guests';" data-ktportlet-tool="remove" class="btn btn-sm btn-icon btn-warning btn-icon-md" aria-describedby="tooltip_bi98ldp6dp"><i class="la la-close"></i></a>
                                        <div class="tooltip tooltip-portlet tooltip bs-tooltip-top" role="tooltip" aria-hidden="true" x-placement="top" style="position: absolute; transform: translate3d(398px, -39px, 0px); top: 0px; left: 0px; will-change: transform; visibility: hidden;">
                                            <div class="tooltip-arrow arrow" style="left: 32px;"></div>
                                            <div class="tooltip-inner">Remove</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__head" style="display: block;">
                                <div class="container mt-2">
                                    <div class="row">
                                        <label class="col-sm-1 mb-1">
                                            Name:
                                        </label>
                                        <div class="col-sm-4 mb-2">
                                            <?php echo $guest_data->name; ?>
                                        </div>
                                        <label class="col-sm-1 mb-1">
                                            Phone:
                                        </label>
                                        <div class="col-sm-4 mb-2">
                                            <?php echo $guest_data->phone; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-1 mb-1">
                                            Email:
                                        </label>
                                        <div class="col-sm-4 mb-2">
                                            <?php echo $guest_data->email; ?>
                                        </div>
                                        <label class="col-sm-1 mb-1">
                                            Country:
                                        </label>
                                        <div class="col-sm-4 mb-2">
                                            <?php echo $guest_data->countryname; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-1 mb-1 mt-2">
                                            Order:
                                        </label>
                                        <div class="col-sm-4 mb-2 mt-2">
                                            <?php echo count($order_data); ?>
                                        </div>
                                        <label class="col-sm-1 mb-1 mt-2">
                                            Total:
                                        </label>
                                        <div class="col-sm-4 mb-2 mt-2">
                                            <?php
                                            $sumtotal = 0;
                                            foreach ($order_data as $order) {
                                                $sumtotal = $sumtotal + $order->total;
                                            }
                                            echo "Rp. " . number_format($sumtotal, 0, ",", ".");
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kt-portlet__body">
                                <!--begin::Accordion-->
                                <div class="accordion" id="accordionorder">
                                    <?php
                                    $card_id = 1;
                                    $orderid = 0;
                                    foreach ($order_data as $order) {

                                    ?>
                                        <div class="card">

                                            <div class="card-header" id="heading<?= $card_id; ?>">
                                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse<?= $card_id; ?>" aria-expanded="false" aria-controls="collapse<?= $card_id; ?>">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-sm-1">Date :</div>
                                                            <div class="col-sm-4"><?php echo $order->orderdate; ?></div>
                                                            <div class="col-sm-1">Table :</div>
                                                            <div class="col-sm-4"><?php echo $order->table_num; ?></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-1">Order ID :</div>
                                                            <div class="col-sm-4"><?php echo $order->id; ?></div>
                                                            <div class="col-sm-1">Payment :</div>
                                                            <div class="col-sm-4">
                                                                <?php
                                                                switch ($order->payment) {
                                                                    case 1:
                                                                        echo "CASH";
                                                                        break;
                                                                    case 2:
                                                                        echo "Charge to room";
                                                                        break;
                                                                    case 3:
                                                                        echo "CREDIT CARD";
                                                                        break;
                                                                    case 4:
                                                                        echo "QRIS";
                                                                        break;
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-1">Status</div>
                                                            <div class="col-sm-4">
                                                                <?php
                                                                switch ($order->status) {
                                                                    case 0:
                                                                        echo " WAITING";
                                                                        break;
                                                                    case 1:
                                                                        echo " CONFIRM";
                                                                        break;
                                                                    case 2:
                                                                        echo " CANCEL";
                                                                        break;
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="col-sm-1"></div>
                                                            <div class="col-sm-4"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse<?= $card_id; ?>" class="collapse" aria-labelledby="heading<?= $card_id; ?>" data-parent="#accordionorder" style="">
                                                <div class="card-body">
                                                    <div class="kt-section__content table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 20px;">#</th>
                                                                    <th>Menu Name</th>
                                                                    <th style="text-align: right;">Qty</th>
                                                                    <th style="text-align: right;">Price</th>
                                                                    <th style="text-align: right;">Disc</th>
                                                                    <th style="text-align: right;">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $line = 1;
                                                                $order_detail = $this->order_detail_model->get_by_id($order->id);
                                                                foreach ($order_detail as $items) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $line++;
                                                                            ?></td>
                                                                        <td>
                                                                            <?php echo $items->name; ?>
                                                                            <?php
                                                                            if ($this->order_detail_item_model->has_item($order->id, $items->menuid) > 0) {
                                                                                $submenu = $this->order_detail_item_model->get_by_order($order->id, $items->line);
                                                                                foreach ($submenu as $subitem) {
                                                                                    echo "<br>&nbsp;&nbsp; > " . $subitem->itemname;
                                                                                    if ($subitem->price > 0) {
                                                                                        echo " Rp. " . number_format($subitem->price, 0, ",", ".");
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td style="text-align: right;"><?php echo $items->qty; ?></td>
                                                                        <td style="text-align: right;">Rp. <?php echo number_format($items->price, 0, ",", "."); ?></td>
                                                                        <td style="text-align: right;"><?php echo $items->disc; ?></td>
                                                                        <td style="text-align: right;">Rp. <?php echo number_format(($items->price - ($items->price * $items->disc / 100)) * $items->qty, 0, ",", "."); ?></td>
                                                                    </tr>
                                                                    <?php
                                                                    if ($items->note != "") {
                                                                    ?>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td colspan="3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Note : <?php echo $items->note; ?></td>

                                                                            <td style="text-align: right;"></td>
                                                                            <td style="text-align: right;"></td>
                                                                        </tr>
                                                                <?php
                                                                    } //------------------ if ($items->note--------------->
                                                                } //---------------------- foreach ($order_detail as $items) { -------------------->
                                                                ?>
                                                                <tr>
                                                                    <td style="border: none;">&nbsp;</td>
                                                                    <td style="border: none;">&nbsp;</td>
                                                                    <td style="text-align: right;">&nbsp;</td>
                                                                    <td style="text-align: right;">&nbsp;</td>
                                                                    <td style="text-align: right;">Sub Total</td>
                                                                    <td style="text-align: right;">Rp. <?php echo number_format($order->subtotal, 0, ",", "."); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="border: none;">&nbsp;</td>
                                                                    <td style="border: none;">&nbsp;</td>
                                                                    <td style="text-align: right;border: none;">&nbsp;</td>
                                                                    <td style="text-align: right;border: none;">&nbsp;</td>
                                                                    <td style="text-align: right;">Tax <?php echo $order->tax; ?> %</td>
                                                                    <td style="text-align: right;">Rp. <?php echo number_format($order->subtotal * $order->tax / 100, 0, ",", "."); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="border: none;">&nbsp;</td>
                                                                    <td style="border: none;">&nbsp;</td>
                                                                    <td style="text-align: right;border: none;">&nbsp;</td>
                                                                    <td style="text-align: right;border: none;">&nbsp;</td>
                                                                    <td style="text-align: right;">Service <?php echo $order->service; ?> %</td>
                                                                    <td style="text-align: right;">Rp. <?php echo number_format($order->subtotal * $order->service / 100, 0, ",", "."); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="border: none;">&nbsp;</td>
                                                                    <td style="border: none;">&nbsp;</td>
                                                                    <td style="text-align: right;border: none;">&nbsp;</td>
                                                                    <td style="text-align: right;border: none;">&nbsp;</td>
                                                                    <td style="text-align: right;">
                                                                        <h6>Total</h6>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                        <h6><?php echo number_format($order->total, 0, ",", "."); ?></h6>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <h6>Order Note:</h6>
                                                        <?php echo wordwrap($order->note, 30, "<br>\n"); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    <?php
                                        ++$card_id;
                                    } // --------------------- foreach -------------->
                                    ?>

                                </div>
                                <!--end::Accordion-->
                            </div>

                            <!-- end:: Content -->
                        </div>
                    </div>

                    <?php $this->load->view("simin/_includes/bottomfooter.php"); ?>

                </div>
            </div>
        </div>

        <!-- end:: Page -->

        <?php $this->load->view("simin/_includes/footer.php"); ?>


        <script type="text/javascript">
            $(document).ready(function() {


                $('#select_property').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>simin/menu/change_property/",
                        method: "POST",
                        data: {
                            id: id
                        },
                        dataType: 'JSON',
                        success: function(emp) {


                        }
                    });
                });


            });
        </script>



        <?php $this->load->view("simin/_includes/delete_dialog.php"); ?>
</body>

<!-- end::Body -->

</html>