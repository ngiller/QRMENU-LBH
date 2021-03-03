<html>
<?php $this->load->view($template_folder . '/declaration/include/head_page.php'); ?>

<body class="">
    <form id="declaration-form" class="form-signin text-center " action="/declaration/member/post" enctype="multipart/form-data" method="POST">
        <img class="logo" src="/assets/img/dobletree-sby.png" alt="" width="125" height="auto">
        <h5 class="mb-3">MEMBER REGISTRATION FORM</h5>
        <hr>
        <?php echo validation_errors(); ?>
        <?php
            if ($error_msg != '') {
        ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_msg; ?>
        </div>
        <?php        
            } 
        ?>
        <div class="text-left mt-3 pl-2 pr-2">

            <input type="hidden" name="lid" value="<?= $lid; ?>">

            <label for="email" class="">Email address</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $guest->email; ?>" required autofocus>

            <label for="name" class="mt-3">Full name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $guest->name; ?>" required>

            <label for="name" class="mt-3">Phone Number</label>
            <input type="number" id="phone" name="phone" class="form-control" value="<?php echo $guest->phone; ?>" required>
            <label for="name" class="mt-3">Card ID/ Passport</label>
            <input type="file" id="photo" name="photo" accept="image/*" onchange="previewFile(this);" required>
            <div class="mt-3">
                <img id="previewImg" src="" style="width: 70%;">
            </div>
            <div id="remove-img" class="btn btn-sm btn-info mt-2" onclick="remove();">remove</div>
            <hr class="mt-4 mb-4">
            <button class="btn btn-lg btn-primary btn-block mb-4" type="submit">Next</button>

        </div>
    </form>
</body>

<script type="text/javascript" src="/assets/js/jquery.validate.min.js"></script>

<script type="text/javascript">
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
            $('#previewImg').show();
            $('#remove-img').show();
        }
    }

    function remove() {
        $('#previewImg').hide();
        $('#remove-img').hide();
        $('#previewImg').attr("src", "");
        $('#photo').val('');
    }

    $(document).ready(function() {

        $('#previewImg').hide();
        $('#remove-img').hide();

    });
</script>

</html>