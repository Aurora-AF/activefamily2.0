<?php
    session_start();

    require_once("../user/class.user.php");
    if(isset($_POST['btn-login'])) {
        $address = $_GET['address'];
        $suburb = $_GET['suburb'];
        $user = new User();
        $user_id = $_SESSION['user_session'];
        $title = $_POST['eTitle'];
        $desc = $_POST['description'];
        $curr_capa = 0;
        $capacity = $_POST['capOption'];

        $date = date('Y-m-d G:i', strtotime($_POST['eDate']));
        $type = $_POST['taskOption'];
        $sql = "INSERT INTO events (create_user_id, eventName, eventDescription, type, address, suburb, capacity, curr_capa, date) VALUES ('$user_id', '$title', '$desc', '$type', '$address', '$suburb', $capacity, $curr_capa, '$date')";
        $stmt = $user->runQuery($sql);
        $stmt->execute();

        $sql = "SELECT eventId FROM events WHERE eventName = '$title'";
        $stmt = $user->runQuery($sql);
        $stmt->execute();

        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        $event_id = $userRow['eventId'];

        $sql = "INSERT INTO eventParticipant VALUES ('$event_id', '$user_id')";
        $stmt = $user->runQuery($sql);
        $stmt->execute();
        header('Location:listEvent.php');
    }
?>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<!DOCTYPE html lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Active Family</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,900,900italic,300italic,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="assets/plugins/flexslider/flexslider.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/custom.css"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css"  />

</head>

<body class="features-page">

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
            <div id="navbar-collapse" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a href="http://active-family.net/">Home</a></li>
                    <li class="active nav-item"><a href="http://active-family.net/map/">Venues</a></li>
                    <li class="nav-item"><a href="http://active-family.net/about.html">About Us</a></li>
                </ul><!--nav-->
            </div><!--navabr-collapse-->
        </nav><!--main-nav-->
    </div><!--container-->
</header><!--header-->

<!-- ******Steps Section****** -->
<section class="steps section">

                        <div class="container">
                            <form class="form-signin" method="post" id="login-form">
                                <h2 class="form-signin-heading">Create Your Event</h2><hr />

                                <div class="form-group">
                                    Title<span>*</span>
                                    <input type="text" class="form-control" name="eTitle" placeholder="Event Title" required />
                                    <span id="check-e"></span>
                                </div>

                                <div class="form-group">
                                    Description<span>*</span><br>
                                    <textarea rows="5" cols="60" id="description" name="description" style="border-color: lightgray;" autofocus>

                                    </textarea>
                                    <span id="check-e"></span>
                                </div>
                                <div class="form-group">
                                    Hold Date<span>*</span>
                                        <input id="datetimepicker" type="text" class="form-control" name="eDate" id="eDate">
                                    <span id="check-e"></span>
                                </div>
                                <div class="form-group">
                                    Capacity<span>*</span>
                                    <label>
                                        <select name="capOption" size="0" id="eType" style="width: 10em">
                                            <option selected="selected" value="">Number</option>
                                            <option>5</option>
                                            <option>10</option>
                                            <option>15</option>
                                            <option>20</option>
                                        </select>
                                    </label>

                                    <span id="check-e"></span>
                                    Categories<span>*</span>
                                    <label>
                                        <select name="taskOption" size="0" id="eType" style="width: 10em">
                                            <option selected="selected" value="">All Activities</option>
                                            <option>BBQ</option>
                                            <option>Walking Dog</option>
                                            <option>Yoga</option>
                                            <option>Sports Club</option>
                                            <option>Basketball</option>
                                        </select>
                                    </label>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <button type="submit" name="btn-login" class="btn btn-default">
                                        <i class="glyphicon glyphicon-log-in"></i> &nbsp; Submit
                                    </button>
                                </div>
                                <br />
                                <label>Don't have account yet ! <a href="sign-up.php">Submit</a></label>
                            </form>

                        </div>
</section>
<script>$(document).ready(function() {$('#datetimepicker').datetimepicker();});  </script>
</body>
<link rel="stylesheet" type="text/css" href="datetimepicker-master/jquery.datetimepicker.css"/ >
<script src="datetimepicker-master/jquery.js"></script>
<script src="datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>

</html>

