
<link href="<?php echo css ;?>" rel="stylesheet" media="screen">
<!-- <link href="css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="js/smoothness/jquery-ui.css" />
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/navbar.css" rel="stylesheet">
<?php
$confirm = " onclick=\"return confirm('Are you sure you want to delete?')\"";
$table_style_1 = "table table-striped table-bordered";
$table_style_2 = "table table-striped table-bordered table-nonfluid";
$table_style_3 = "table table-striped table-bordered table-nonfluid table-condensed";
?>
<script src="js/jquery-1.10.0.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
});

$(function() {
$( "#datepicker2" ).datepicker({ dateFormat: "yy-mm-dd" });
});
</script>
</head>
<body>

<!-- Begin page content -->
<div class="container">