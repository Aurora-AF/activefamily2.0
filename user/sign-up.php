<?php
session_start();
require_once('class.user.php');
$user = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['btn-signup']))
{
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);	
	
	if($uname=="")	{
		$error[] = "provide username !";	
	}
	else if($umail=="")	{
		$error[] = "provide email id !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}
	else if($upass=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['user_name']==$uname) {
				$error[] = "sorry username already taken !";
			}
			else if($row['user_email']==$umail) {
				$error[] = "sorry email id already taken !";
			}
			else
			{
				$url = 'https://www.google.com/recaptcha/api/siteverify';
				$privatekey = "6LfxyB0TAAAAAAT-My5Ly8db3LU1i4-ahGI1Ex-m";

				$response = file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);

				$data = json_decode($response);

				if(isset($data->success) && $data->success == 1) {
					$user->register($uname,$umail,$upass);
					$user->redirect('sign-up.php?joined');
				}else {
					$error[] = "Captcha fails";
				}

			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Active Family : Login</title>
	<!-- Global CSS -->
	<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
	<!-- Plugins CSS -->
	<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="assets/plugins/flexslider/flexslider.css">
	<!-- Theme CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/custom.css"/>
	<link rel="stylesheet" href="style.css" type="text/css"  />
	<script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body style="background-color: #f5f5f5">
<!-- ******HEADER****** -->
<header id="header" class="header navbar-fixed-top" style="position: relative;">
	<div class="container">
		<h1 class="logo">
			<a href="http://active-family.net"><span class="logo-icon"></span><span class="text">Active Family</span></a>
		</h1><!--logo-->
		<nav class="main-nav navbar-right" role="navigation">
			<div class="navbar-header">
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button><!--nav-toggle-->
			</div><!--navbar-header-->
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="nav-item"><a href="../index.html">Home</a></li>
					<li class="nav-item"><a href="../map/index.php">Venues</a></li>
					<li class="nav-item"><a href="../event/index.php">Events</a></li>

					<li class="nav-item"><a href="../about.php">About Us</a></li>
				</ul><!--nav-->
			</div><!--navabr-collapse-->
	</div><!--container-->
</header><!--header-->

<div class="signin-form">

<div class="container">
    	
        <form method="post" class="form-signin" style="background-color: #f5f5f5">
            <h2 class="title" style="font-size: 30px">Sign up.</h2><hr />
            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $umail;}?>" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
            </div>
            <div class="clearfix"></div><hr />
			<div class="form-group">
				<div class="g-recaptcha" data-sitekey="6LfxyB0TAAAAAIdTgHD_v6UbuvWvFVLl55cgmXkD"></div>
			</div>
            <div class="form-group">
            	<button id="submitBtn" type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br />
            <label style="color: #ffa400">Have an account ! <a href="index.php" id="link">Sign In</a></label>

        </form>

       </div>
</div>

</div>

</body>
</html>