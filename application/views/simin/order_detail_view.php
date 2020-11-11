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
                                    <h3 class="kt-portlet__head-title">
                                        STATUS : <?php
                                                    switch ($order_data->status) {
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
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-group">
                                        <a href="#" onclick="printorder('<?php echo $order_data->id; ?>')" class="btn btn-outline-success btn-sm btn-icon btn-icon-md">
                                            <i class="flaticon2-fax"></i>
                                        </a>
                                        <a href="#" onclick="javascript:window.location.href ='<?php echo base_url() . $back_to; ?>'" data-ktportlet-tool="remove" class="btn btn-sm btn-icon btn-warning btn-icon-md" aria-describedby="tooltip_bi98ldp6dp"><i class="la la-close"></i></a>
                                        <div class="tooltip tooltip-portlet tooltip bs-tooltip-top" role="tooltip" id="tooltip_nt3fqdzbrg" aria-hidden="true" x-placement="top" style="position: absolute; will-change: transform; visibility: hidden; top: 0px; left: 0px; transform: translate3d(324px, -38px, 0px);">
                                            <div class="tooltip-arrow arrow" style="left: 34px;"></div>
                                            <div class="tooltip-inner">Collapse</div>
                                        </div>
                                        <div class="tooltip tooltip-portlet tooltip bs-tooltip-top" role="tooltip" id="tooltip_noszh0vrt9" aria-hidden="true" x-placement="top" style="position: absolute; will-change: transform; visibility: hidden; top: 0px; left: 0px; transform: translate3d(366px, -38px, 0px);">
                                            <div class="tooltip-arrow arrow" style="left: 28px;"></div>
                                            <div class="tooltip-inner">Reload</div>
                                        </div>
                                        <div class="tooltip tooltip-portlet tooltip bs-tooltip-top" role="tooltip" id="tooltip_bi98ldp6dp" aria-hidden="true" x-placement="top" style="position: absolute; transform: translate3d(398px, -39px, 0px); top: 0px; left: 0px; will-change: transform; visibility: hidden;">
                                            <div class="tooltip-arrow arrow" style="left: 32px;"></div>
                                            <div class="tooltip-inner">Remove</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__head" style="display: block;">
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <div class="row mt-3">
                                            <div class="col-lg-2 mb-1">
                                                Order #:
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <?php echo $order_data->id; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 mb-1">
                                                Date:
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <?php echo $order_data->orderdate; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                        <div class="row mb-3">
                                            <div class="mt-2 mr-3">
                                                <h6>Change Status to : </h6>
                                            </div>
                                            <div><span><button type="button" class="btn btn-danger btn-sm mr-2" id="cancel" data-id="<?php echo $order_data->id; ?>">CANCEL</button></span>
                                                <span><button type="button" class="btn btn-primary btn-sm" id="confirm" data-id="<?php echo $order_data->id; ?>">CONFIRM</button></span></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="kt-portlet__head mb-2" style="display: block;">
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <label class="col-lg-2 mb-1">
                                                Table:
                                            </label>
                                            <div class="col-lg-6 mb-2">
                                                <?php echo $order_data->table_num; ?></div>
                                        </div>
                                        <!--<div class="row">
                                                <label class="col-lg-2 mb-1">
                                                    Pax:
                                                </label>
                                                <div class="col-lg-6 mb-2">
                                                    <?php echo $order_data->pax; ?>
                                                </div>
                                            </div>-->
                                        <div class="row">
                                            <div class="col-lg-2 mb-1">
                                                Payment:
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <?php
                                                switch ($order_data->payment) {
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
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <label class="col-lg-2 mb-1">
                                                Name:
                                            </label>
                                            <div class="col-lg-6 mb-2">
                                                <?php echo $order_data->guestname; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-lg-2 mb-1">
                                                Email:
                                            </label>
                                            <div class="col-lg-6 mb-2">
                                                <?php echo $order_data->email; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-lg-2 mb-1">
                                                Phone:
                                            </label>
                                            <div class="col-lg-6 mb-2">
                                                <?php echo $order_data->phone; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="kt-portlet__body mt-2">
                                        <!--begin::Section-->
                                        <div class="kt-section">
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
                                                        foreach ($detail_data as $items) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $line++; ?></td>
                                                                <td>
                                                                    <?php echo $items->name; ?>
                                                                    <?php
                                                                    if ($this->order_detail_item_model->has_item($order_data->id, $items->menuid) > 0) {
                                                                        $submenu = $this->order_detail_item_model->get_by_order($order_data->id, $items->line);
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
                                                            }
                                                            ?>
                                                        <?php
                                                        }
                                                        ?>
                                                        <!--</tbody>
                                                <tfoot>-->
                                                        <tr>
                                                            <td style="border: none;">&nbsp;</td>
                                                            <td style="border: none;">&nbsp;</td>
                                                            <td style="text-align: right;">&nbsp;</td>
                                                            <td style="text-align: right;">&nbsp;</td>
                                                            <td style="text-align: right;">Sub Total</td>
                                                            <td style="text-align: right;">Rp. <?php echo number_format($order_data->subtotal, 0, ",", "."); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: none;">&nbsp;</td>
                                                            <td style="border: none;">&nbsp;</td>
                                                            <td style="text-align: right;border: none;">&nbsp;</td>
                                                            <td style="text-align: right;border: none;">&nbsp;</td>
                                                            <td style="text-align: right;">Tax <?php echo $order_data->tax; ?> %</td>
                                                            <td style="text-align: right;">Rp. <?php echo number_format($order_data->subtotal * $order_data->tax / 100, 0, ",", "."); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: none;">&nbsp;</td>
                                                            <td style="border: none;">&nbsp;</td>
                                                            <td style="text-align: right;border: none;">&nbsp;</td>
                                                            <td style="text-align: right;border: none;">&nbsp;</td>
                                                            <td style="text-align: right;">Service <?php echo $order_data->service; ?> %</td>
                                                            <td style="text-align: right;">Rp. <?php echo number_format($order_data->subtotal * $order_data->service / 100, 0, ",", "."); ?></td>
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
                                                                <h6><?php echo number_format($order_data->total, 0, ",", "."); ?></h6>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <h6>Order Note:</h6>
                                                <?php echo wordwrap($order_data->note, 30, "<br>\n"); ?>
                                            </div>
                                        </div>
                                        <!--end::Section-->

                                        <div class="kt-section">
                                            <hr>
                                            <div class="kt-section__content d-flex justify-content-end">
                                                <button class="btn btn-sm btn-info" onclick="javascript:window.location.href ='<?php echo base_url() . $back_to; ?>'">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: Content -->
                        </div>

                        <?php $this->load->view("simin/_includes/bottomfooter.php"); ?>

                    </div>
                </div>
            </div>

            <!-- end:: Page -->

            <?php $this->load->view("simin/_includes/footer.php"); ?>
            <script src="/assets/js/recta.js"></script>

            <script type="text/javascript">
                $(document).ready(function() {

                    var id = $('#status').attr("data-id");
                    if (id == '2') {
                        $('#cancel').css("display", "none");
                    } else {
                        if (id == '1') {
                            $('#confirm').css("display", "none");
                        }
                    }

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

                    $('#confirm').click(function() {
                        var id = $('#confirm').attr("data-id");
                        $.ajax({
                            url: "<?php echo base_url(); ?>simin/order/change_status/",
                            method: "POST",
                            data: {
                                id: id,
                                status: 1
                            },
                            dataType: 'JSON',
                            success: function(emp) {
                                $("#confirm").css("display", "none");
                                $("#cancel").show();
                            }
                        });
                    });

                    $('#cancel').click(function() {
                        var id = $('#cancel').attr("data-id");
                        $.ajax({
                            url: "<?php echo base_url(); ?>simin/order/change_status/",
                            method: "POST",
                            data: {
                                id: id,
                                status: 2
                            },
                            dataType: 'JSON',
                            success: function(emp) {
                                $("#cancel").css("display", "none");
                                $("#confirm").show();
                            }
                        });
                    });
                });

                function printorder(id) {
                    var printer = new Recta('1234567890', '1811');
                    $.ajax({
                        url: '/simin/print_order/id/' + id,
                        type: 'post',
                        dataType: 'JSON',
                        success: function(response) {
                            //console.log(response);
                            if (response != '') {
                                printer.open().then(function() {
                                    printer
                                        .align('left')
                                        .raw(response)
                                        .print()
                                });
                            }
                        }
                    })
                };
            </script>



            <?php $this->load->view("simin/_includes/delete_dialog.php"); ?>
</body>

<!-- end::Body -->

</html>