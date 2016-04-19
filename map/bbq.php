<?php
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
require_once("../Login-Signup-PDO-OOP/class.user.php");
$login = new USER();
if($login->is_loggedin()) { ?>
<style type="text/css">
    #register {
        display: none;
    }
</style>

<?php }; ?>

<!--Template from: http://derekeder.com/searchable_map_template-->
<!--Php can get latitude and longitude of category from previous map-->

<?php
$user_id = $_SESSION['user_session'];

$stmt = $login->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));

$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$lat = $_GET['lat'];
$lng = $_GET['lng'];
$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=true";
$json = file_get_contents($url);
$data = json_decode($json);
$address = $data->results['0']->formatted_address;
$locality = $data->results['0']->address_components['2']->long_name;
$postcode = $data->results['0']->address_components['5']->long_name;
?>
<!--Current temperature by using operweathermap api-->
<?php
//$lat = $_GET['lat'];
//$lng = $_GET['lng'];
$name;
$description;
$temp;
$wind;
$week;
if ($lat!=null&&$lng!=null){
    //current weather api
    $url = "http://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lng&appid=2685e072f39f0387a6ff22225a56f4ba";
    $data = file_get_contents($url);
    $data = json_decode($data, true);
    //City name
    $name = $data['name'];
    //description
    $a = 272.15;
    $description = $data['weather'][0]['description'];
    //temperature
    $temp = $data['main']['temp']- $a;
    //wind
    $wind = $data['wind']['speed'];
    //dt
    $dt = $data ['dt'];
    $time = date('w', $dt);
    $timeDay;
    $tim = date('y-m-d H:m:s', $dt);
    switch ($time) {
        case 0:
            $timeDay = "SUN";
            break;
        case 1:
            $timeDay = 'MON';
            break;
        case 2:
            $timeDay = 'TUE';
            break;
        case 3:
            $timeDay = 'WED';
            break;
        case 4:
            $timeDay = 'THU';
            break;
        case 5:
            $timeDay = 'FRI';
            break;
        case 6:
            $timeDay = 'SAT';
            break;
    }
} else{
    $name = "null";
    $description = "null";
    $temp = "null";
    $wind = "null";
    $dt = "null";
}
?>
<!--Forcast temperature by using operweathermap api-->
<?php
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$fdescription;
$temprage;
if ($lat!=null&&$lng!=null){
    //forcast weather api
    $furl = "http://api.openweathermap.org/data/2.5/forecast/daily?lat=$lat&lon=$lng&cnt=10&mode=json&appid=2685e072f39f0387a6ff22225a56f4ba";
    $json = file_get_contents($furl);
    $fdata = json_decode($json, true);
    //description
    $a = 272.15;

    $forecastTamp[] = array();

    for ($x=1; $x<7; $x++){
        $max = $fdata['list'][$x]['temp']['max']-$a;
        $min = $fdata['list'][$x]['temp']['min']-$a;
        $range = $min." ~ ".$max." ˚C";
        $fdescription = $fdata['list'][$x]['weather'][0]['description'];
        $fdt = $fdata ['list'][$x]['dt'];
        $ftime = date('w', $fdt);
        $ftimeDay;
        if ($ftime==0) {
            $ftimeDay = 'SUN';
        }else if($ftime==1){
            $ftimeDay = 'MON';
        }else if($ftime==2){
            $ftimeDay = 'TUE';
        }else if($ftime==3){
            $ftimeDay = 'WED';
        }else if($ftime==4){
            $ftimeDay = 'THU';
        }else if($ftime==5){
            $ftimeDay = 'FRI';
        }else if($ftime==6){
            $ftimeDay = 'SAT';
        }
        $forecastTamp[$x]= $ftimeDay.", ".$range.", ".$fdescription;
    }
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
    <script type="text/javascript">
        <!--//---------------------------------+
        //  Developed by Roshan Bhattarai
        //  Visit http://roshanbh.com.np for this script and more.
        // --------------------------------->
        $(document).ready(function()
        {
            //slides the element with class "menu_body" when paragraph with class "menu_head" is clicked
            $("#firstpane p.menu_head").click(function()
            {
                $(this).css({backgroundImage:"url(images/menu/down.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
                $(this).siblings().css({backgroundImage:"url(images/menu/left.png)"});
            });

        });
    </script>
    <!--style of map-->
    <style type="text/css">
        #map {
            height: 100%;
        }
    </style>
    <!--style of menu-->
    <style type="text/css">
        body {  }
        .menu_list { width: 100%; }
        .menu_head { padding: 5px 10px; cursor: pointer; position: relative; margin:1px; font-weight:bold; background: #eef4d3 url(images/menu/left.png) center right no-repeat; }
        .menu_body { display:none; }
        .menu_body a { display:block; color:#006699; background-color:#EFEFEF; padding-left:10px; font-weight:bold; text-decoration:none; }
        .menu_body a:hover { }
    </style>
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
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a href="http://active-family.net/">Home</a></li>
                    <li class="active nav-item"><a href="http://active-family.net/map/">Venues</a></li>
                    <li class="nav-item"><a href="http://active-family.net/about.html">About Us</a></li>
                    <li class="nav-item"><a href="http://localhost:8888/active%20family/Login-Signup-PDO-OOP/index.php" id="register">Log in</a></li>
                    <li class="nav-item nav-item-cta last"><a class="btn btn-cta btn-cta-secondary" href="#" id="register">Sign Up Free</a></li>
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
    

    
    <!-- ******Steps Section****** --> 
    <section class="steps section">
        <div class="container">
            
            <div class='container-fluid'>
    <div class='row'>
        <div class='col-md-4'>

            <div class='well'>
                <h1 class="title">
                    BBQ
                                    </h1>
                <div class="btn-group">
                    <button class="btn btn-defult dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pick a Category
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="drink.html">Drink Fountain</a></li>
                        <li><a href="bbq.html">BBQ</a></li>
                        <li><a href="dog.html">Dog Friendly Areas</a></li>
                        <li><a href="bike.html">Bicycle Rails</a></li>
                    </ul>
                </div>
                <hr>
                <p>
                    <input class='form-control' id='search_address' placeholder='Enter an address or an intersection' type='text' onfocus="document.getElementById('search_address').value=''" onclick="document.getElementById('search_address').value=''" />

                </p>
                <a class='btn btn-primary btn-lg' id='search' href='#'>
                    <i class='glyphicon glyphicon-search'></i>
                    Search
                </a>
                <a id='find_me' href='#' class="btn btn-primary btn-lg">Locate</a>
            <p> <br></p>
                <p class="btn-group">
                    <button class="btn btn-defult dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Choose Search Radius
                        <span class="caret"></span>
                    </button>

                        <select id='search_radius' multiple class=" dropdown-menu" >
                            <option value='400'>2 blocks</option>
                            <option value='500'>1/2 km</option>
                            <option value='1000'>1 km</option>
                            <option value='2000'>2 km</option>
                            <option value='5000'>5 km</option>
                        </select>

                </p>
                </div>
            <div class='alert alert-info' id='result_box' ><strong id='result_count'></strong></div>
            



        </div>
        <div class='col-md-8'>
            <noscript>
                <div class='alert alert-info'>
                    <h4>Your JavaScript is disabled</h4>
                    <p>Please enable JavaScript to view the map.</p>
                </div>
            </noscript>
            <div id='map_canvas'></div>

        </div>
    </div>
</div>

<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery.address.js"></script>
<script type="text/javascript" src="js/bootstrap.min.map.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKWfGBpeBLZ2vVsvEeFdJrOEkVH7sE9Uk&libraries=places"></script>
<script type="text/javascript" src="js/maps_lib.js"></script>
<script type='text/javascript'>
    //<![CDATA[
    $(window).resize(function () {
        var h = $(window).height(),
                offsetTop = 105; // Calculate the top offset

        $('#map_canvas').css('height', (h - offsetTop));
    }).resize();

    $(function() {
        var myMap = new MapsLib({
            fusionTableId:      "1uvkv0IjHDDzKgIuwhj6nAH79y7TKY9l-n_nU4w34",
            locationColumn:     "Location",
            map_center:         [-37.8141,144.9633]

        });
        var autocomplete = new google.maps.places.Autocomplete(document.getElementById('search_address'));

        $(':checkbox').click(function(){
            myMap.doSearch();
        });

        $(':radio').click(function(){
            myMap.doSearch();
        });

        $('#search_radius').change(function(){
            myMap.doSearch();
        });

        $('#search').click(function(){
            myMap.doSearch();
        });

        $('#find_me').click(function(){
            myMap.findMe();
            return false;
        });

        $('#reset').click(function(){
            myMap.reset();
            return false;
        });

        $(":text").keydown(function(e){
            var key =  e.keyCode ? e.keyCode : e.which;
            if(key === 13) {
                $('#search').click();
                return false;
            }
        });
    });
    //]]>
</script>

        </div><!--//container-->        
    </section><!--//steps-->
    
        <!-- ******FOOTER****** --> 
    <footer class="footer">
        <div class="footer-content">
            <div class="container">
                
                <div class="row has-divider">
                    <div class="footer-col download col-md-6 col-sm-12 col-xs-12">
                        <div class="footer-col-inner">
                            
                        </div><!--//footer-col-inner-->
                    </div><!--//download-->
                    <div class="footer-col contact col-md-6 col-sm-12 col-xs-12">
                        <div class="footer-col-inner">
                            <h3 class="title">Contact us</h3>                          
                            <p class="adr clearfix">
                                <i class="fa fa-map-marker pull-left"></i>        
                                <span class="adr-group pull-left">       
                                    <span class="street-address">Monash University</span><br>
                                    <span class="region">900 Dandenong Rd</span><br>
                                    <span class="postal-code">Caulfield East VIC 3145</span><br>
                                    <span class="country-name">Au</span>
                                </span>
                            </p>
                            <p class="email"><i class="fa fa-envelope-o"></i><a href="#">enquires@active-family.net</a></p> 
                            <a href="https://twitter.com/activeFamily4" class="twitter-follow-button" data-show-count="false">Follow @activeFamily4</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>                        
                        </div><!--//footer-col-inner-->
                    </div><!--//contact-->
                </div>
            </div><!--//container-->
        </div><!--//footer-content-->
        <div class="bottom-bar">
            <div class="container">
                <small class="copyright">Copyright @ 2016 <a href="../copyright.txt" target="_blank">Active family</a></small>                
            </div><!--//container-->
        </div><!--//bottom-bar-->
    </footer><!--//footer-->
    
    <!-- Video Modal -->
    <div class="modal modal-video" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 id="videoModalLabel" class="modal-title sr-only">Video Tour</h4>
                </div>
                <div class="modal-body">
                    
                </div><!--//modal-body-->
            </div><!--//modal-content-->
        </div><!--//modal-dialog-->
    </div><!--//modal-->
    
    
 
 <script type="text/javascript" src="assets/plugins/bootstrap/js/"></script> 
   <script type="text/javascript" src="assets/plugins/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>
    <script type="text/javascript" src="assets/plugins/FitVids/jquery.fitvids.js"></script>
    <script type="text/javascript" src="assets/plugins/flexslider/jquery.flexslider-min.js"></script>   
  <script type="text/javascript" src="assets/js/main.js"></script> 
    
            
</body>
</html> 
