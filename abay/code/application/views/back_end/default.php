<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Control Panel</title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/style/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/style/css/adminstyle.css">
<script language="javascript" src="<?=base_url()?>public/style/js/jquery-1.7.2.js"></script>
<script language="javascript" src="<?=base_url()?>public/style/js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>public/style/js/jquery.easing.1.3.js"></script>
<style>
	table, td, tr, tbody{
		border-color:#FFF;
	}
</style>
</head>
<body>
<div class="tbody">
	<div class="theader">
    	<?=$content_for_header?>
    </div>
    <div class="tcontent">
    	<div class="left">
    		<?=$content_for_left?>
        </div>
        <div class="right">
        	<div class="log">
            </div>
            
        	<?=$content_for_website?>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="tfooter">
    	<?=$content_for_footer?>
    </div>
</div>
</body>
</html>