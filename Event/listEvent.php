
<!--Template from: http://derekeder.com/searchable_map_template-->
<!--Php can latitude and longitude of category from previous map-->
<?php
$username = "root";
$password = "root";
$hostname = "localhost";
$dbname = "event";

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
   <!-- <script src="js/jquery.js"></script> -->

    <!--Css os tabpane-->


    <!--data table-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!--     JQuery Reference, If you have added jQuery reference in your master page then ignore, else include this too with the below reference-->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>


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
    <div class="container">

            <div class='row well'>
                <div class="col-md-3">
                        <input class="form-control keyword" maxlength="45" id="searchEvent" type="text" placeholder="e.g. Event Name" onkeydown="if(event.keyCode==13){search();return false;}">
                </div>
                <div class="col-md-3">
                        <input class="form-control keyword" maxlength="45" id="searchSuburb" type="text" placeholder="e.g. Suburb" onkeydown="if(event.keyCode==13){search();return false;}">
                </div>
                <div class="col-md-3">
                        <select class="form-control selecter" name="activities" id="search-activity">
                            <option selected="selected" value="">All Activities</option>
                            <option value="aBasketball">Basketball </option>
                            <option value="aBBQ">BBQ </option>
                        </select>
                </div>
                <div class="col-md-3">
                        <a class='btn btn-primary btn-lg' style="width: 100%">
                            <i class="glyphicon glyphicon-search" id="direct"></i>
                        </a>
                </div>
            </div>

                                <table id='event' style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th>Address</th>
                                        <th>Suburb</th>
                                        <th>Participate</th>
                                        <th>Capacity</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <?php
                                        foreach ($list as $val) {
                                    ?>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <?php echo $val['eventId']; ?>
                                        </td>
                                        <td>
                                            <?php echo $val['eventName']; ?>
                                        </td>
                                        <td>
                                            <?php echo $val['eventDescription']; ?>
                                        </td>
                                        <td>
                                            <?php echo $val['type']; ?>
                                        </td>
                                        <td>
                                            <?php echo $val['address']; ?>
                                        </td>
                                        <td>
                                            <?php echo $val['suburb']; ?>
                                        </td>
                                        <td>
                                            <?php echo $val['participate']; ?>
                                        </td>
                                        <td>
                                            <?php echo $val['capacity']; ?>
                                        </td>
                                        <td>
                                            <?php echo $val['date']; ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <?php } ?>

                                    <tfoot>
                                    <tr>
                                        <th>Number</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th>Address</th>
                                        <th>Suburb</th>
                                        <th>Participate</th>
                                        <th>Capacity</th>
                                        <th>Date</th>
                                    </tr>
                                    </tfoot>
                                    </table>







        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $('#event').dataTable();
    });
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="js/table.js"></script>

</body>
</html>

