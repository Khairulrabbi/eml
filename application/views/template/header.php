<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="shortcut icon" href="<?=base_url()?>img/logo/favicon.ico" type="image/x-icon"/>
    <title><?php echo $module_name->module_name; ?></title>
    
    <!---------------------------------------- CSS Libraries --------------------------------------------->
    <link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?=base_url()?>css/plugins/timeline.css" rel="stylesheet">
    <link href="<?=base_url()?>css/sb-admin-2.css" rel="stylesheet">
    <link href="<?=base_url()?>css/plugins/morris.css" rel="stylesheet">
    <link href="<?=base_url()?>css/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>css/datepicker.css" rel="stylesheet">
    <link href="<?=base_url()?>css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?=base_url()?>css/jquery-ui.min.css" rel="stylesheet">
    <link href="<?=base_url()?>css/select2.css" rel="stylesheet">
    <link href="<?=base_url()?>css/apsis_style.css" rel="stylesheet">
    <link href="<?=base_url()?>css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>css/plugins/dataTables.tableTools.css" rel="stylesheet">
    <!------------------------------------------>
    <!------------------------------------------ jQuery Version 1.11.0 ----------------------------------->
    <script src="<?=base_url()?>js/jquery-1.11.0.js"></script>
    <script src="<?=base_url()?>js/jquery-ui.min.js"></script>
    <!------------------------------------------>
    <!-------------------------------------  Angular JS Libraries ---------------------------------------->
    <script src="<?=base_url()?>js/angular/angular.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>js/angular/app.js" type="text/javascript"></script>
    <!------------------------------------------>
    <!--------------------------- Bootstrap Core & Custom Theme JavaScript ------------------------------->
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>js/sb-admin-2.js"></script>
    <script src="<?=base_url()?>js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap.file-input.js"></script>
    <!------------------------------------------>
    
<!--    <script src="<?//=base_url()?>js/jquery.imgareaselect.pack.js"></script>-->
<!--    <script src="<?//=base_url()?>js/script.js"></script>-->
<!--    <script src="<?//=base_url()?>js/bootstrap-datepicker.js"></script>-->

    <style>
        .datepicker{z-index: 99999 !important;}
        .toolbar { float: left; }
        .new_tr td{background: #D2FF99 !important;}
        div.form-control{border: none;padding: 0}
        div.select2-container{display: block !important; height: auto !important;}
    </style>
</head>

<body>
<!------------------------------------------------- Right Top ------------------------------------------------->
    <nav class="navbar navbar-default navbar-fixed-top nav-blue" role="navigation" style="margin-bottom: 0">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="<?=base_url()?>" style="display: inline-table;padding: 5px 0 0 5px;">
                              <img class="img-responsive" src="<?=base_url()?>images/logo/logo.png" alt=""/>
                          </a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-------- Notification -------->
            <ul class="nav navbar-nav navbar-right nav-blue" style="position: relative;">
                <div id ="count_notification" style="position:absolute;left: 20px;background: #c8c8c8; border-radius: 20px;width: 27px; height: 16px; color: #f00; text-align: center;top: 9px; z-index: -1;">
                     <?php echo ($count_new_notification>99?$count_new_notification.'+':$count_new_notification); ?>
                </div>
                <li class="dropdown">
                    <a href="<?=base_url()?>master/notification">
                        <i class="glyphicon glyphicon-bell"></i>
                    </a>
                    
                </li>
                
                <!-------- Module -------->
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="<?php echo $module_name->module_icon ?>"></i> 
                            <?php echo $module_name->module_name; ?> 
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks"><?php echo $module_html ?></ul>
                </li>
                
                <!-------- Profile Name + Settings -------->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img style="width: 25px;" src="<?php echo base_url().''.$this->session->userdata('USER_IMAGE'); ?>"> <?php echo $this->session->userdata('FIRSTNAME'); ?>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li><a href="<?=base_url()?>master/edit_profile"><i class="glyphicon glyphicon-cog"></i> Edit Profile</a></li>
                        <li><a href="<?=base_url()?>master/set_reliever"><i class="fa fa-chain-broken"></i> Delegate</a></li>
                        <li><a href="<?=base_url()?>login_cont/logout/"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                    </ul>
                </li>
            <!--------------------------------------------->
            </ul>
<!-------------------------------------MENU BAR-------------------------------------------------->
        <div class="row" style="border-top: 1px solid #00a178;border-bottom: 1px solid #00a178;"></div>
		<ul class="nav navbar-nav">
			<?php if(isset($menu_list)){ foreach ($menu_list as $menu_list1){ echo $menu_list1; }} ?>
		</ul>
<!----------------------------------------------------------------------------------------------->
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
    </nav>
    
    <div class="container" style="margin-top:125px;">

<script>
    $(function(){
	$(".dropdown-menu > li > a.trigger").on("click",function(e){
		var current=$(this).next();
		var grandparent=$(this).parent().parent();
		if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
			$(this).toggleClass('right-caret left-caret');
		grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
		grandparent.find(".sub-menu:visible").not(current).hide();
		current.toggle();
		e.stopPropagation();
	});
	$(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
		var root=$(this).closest('.dropdown');
		root.find('.left-caret').toggleClass('right-caret left-caret');
		root.find('.sub-menu:visible').hide();
	});
    });
</script>
