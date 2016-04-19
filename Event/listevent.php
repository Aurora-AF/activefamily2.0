
<!--Template from: http://derekeder.com/searchable_map_template-->
<!--Php can latitude and longitude of category from previous map-->
<?php
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
$lat = $_GET['lat'];
$lng = $_GET['lng'];
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
                                <table>
                                    <th>User Details</th>
                                    


                                </table>

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

<script>
    //initialize google map which center is Melbourne
    function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        //set the lat and lng for the direction purpose
        //according to the user's current location and the selected venue
        var startLat;
        var startLng;
        var endLat = <?php echo $lat;?>;
        var endLng = <?php echo $lng;?>;


//        var mLat = Math.abs(endLat) - 37.884;
//        var mLng = endLng - 145.0266;
//        var powLatLng = Math.pow(mLat, 2) + Math.pow(mLng, 2);
//        var sqrtLatLng = Math.sqrt(powLatLng);
//
//        var zoomValue = Math.round(127*sqrtLatLng);

        var pos;
        var pos2
        //set the center of the map
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            center: {lat: -37.8141, lng: 144.9633}
        });
        directionsDisplay.setMap(map);

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                startLat = position.coords.latitude;
                startLng = position.coords.longitude;

                var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon:"http://maps.google.com/mapfiles/ms/icons/green-dot.png"
                });
//                map.setCenter(pos);

                pos2 = {
                    lat:endLat,
                    lng:endLng
                };
                var marker2 = new google.maps.Marker(
                    {
                        position: pos2,
                        map:map,
                    }
                );
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }


        var onChangeHandler = function() {
            calculateAndDisplayRoute(directionsService, directionsDisplay, pos, endLat, endLng);

        };
        document.getElementById('duration').innerHTML = "Please select a travel model";
        document.getElementById('direct').addEventListener('click', onChangeHandler);
        //document.getElementById('reset').addEventListener('click', initMap);
    }
    //calculate the direction and route
    function calculateAndDisplayRoute(directionsService, directionsDisplay, pos, endLat, endLng) {
        var selectedMode = document.getElementById('mode').value;
        directionsService.route({
            origin: pos,
            destination: {lat:endLat, lng:endLng},
            travelMode: google.maps.TravelMode[selectedMode]
        }, function(response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                document.getElementById('duration').innerHTML = " ";
                if (status == 'ZERO_RESULTS') {
                    window.alert('Directions request failed due to ' + status);
                }
                directionsDisplay.setDirections(response);
                // Display the duration:
                document.getElementById('duration').innerHTML +=
                    (response.routes[0].legs[0].duration.value / 60).toPrecision(4) + " minutes";
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });

    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFO12yfon9WbQBqtdK_lnmY6uAiDXmB0s&callback=initMap">
</script>
</body>
</html>
