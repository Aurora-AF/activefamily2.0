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
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
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
    <link href="http://localhost:8888/active-family/map/css/menu.css" type="text/css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--style of map-->
    <style type="text/css">
        #map {
            height: 100%;
        }

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
                <div class="col-md-4">
                    <div class="well">
                    <div id="floating-panel">
                        <!--Drop down Category -->
                        
                        <div id="travel">
                            <select id = "mode">
                                <option value="DRIVING">Mode of Travel: Driving</option>
                                <option value="WALKING">Mode of Travel: Walking</option>
                                <option value="BICYCLING">Mode of Travel: Bicycling</option>
                                <option value="TRANSIT">Mode of Travel: Transit</option>
                            </select>
                        </div>
                        <br>
                        <button id="direct">Get Direction</button>
                        <!--    <button id="reset">Reset</button>-->

                        <!--Display information details-->
                        <div id="acc"> <b class="nav"><span>Address Detail</span></b>
                            <div class="sub"><p><?php echo $address;?></p></div>
                            <b  class="nav"><span>Weather</span></b>
                            <!--http://www.weatherzone.com.au/about/freeweatherbutton.jsp-->
                            <div class="sub1"><a><script type="text/javascript" src="http://www.weatherzone.com.au/woys/graphic_current.jsp?postcode=<?php echo $postcode;?>"></script></a>
                                <a><script type="text/javascript" src="http://www.weatherzone.com.au/woys/graphic_forecast.jsp?postcode=<?php echo $postcode;?>"></script></a></div>
                            <b class="nav"><span>Rate</span></b>
                            <div class="sub"> </div>
                            <b  class="nav"><span>Comments</span></b>
                            <div class="sub"> </div>
                            <b  class="nav"><span>Get Direction</span></b>
                            <div class="sub"> </div>
                        </div>
                        <div class="clearfix"></div>
                        <!--display public details-->
                        <!--weights source code from http://www.eventsvictoria.com/distribution-centre/widget/-->
                        <div>
                            <script src="http://www.eventsvictoria.com/Scripts/atdw-dist-min/v2-1/Default/widget/widget.min.js" type="text/javascript"></script><div class="atdw-event-widget"></div><script type="text/javascript">window.atdw.myevents.widget.load({
                                    mode:'List',
                                    locations:{all:true,regions:'',councils:'',postcodes:''},
                                    types:{business:false,leisure:true},
                                    tags:'FAMILY,LIVEMUSIC',
                                    businessTypes:'',
                                    freeOnly:false,
                                    size:{width:230,height:300},
                                    theme:'BLUE'});</script>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-8">
                <div id="map"></div>
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

        var pos;
        //set the center of the map
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
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
                });
                map.setCenter(pos);
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
                if (status == 'ZERO_RESULTS') {
                    window.alert('Directions request failed due to ' + status);
                }
                directionsDisplay.setDirections(response);
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

