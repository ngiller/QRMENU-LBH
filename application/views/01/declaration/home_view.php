<html>
<?php $this->load->view($template_folder . '/declaration/include/head_page.php'); ?>

<body class="">
    <form id="declaration-form" class="form-signin text-center " action="/declaration/<?= $pid; ?>" method="POST">
        <img class="logo" src="/assets/img/dobletree-sby.png" alt="" width="125" height="auto">
        <h5 class="mb-3">TRAVEL DECLARATION FORM</h5>
        <?= $foreword; ?>
        <hr>
        <div class="text-left mt-3 pl-2 pr-2">

            <input type="hidden" name="pid" value="<?= $pid; ?>">

            <label for="email" class="">Email address</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>" required autofocus>

            <label for="name" class="mt-3">Full name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" required>

            <label for="name" class="mt-3">Arrival Date</label>
            <input type="date" id="arrival" name="arrival" class="form-control" value="<?php echo $arrival_date; ?>" required>

            <label for="departemen" class="mt-3">Time Arrival</label>
            <input type="time" id="time" name="time" class="form-control" value="<?php echo $arrival_time; ?>" required>

            <label for="name" class="mt-3">Phone Number</label>
            <input type="number" id="phone" name="phone" class="form-control" value="<?php echo $phone; ?>" required>
            <hr class="mt-4 mb-4">
            <button class="btn btn-lg btn-primary btn-block mb-4" type="submit">Next</button>

        </div>
    </form>
</body>

<script type="text/javascript" src="/assets/js/jquery.validate.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $("#declaration-form").validate();

        $('#email').change(function() {

            url = "<?php echo site_url('/declaration/home/find_guest') ?>";

            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#declaration-form').serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'TRUE') {
                        $("#name").val(data.guest.name);
                        $("#phone").val(data.guest.phone);
                    } else {
                        $("#name").val("");
                        $("#phone").val("");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        });

    });
</script>

</html>