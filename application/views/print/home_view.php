
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Order Print Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/assets/img/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/css/print.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 text-center p-3">
                <h4>ORDER PRINTING</h4>
                <hr>
                <form class="form-inline mt-3 d-flex justify-content-center">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Outlet</label>
                    <select class="custom-select my-1 mr-sm-2" id="select_outlet">
                    <?php
                        foreach ($select_outlet->result() as $row) :
                            if ($this->session->print_outlet_id  == "") {
                                $this->session->set_userdata('print_outlet_id', $row->id);
                            }
                            if ($this->session->print_outlet_id == $row->id) {
                        ?>
                                <option value="<?php echo $row->id; ?>" selected><?php echo $row->name; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                        <?php }
                        endforeach; ?>
                    </select>
                </form>
                <hr style="border-top: 1px dashed #ddd;">
                <div id="print">
                    Last printing : <span id="status"> idle... </span> 
                </div>
                <hr style="border-top: 1px dashed #ddd;">
                <a href="/print/signin/logout" class="btn btn-success">Sign Out</a>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="/assets/js/jquery-3.5.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/recta.js"></script> <!----- PRINT ORDER ---------------->
<!--===============================================================================================-->

<script type="text/javascript">

    function print_order() {
        var printer = new Recta('1234567890', '1811');
        $.ajax({
            url: '/print/print_order/list_order',
            type: 'post',
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                if (response.text_print != '') {
                    //console.log(response.text_print);
                    $('#status').html(response.order_id);
                    printer.open().then(function() {
                        printer
                            .align('left')
                            .raw(response.text_print)
                            .print()
                    });

                    var i;
                    for(i=0;i<response.order_id.length; i++){
                        $.ajax({
                            url: '/print/print_order/set_already_print/'+response.order_id[i],
                            type: 'post',
                            dataType: 'JSON',
                            success: function(response) {
                            }
                        });
                    }
                }
            }
        })
    };

    $(document).ready(function() {

        setInterval(print_order, 3000);

        $('#select_outlet').change(function(){
            var id=$(this).val();					
            $.ajax({
                url : "<?php echo base_url();?>print/home/change_outlet/",
                method : "POST",
                data : {id: id},						
                dataType : 'JSON',
                success: function(data) {		
                    //table.ajax.reload();							
                }
            });
        });	
    });
</script>

</body>
</html>