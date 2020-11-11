<html>
<?php $this->load->view($template_folder . '/declaration/include/head_page.php'); ?>

<body class="">
    <form id="question" class="form-signin text-center " action="/declaration/finish" method="POST">
        <img class="logo" src="/assets/img/dobletree-sby.png" alt="" width="125" height="auto">
        <h5>TRAVEL DECLARATION FORM</h5>
        <hr>
        <div class="text-left mt-4 pl-2 pr-2">

            <ol class="list-group">

                <li class="ml-4">Have you ever gone to public places (supermarket, hospital, crowded place, etc).
                    <div>
                        <span class="radiobtn mt-2 form-check form-check-inline">
                            <input type="radio" id="yq1" name="q1" value="yes" <?php echo ($this->session->q1 == 0) ? "checked" : ""; ?> />
                            <label for="yq1">Yes</label>
                        </span>
                        <span class="radiobtn mt-2 form-check form-check-inline">
                            <input type="radio" id="nq1" name="q1" value="no" <?php echo ($this->session->q1 == 1) ? "checked" : ""; ?> />
                            <label for="nq1">No</label>
                        </span>
                    </div>
                    <div id="warn-q1" class="warning-textarea"></div>
                    <div class="row px-3 text-left font-18 mt-3">
                        If yes, where ?
                    </div>
                    <div class="row px-3 text-left font-18 mb-2 mt-2">
                        <textarea name="q2" style="width:100%"><?php echo $this->session->q2; ?></textarea>
                    </div>
                    <div id="warn-q2" class="warning-textarea">
                        Please describe
                    </div>
                </li>

                <li class="ml-4 mt-4">
                    Have you ever use the public transportation
                    <div>
                        <span class="radiobtn mt-2 form-check form-check-inline">
                            <input type="radio" id="yq3" name="q3" value="yes" <?php echo ($this->session->q3 == 0) ? "checked" : ""; ?> />
                            <label for="yq3">Yes</label>
                        </span>
                        <span class="radiobtn mt-2 form-check form-check-inline">
                            <input type="radio" id="nq3" name="q3" value="no" <?php echo ($this->session->q3 == 1) ? "checked" : ""; ?> />
                            <label for="nq3">No</label>
                        </span>
                        <div id="warn-q3" class="warning-textarea"></div>
                        <div class="row px-3 text-left font-18 mt-3">
                            If yes, where ?
                        </div>
                        <div class="row px-3 text-left font-18 mb-2 mt-2">
                            <textarea name="q4" style="width:100%"><?php echo $this->session->q4; ?></textarea>
                        </div>
                        <div id="warn-q4" class="warning-textarea">
                            Please describe
                        </div>
                    </div>
                </li>

                <li class="ml-4 mt-4">
                    Have you ever traveled intercity on domestic or international (areas where affeted/redzone)
                    <div>
                        <span class="radiobtn mt-2 form-check form-check-inline">
                            <input type="radio" id="yq5" name="q5" value="yes" <?php echo ($this->session->q5 == 0) ? "checked" : ""; ?> />
                            <label for="yq5">Yes</label>
                        </span>
                        <span class="radiobtn mt-2 form-check form-check-inline">
                            <input type="radio" id="nq5" name="q5" value="no" <?php echo ($this->session->q5 == 1) ? "checked" : ""; ?> />
                            <label for="nq5">No</label>
                        </span>
                        <div id="warn-q5" class="warning-textarea"></div>
                    </div>
                </li>

                <li class="ml-4 mt-4">
                    Have you ever in contact with someone who are suspected, surveillace patient or confirm affected by COVID-19?
                    <div>
                        <span class="radiobtn mt-2 form-check form-check-inline">
                            <input type="radio" id="yq6" name="q6" value="yes" <?php echo ($this->session->q6 == 0) ? "checked" : ""; ?> />
                            <label for="yq6">Yes</label>
                        </span>
                        <span class="radiobtn mt-2 form-check form-check-inline">
                            <input type="radio" id="nq6" name="q6" value="no" <?php echo ($this->session->q6 == 1) ? "checked" : ""; ?> />
                            <label for="nq6">No</label>
                        </span>
                        <div id="warn-q6" class="warning-textarea"></div>
                    </div>
                </li>

                <li class="ml-4 mt-4">
                    Have you participate in activities that involve large numbers of people
                    <div>
                        <span class="radiobtn mt-2 form-check form-check-inline">
                            <input type="radio" id="yq7" name="q7" value="yes" <?php echo ($this->session->q7 == 0) ? "checked" : ""; ?> />
                            <label for="yq7">Yes</label>
                        </span>
                        <span class="radiobtn mt-2 form-check form-check-inline">
                            <input type="radio" id="nq7" name="q7" value="no" <?php echo ($this->session->q7 == 1) ? "checked" : ""; ?> />
                            <label for="nq7">No</label>
                        </span>
                        <div id="warn-q7" class="warning-textarea"></div>
                    </div>
                </li>

                <li class="ml-4 mt-4">
                    Have you experienced fever, chough, runny nose, sore throat, and/or shortness of breath
                    <div>
                        <span class="radiobtn mt-2 form-check form-check-inline">
                            <input type="radio" id="yq8" name="q8" value="yes" <?php echo ($this->session->q8 == 0) ? "checked" : ""; ?> />
                            <label for="yq8">Yes</label>
                        </span>
                        <span class="radiobtn mt-2 form-check form-check-inline">
                            <input type="radio" id="nq8" name="q8" value="no" <?php echo ($this->session->q8 == 1) ? "checked" : ""; ?> />
                            <label for="nq8">No</label>
                        </span>
                        <div id="warn-q8" class="warning-textarea"></div>
                    </div>
                </li>
            </ol>

            <hr>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" value="" id="q9">
                <label class="form-check-label font-18" for="defaultCheck1">
                    I hereby declare that the above information is correct.
                </label>
                <div id="warn-q9" class="warning-textarea">
                    Please select
                </div>
            </div>

            <div class="row mb-5">
                <input type="hidden" name="arrival_date" value="<?= $arrival_date; ?>">
                <input type="hidden" name="arrival_time" value="<?= $arrival_time; ?>">
                <div class="col">
                    <button class="btn btn-lg btn-secondary btn-block" onclick="window.history.back(); return false;">Back</button>
                </div>
                <div class="col">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Finish</button>
                </div>

            </div>

        </div>
    </form>
</body>

<script type="text/javascript">
    $(document).ready(function() {

        var pilih = 'Select yes or no !';
        $('#question').submit(function() {
            if ($('#yq1').is(':not(:checked)') && $('#nq1').is(':not(:checked)')) {
                $('#warn-q1').html(pilih);
                $('#warn-q1').show();
                event.preventDefault();
            }
            if ($('#yq1').is(':checked')) {
                var comment = $.trim($('textarea[name="q2"]').val());
                if (comment == "") {
                    $('#warn-q2').show();
                    event.preventDefault();
                }
            }
            if ($('#yq3').is(':not(:checked)') && $('#nq3').is(':not(:checked)')) {
                $('#warn-q3').html(pilih);
                $('#warn-q3').show();
                event.preventDefault();
            }
            if ($('#yq3').is(':checked')) {
                var comment = $.trim($('textarea[name="q4"]').val());
                if (comment == "") {
                    $('#warn-q4').show();
                    event.preventDefault();
                }
            }
            if ($('#yq5').is(':not(:checked)') && $('#nq5').is(':not(:checked)')) {
                $('#warn-q5').html(pilih);
                $('#warn-q5').show();
                event.preventDefault();
            }
            if ($('#yq6').is(':not(:checked)') && $('#nq6').is(':not(:checked)')) {
                $('#warn-q6').html(pilih);
                $('#warn-q6').show();
                event.preventDefault();
            }
            if ($('#yq7').is(':not(:checked)') && $('#nq7').is(':not(:checked)')) {
                $('#warn-q7').html(pilih);
                $('#warn-q7').show();
                event.preventDefault();
            }
            if ($('#yq8').is(':not(:checked)') && $('#nq7').is(':not(:checked)')) {
                $('#warn-q8').html(pilih);
                $('#warn-q8').show();
                event.preventDefault();
            }
            if ($('#q9').is(':not(:checked)')) {
                $('#warn-q9').show();
                event.preventDefault();
            }
        });

        $('#yq1').click(function() {
            $('#warn-q1').hide();
        });
        $('#nq1').click(function() {
            $('#warn-q1').hide();
        });
        /*$('#yq2').click(function() {
            $('#warn-q2').hide();
        });
        $('#nq2').click(function() {
            $('#warn-q2').hide();
        });*/
        $('#yq3').click(function() {
            $('#warn-q3').hide();
        });
        $('#nq3').click(function() {
            $('#warn-q3').hide();
        });
        /*$('#yq4').click(function() {
            $('#warn-q4').hide();
        });
        $('#nq4').click(function() {
            $('#warn-q4').hide();
        });*/
        $('#yq5').click(function() {
            $('#warn-q5').hide();
        });
        $('#nq5').click(function() {
            $('#warn-q5').hide();
        });
        $('#yq6').click(function() {
            $('#warn-q6').hide();
        });
        $('#nq6').click(function() {
            $('#warn-q6').hide();
        });
        $('#yq7').click(function() {
            $('#warn-q7').hide();
        });
        $('#nq7').click(function() {
            $('#warn-q7').hide();
        });
        $('#yq8').click(function() {
            $('#warn-q8').hide();
        });
        $('#nq8').click(function() {
            $('#warn-q8').hide();
        });
        $('#q9').click(function() {
            $('#warn-q9').hide();
        });
    });

    $('textarea[name="q2"]').focus(function() {
        $('#warn-q2').hide();
    });

    $('textarea[name="q4"]').focus(function() {
        $('#warn-q4').hide();
    });
</script>

</html>