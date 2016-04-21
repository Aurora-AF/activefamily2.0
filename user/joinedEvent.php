<?php

require_once("session.php");

require_once("class.user.php");
$auth_user = new USER();
$username = "root";
$password = "root";
$hostname = "localhost";
$dbname = "dblogin";

$user_id = $_SESSION['user_session'];
$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));

$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

//connection to the database
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $sql = "SELECT * FROM events e, eventParticipant p where p.user_id = '$user_id' and e.eventId = p.eventId";
    $stmt = $pdo->query($sql);
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
catch(PDOException $e) {
    echo $e->getMessage();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
    <!--<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">-->

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

    <script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css"  />
    <title>welcome - <?php print($userRow['user_email']); ?></title>
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
            <div id="navbar-collapse" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a href="http://active-family.net/">Home</a></li>
                    <li class="active nav-item"><a href="http://active-family.net/map/">Venues</a></li>
                    <li class="nav-item"><a href="http://active-family.net/about.html">About Us</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                            <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                        </ul>
                    </li>
                </ul><!--nav-->
            </div><!--navabr-collapse-->
        </nav><!--main-nav-->
    </div><!--container-->
</header><!--header-->


<div class="clearfix"></div>


<div class="container-fluid" style="margin-top:80px;">

    <div class="container">

        <label class="h5">welcome : <?php print($userRow['user_name']); ?></label>
        <hr />
        <h1>
            <a href="home.php"><span class="glyphicon glyphicon-home"></span> home</a> &nbsp;
            <a href="joinedEvent.php"><span class="glyphicon glyphicon-user"></span> Joined</a> &nbsp;
            <a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile</a></h1>
        <hr />
        <div class='row'>
            <table id='event' class="table table-striped table-bordered" style="width: 10%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Suburb</th>
                    <th>Capacity</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $btnView = array();
                $i = 0;
                foreach ($list as $val){
                    $btnView[$i] = "btnView".$i;
                    $eventId = $val['eventId'];
                    $url = "../view.php?eventId=".$eventId;
                    ?>
                    <tr>
                        <td>
                            <?php echo $val['eventName'];?>
                        </td>
                        <td>
                            <?php echo $val['type'];?>
                        </td>
                        <td>
                            <?php echo $val['suburb'];?>
                        </td>
                        <td>
                            <?php echo $val['capacity'];?>
                        </td>
                        <td>
                            <?php echo $val['date'];?>
                        </td>
                        <form action="" method="post">
                            <td class="form-group">
                                <button type="submit" name="<?php echo $btnView[$i]?>" class="btn btn-primary btn-lg">
                                    <a href="../Event/view.php?eventId=<?php echo $eventId; ?>">
                                        <i class="glyphicon glyphicon-log-in"></i> View
                                    </a>
                                </button>
                            </td>
                        </form>
                    </tr>
                    <?php $i++; }?>

                </tbody>


                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Suburb</th>
                    <th>Capacity</th>
                    <th>Date</th>
                    <th style="display: none">View</th>
                </tr>
                </tfoot>
            </table>
            <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

            <script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>

            <script type="text/javascript" charset="utf8" src="js/table.js"></script>

        </div>
    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>