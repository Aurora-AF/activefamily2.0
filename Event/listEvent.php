
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
    foreach($list as $val) {
        $eventIDArray[$i] = $val['eventId'];
        $i++;
    }
}
catch(PDOException $e) {
    echo $e->getMessage();
}

?>


<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<!DOCTYPE html lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
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


    <link type="text/css" rel="stylesheet" href="css/tab.webfx.css" />
    <script type="text/javascript" src="js/webfxlayout.js"></script>
    <script type="text/javascript" src="js/tabpane.js"></script>

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

        <div class='container-fluid'>
            <div class='row'>
                <div class="col-md-3">
                    <div class="well">
                        <input class="form-control keyword" maxlength="45" id="searchEvent" type="text" placeholder="e.g. Event Name" onkeydown="if(event.keyCode==13){search();return false;}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well">
                        <input class="form-control keyword" maxlength="45" id="searchSuburb" type="text" placeholder="e.g. Suburb" onkeydown="if(event.keyCode==13){search();return false;}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well">
                        <select class="form-control selecter" name="activities" id="search-activity">
                            <option selected="selected" value="">All Activities</option>
                            <option value="aBasketball">Basketball </option>
                            <option value="aBBQ">BBQ </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well">
                        <a class='btn btn-primary btn-lg' style="width: 100%">
                            <i class="glyphicon glyphicon-search" id="direct"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="well">
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="well">
                        <div class="tab-pane" id="tabPane1">

                            <script type="text/javascript">
                                tp1 = new WebFXTabPane( document.getElementById( "tabPane1" ) );
                                //tp1.setClassNameTag( "dynamic-tab-pane-control-luna" );
                                //alert( 0 )
                            </script>

                            <div class="tab-page" id="tabPage1">
                                <h2 class="tab">Event List</h2>

                                <script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>
                                <?php
                                print "<table id='record'>\n
	                                <tr>
		                                <th>Topic</th>
			                            <th>Outline</th>
			                            <th>Update Time</th>
		                            </tr>\n";
                                ?>

                            </div>

                            <div class="tab-page" id="tabPage2">
                                <h2 class="tab">Map</h2>

                                <script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage2" ) );</script>

                                This is text of tab 2. This is text of tab 2. This is text of tab 2.
                                This is text of tab 2. This is text of tab 2. This is text of tab 2.
                                This is text of tab 2. This is text of tab 2. This is text of tab 2.
                                <br />
                                <br />
                                This is text of tab 2. This is text of tab 2. This is text of tab 2.
                                This is text of tab 2. This is text of tab 2. This is text of tab 2.
                                This is text of tab 2. This is text of tab 2. This is text of tab 2.

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</body>
</html>

