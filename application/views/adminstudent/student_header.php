<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Edu APP</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="<?php echo base_url(); ?>assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stroke/css/pe-icon-7-stroke.css">
		<!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
	<!--  Forms Validations Plugin -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
	  <script src="<?php echo base_url(); ?>assets/js/jquery.datatables.js"></script>

<style>
.navbar{
margin-bottom:0px;}
.sidemenu{margin-top:78px;}

.caret{
		position: relative;
		top: -20px;
		float: right;
}

.alert button.close {
	position: relative;top:10px;
}
.error{
	color: red;
font-weight: 500;
}

</style>
</head>
<body>

<div class="wrapper">
	<nav class="navbar navbar-default">
			<div class="container-fluid">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Edu App Dashboard </a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown dropdown-with-icons">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<div class="photo">
										<i class="pe-7s-user pe-7x" style="font-size:35px;"></i>
											</div>
								<p class="hidden-md hidden-lg">
									More
									<b class="caret"></b>
								</p>
							</a>
							<ul class="dropdown-menu dropdown-with-icons">
								<li>
									<a href="<?php echo base_url(); ?>studentprofile/profile_update">
										<i class="pe-7s-tools"></i> Profile
									</a>
								</li>
								<li>
									<a href="<?php echo base_url(); ?>studentprofile/pwd_reset">
										<i class="pe-7s-tools"></i> Setting
									</a>
								</li>
								<li class="divider"></li>

								<li>
									<a href="<?php echo base_url(); ?>adminlogin/logout" class="text-danger">
										<i class="pe-7s-close-circle"></i>
										Log out
									</a>
								</li>
							</ul>
						</li>

					</ul>
				</div>
			</div>
		</nav>


    <div class="sidebar sidemenu" data-color="purple" data-image="<?php echo base_url(); ?>assets/img/full-screen-image-3.jpg" style="">

    	<div class="sidebar-wrapper">


            <ul class="nav">
                <li class="">
                    <a href="<?php echo base_url(); ?>">
                        <i class="pe-7s-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

								<li>
										<a data-toggle="collapse" href="#classmenu">
												<i class="pe-7s-note2"></i>
												<p>Attendence	</p>
												<b class="caret"></b>
										</a>
										<div class="collapse" id="classmenu">
											<ul class="nav">
													<li><a href="">Class & Test</a></li>

											</ul>
									</div>
								</li>

								<li>
										<a data-toggle="collapse" href="#sectionmenu">
												<i class="pe-7s-flag"></i>
												<p>Home Work</p>
												<b class="caret"></b>
										</a>
										<div class="collapse" id="sectionmenu">
											<ul class="nav">
													<li><a href="<?php echo base_url(); ?>student/homework_view">Home Work</a></li>

											</ul>
									</div>
								</li>
								<li>
										<a data-toggle="collapse" href="#examresult">
												<i class="pe-7s-plugin"></i>
												<p>Examination Result</p>
												<b class="caret"></b>
										</a>
										<div class="collapse" id="examresult">
											<ul class="nav">
									<li><a href="<?php echo base_url(); ?>student/exam_views">Examination Result</a></li>
											</ul>
									</div>
								</li>
								<li>
										<a data-toggle="collapse" href="#componentsExamples">
												<i class="pe-7s-plugin"></i>
												<p>Calender	</p>
										</a>
								</li>
								<li>
										<a data-toggle="collapse" href="#componentsExamples">
												<i class="pe-7s-plugin"></i>
												<p>Event	</p>
										</a>
								</li>
								<li>
										<a data-toggle="collapse" href="#componentsExamples">
												<i class="pe-7s-plugin"></i>
												<p>Communication	</p>
										</a>
								</li>
								<li>
										<a data-toggle="collapse" href="#componentsExamples">
												<i class="pe-7s-plugin"></i>
												<p>Time Table	</p>
										</a>
								</li>

            </ul>
    	</div>

    </div>
