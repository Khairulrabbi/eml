<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WingsERP || Login</title>

    <!-- Bootstrap -->
	<script src="<?=base_url()?>js/pace.js"></script>
    <link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>css/theme.css" rel="stylesheet">
    <link href="<?=base_url()?>css/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url()?>css/animate.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:700,400|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	<link href="<?=base_url()?>css/theme-loading-bar.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>img{opacity: 0.3;}</style>
  <body>
	<div class="container" id="container" style="display:none;">
		<header>
			<!-- Main comapny header -->
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			  <div class="container">
				<div class="navbar-header">
				  <a class="navbar-brand top-navbar-brand" href="#"> </a>
				</div>
<!--				<ul class="nav navbar-nav navbar-right bigger-130 hidden-xs">
					<li><a href="#"><i class="fa fa-google"></i></a></li>
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				</ul>-->
			  </div>
			</nav>
		</header>
		<section id="form" class="animated fadeInDown">
			<div class="container">    
				<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
					<div class="panel white-alpha-90" >
						<div class="panel-heading">
							<div class="panel-title text-center"><h2>Sign In to <span class="text-primary">WingsERP</span></h2></div>
						</div>     
						<div class="panel-body" >
                                                    <?php if($this->session->flashdata('recovery_message')){?>
                                                    <div style="" id="login-alert" class="alert alert-danger col-sm-12">
                                                        <?php echo $this->session->flashdata('recovery_message');?>
                                                    </div>
                                                    <?php }?>
                                                        <form id="loginform" class="form-horizontal" role="form" action="<?=base_url()?>login_cont/login" method="post">
                                                            <input type="hidden" name="re_url" value="<?php echo @$re_url; ?>">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input id="login-username" type="text" class="form-control" name="user_name" value="" placeholder="username or email">                                        
								</div>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input id="login-password" type="password" class="form-control" name="password" placeholder="password">
								</div>
								<div class="input-group col-xs-12 text-center login-action">
								  <div class="checkbox">
									<label>
									  <input id="login-remember" type="checkbox" name="remember" value="1" style="margin-top: 10px;"> Remember me &nbsp;
                                                                          <span id="btn-login"><input type="submit" value="Login" class="btn btn-sm btn-primary"/></span>
									</label>
								  </div>
								</div>
								<div style="margin-top:10px" class="form-group">
									<div class="col-sm-12 controls">
									  
									</div>
								</div>
							</form>     
						</div>                     
					</div>  
				</div>
			</div>
		</section>
		<footer>
			<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
			  <div class="container text-center">
				<div class="footer-content">
                                    &copy; 2016 Apsis Solutions Ltd.
				</div>
			  </div><!-- /.container-fluid -->
			</nav>
		</footer>
	</div>

	<script src="<?=base_url()?>js/jquery-1.11.0.js"></script>
	<script src="<?=base_url()?>js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>js/jquery.backstretch.min.js"></script>

	<script>
		Pace.on('hide', function(){
		  $("#container").fadeIn('1000');
		  $.backstretch([
				"<?=base_url()?>images/user/1_Apsis.jpg"
			], {duration: 5000, fade: 1000});
		});
		
	</script>
	
  </body>
</html>