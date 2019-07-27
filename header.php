<nav class="navbar navbar-default navbar-static-top navbar-top"
	role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse"
			data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
			<span class="icon-bar"></span> <span class="icon-bar"></span>
		</button>
		<a href="http://tyasuite.com/index.php" target="_blank">
			<img alt="tya-logo" src="img/logo.png" class="img-responsive logo">
		</a>
	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">

		<!-- /.dropdown -->
		<li class="dropdown"><a class="dropdown-toggle logout-fa-btn"
			data-toggle="dropdown" href="#"> <i class="fa fa-user fa-fw"></i> <i
				class="fa fa-caret-down"></i>
		</a>
			<ul class="dropdown-menu dropdown-user">
				<li>
					<a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
				</li>
				<li>
					<a href="reset-password.php"><i class="fa fa-key fa-fw"></i>Reset Password</a>
				</li>
				<li>
					<a href="forgot-password.php"><i class="fa fa-key fa-fw"></i>Forgot Password</a>
				</li>
			</ul> <!-- /.dropdown-user --></li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar sidebar-style" role="navigation">
                <?php include 'sidebar.php'; ?>
            </div>
	<!-- /.navbar-static-side -->
</nav>