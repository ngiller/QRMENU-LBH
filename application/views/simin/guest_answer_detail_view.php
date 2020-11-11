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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="kt-portlet">
                                    <form method="post" id="form-show_activity" name="form-show_activity">

                                        <div class="kt-portlet__body">
                                            <div class="kt-section">
                                                <div class="kt-section__content">

                                                    <div class="row">

                                                        <div class="col-12">

                                                            <div class="card m-b-20" style="font-size: 13px;">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-2">
                                                                            Date
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            : <?= $master->date; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-1">
                                                                        <div class="col-sm-2">
                                                                            Name
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            : <?= $master->name; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-1">
                                                                        <div class="col-sm-2">
                                                                            Email Address
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            : <?= $master->email; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-1">
                                                                        <div class="col-sm-2">
                                                                            Phone
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            : <?= $master->phone; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-1">
                                                                        <div class="col-sm-2">
                                                                            SCORE
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            : <?= $master->score; ?>
                                                                        </div>
                                                                    </div>

                                                                    <hr>

                                                                    <div class="mb-5">
                                                                        <ol>
                                                                            <?php
                                                                            $master = -1;
                                                                            $first = 0;
                                                                            foreach ($detail as $item) {
                                                                            
                                                                                    if ($item->sub_of == 0) {
                                                                                        if ($first == 1) { 
                                                                                            echo "</ul>";
                                                                                        }
                                                                                        $first = 1; 
                                                                                        echo "<li class='mt-3' style='line-height: 23px;'>".$item->question . " " ;
                                                                                    } else {
                                                                                        echo "<li class='mt-2' style='line-height: 23px;'>".$item->question . " ";
                                                                                    }

                                                                                    if ($item->answer_type == 1) {
                                                                                        if ($item->answer == 1) {
                                                                                    ?>

                                                                                            <span class="badge badge-success"> NO </span>

                                                                                        <?php
                                                                                        } else {
                                                                                        ?>

                                                                                            <span class="badge badge-danger"> YES </span>

                                                                                        <?php
                                                                                        }
                                                                                    } else {
                                                                                        if ($item->answer != "") {
                                                                                        ?>
                                                                                            <span class="badge badge-danger"> <?= $item->answer; ?> </span>
                                                                                    <?php
                                                                                        }
                                                                                    }

                                                                                    echo "</li>";

                                                                                    if ($item->sub_of == 0) {
                                                                                        echo "<ul>";
                                                                                    }
                                                                                    
                                                                                    ?>

                                                                                
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </ol>
                                                                    </div>
                                                                    <hr>
                                                                    <a href="javascript:window.history.back();" class="btn btn-sm btn-success mt-2"> Close </a>

                                                                </div>

                                                            </div>
                                                        </div> <!-- end col -->

                                                    </div> <!-- end row -->

                                                </div>
                                            </div>
                                    </form>
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


    <script type="text/javascript">
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
                    reload_table();

                }
            });
        });
    </script>
</body>

<!-- end::Body -->

</html>