<?php
    session_start();
    $user_id = $_SESSION['user_session'];
    $username = "root";
    $password = "root";
    $hostname = "localhost";
    $dbname = "dblogin";

    //connection to the database
    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
        $sql = "SELECT * FROM events";
        $stmt = $pdo->query($sql);
        $eventIDArray = array();
        $i = 0;
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
?>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<!DOCTYPE html lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                    <li class="nav-item"><a href="#">Log in</a></li>
                    <li class="nav-item nav-item-cta last"><a class="btn btn-cta btn-cta-secondary" href="#">Sign Up Free</a></li>
                </ul><!--nav-->
            </div><!--navabr-collapse-->
        </nav><!--main-nav-->
    </div><!--container-->
</header><!--header-->

<!-- ******Steps Section****** -->
<section class="steps section">
    <div class="container" >
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
                            <th>Join</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php
                            $btnEdit[] = array();
                            $btnCancel[] = array();
                            $btnJoin[] = array();
                            $i = 0;
                            foreach ($list as $val){
                                $btnEdit[$i] = "btn-edit".$i;
                                $btnCancel[$i] = "btn-cancel".$i;
                                $btnJoin[$i] = "btn-join".$i;?>
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

                                <form action="" method="post">
                                <td class="form-group">
                                    <button type="submit" name="<?php echo $btnJoin[$i]?>" class="btn btn-primary btn-lg">
                                        <i class="glyphicon glyphicon-log-in"></i> Join
                                    </button>
                                    <?php
                                    $eventId = $val['eventId'];
                                    $curr_capa = $val['curr_capa'];
                                    $capacity = $val['capacity'];
                                    if(isset($_POST[$btnJoin[$i]]) && $curr_capa < $capacity) {
                                        $sql1 = "INSERT INTO eventParticipant VALUES ($eventId, $user_id)";
                                        $resp1 = $pdo->exec($sql1);
                                        if($resp1) {
                                            $sql2 = "UPDATE events SET curr_capa = curr_capa + 1 WHERE eventId = $eventId";
                                            $resp2 = $pdo->exec($sql2);
                                            if($resp2) {
                                                echo '<script type="text/javascript">alert("Successfully Join!");</script>';
                                            }
                                        }
                                        else {
                                            echo '<script type="text/javascript">alert("Already Joined!");</script>';
                                        }
                                    }
                                    if(isset($_POST[$btnJoin[$i]]) && $curr_capa >= $capacity) {
                                        echo '<script type="text/javascript">alert("This event is full!");</script>';
                                    }
                                    ?>
                                </td>
                                </form>
                            </tr>
                        <?php
                            $i++;
                        } ?>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Suburb</th>
                            <th>Capacity</th>
                            <th>Date</th>
                            <th>Join</th>
                        </tr>
                        </tfoot>
                    </table>
                    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

                    <script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>

                    <script type="text/javascript" charset="utf8" src="js/table.js"></script>
                
        </div>
    </div>
</section>

</body>
</html>

