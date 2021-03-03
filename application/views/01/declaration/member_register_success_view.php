<html>
<?php $this->load->view($template_folder . '/declaration/include/head_page.php'); ?>

<body class="">
    <form id="declaration-form" class="form-signin text-center " action="/declaration/member/post" method="POST">
        <img class="logo" src="/assets/img/dobletree-sby.png" alt="" width="125" height="auto">
        <h5 class="mb-3">MEMBER REGISTRATION SUCCESS</h5>
        <hr>
        <div class="text-left mt-3 pl-2 pr-2">
        
            <input type="hidden" name="pid" value="<?= $lid; ?>">
            <div class="row">
                <label for="email" class="col-3 col-form-label">Email</label>
                <div class="col-9">
                    <input type="text" readonly class="form-control-plaintext" id="email" value=": <?php echo $guest['email']; ?>">
                </div>
            </div>

            <div class="row">
                <label for="name" class="col-3 col-form-label">Full name</label>
                <div class="col-9">
                    <input type="text" readonly class="form-control-plaintext" id="name" value=": <?php echo $guest['name']; ?>">
                </div>
            </div>

            <div class="row">
                <label for="name" class="col-3 col-form-label">Phone #</label>
                <div class="col-9">
                    <input type="text" readonly class="form-control-plaintext" id="phone" value=": <?php echo $guest['phone']; ?>">
                </div>
            </div>

            <label for="name" class="mt-3">Card ID/ Passport</label>
            <div class="mt-3">
                <img id="previewImg" src="/uploads/members/<?php echo $guest['file_name']; ?>" style="width: 70%;">
            </div>
        </div>
    </form>
</body>

</html>