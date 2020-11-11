<meta charset="utf-8" />
<title><?php echo SITE_NAME; ?></title>
<meta name="description" content="Page with empty content">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--begin::Fonts -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
	WebFont.load({
		google: {
			"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
		},
		active: function() {
			sessionStorage.fonts = true;
		}
	});
</script>
<!--end::Fonts -->

<!--begin:: Global Optional Vendors -->
<link href="<?php echo base_url('assets/vendors/custom/vendors/flaticon/flaticon.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/vendors/custom/vendors/flaticon2/flaticon.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/vendors/general/datatables/datatables.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/vendors/custom/vendors/line-awesome/css/line-awesome.css') ?>" rel="stylesheet" type="text/css" />

<link href="/assets/vendors/general/clock-picker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url('assets/default/base/style.bundle.css') ?>" rel="stylesheet" type="text/css" />

<!--end::Global Theme Styles -->

<!--begin::Layout Skins(used by all pages) -->
<link href="<?php echo base_url('assets/default/skins/header/base/light.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/default/skins/header/menu/light.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/default/skins/brand/dark.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/default/skins/aside/dark.css') ?>" rel="stylesheet" type="text/css" />

<!--end::Layout Skins -->
<link rel="shortcut icon" href="<?php echo base_url('assets/media/logos/favicon.png') ?>" />

<link href="/assets/vendors/general/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="/assets/vendors/general/datatables/buttons.dataTables.min.css" rel="stylesheet" type="text/css">

<?php date_default_timezone_set($this->session->timezone); ?>