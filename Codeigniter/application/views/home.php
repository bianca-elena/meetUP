<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }

      body {
      background-color: #B8D4FF;
      }

      ul#menu li a:link,a:visited
      {
        width : 100px;
        display:block;
        border-radius : 7px;
        color:#FFFFFF;
        background-color:#6A91D4;
        border-width: 2px;
        border-color: #7EA1DE;
        text-align:center;
        padding:4px;
        text-decoration:none;
        text-transform:uppercase;
        margin-bottom: 5px;
      }

      ul#menu li#logout{
        width:100px;
        border-radius : 7px;
        color:#FFFFFF;
        background-color:#6A91D4;
        border-width: 2px;
        border-color: #7EA1DE;
        text-align:center;
        padding:4px;
        text-decoration:none;
        text-transform:uppercase;
        margin-bottom: 5px; 
      }

      #left {
        float: left;
        width: 180px;
        margin: auto;
      }

      #left ul li {
        list-style: none;
      }

      #map-canvas {
         margin: auto;
         max-width : 1450px;
         max-height: 850px;
         border-radius: 20px;
         border-color : #000066 ;
         border-width: 2px;
         border-style:inset;

      }

    </style>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
        var map;
        var browserSupportFlag =  new Boolean();
        var astorPlace = new google.maps.LatLng(40.729884, -73.990988);
        var siberia = new google.maps.LatLng(60, 105);
        var newyork = new google.maps.LatLng(40.69847032728747, -73.9514422416687);
        var initialLocation;

        function initialize() {

          // Set up the map
          var mapOptions = {
            center: astorPlace,
            zoom: 15
          };
         
          map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);


          google.maps.event.addDomListener(window, "resize", function() {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center); 
          });


          if(navigator.geolocation) {
                     
                       browserSupportFlag = true;
                       
                       navigator.geolocation.getCurrentPosition(function(position) {
                       
                       CurentLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                       
                       map.setCenter(CurentLocation);
                       
                       var vmarker = new google.maps.Marker({
                                    position: CurentLocation,
                                    map: map,
                                    draggable:false,
                                    animation: google.maps.Animation.DROP,
                                    title : "Locatie curenta"
                          });
                      vmarker.setIcon('http://maps.google.com/mapfiles/ms/icons/purple-dot.png');

                    }, function() {handleNoGeolocation(browserSupportFlag);});
                 }

                  // Browser doesn't support Geolocation
                
                   else {
                          browserSupportFlag = false;
                          handleNoGeolocation(browserSupportFlag);
                        }

                  function handleNoGeolocation(errorFlag) {

                    if (errorFlag == true) {
                      alert("Geolocation service failed.");
                      CurentLocation = newyork;
                    } 
                    else {
                      alert("Your browser doesn't support geolocation. We've placed you in Siberia.");
                      CurentLocation = siberia;
                    }
                    
                     map.setCenter(CurentLocation);
                  
                  }

                  panorama = map.getStreetView();
                  
                  var panoOptions = {
                      position: CurentLocation,
                      visible: true
                        };

                  panorama.setOptions(panoOptions);
                  panorama.setPov(/** @type {google.maps.StreetViewPov} */({
                                          heading: 265,
                                          pitch: 0
                                          }));
        }

        function toggleStreetView() {
              var toggle = panorama.getVisible();
              if (toggle == false) {
                panorama.setVisible(true);
              } else {
                panorama.setVisible(false);
              }
            }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>

<body>
  <div id="left">
    <h2 style="font-size:16px; text-align:center;">Bine ai venit,</h2>
    <h2 style="font-size:16px; margin-top: -15px; text-align:center;"> <?php echo $user ?></h2>
    <ul id="menu">
      <li><a id="logout" href="<?php echo site_url('user/logout');?>">Logout</a></li>

      <?php foreach($results as $result){ ?>
      <li><a href="<?php echo site_url('user/locations/'.$result['type']);?>" > <?php echo $result['type']; ?></a></li>
      <?php } ?>
    </ul>
    <h2 style="font-size:16px; margin-top:10px; text-align:center;">Lista prieteni</h2>
    <ul>
      <?php
      foreach ($list_friends['data'] as $friend) {
        echo '<li>'.$friend['name'].'</li>';
      }
      ?>
    </ul>
  </div>
    <div id="map-canvas"></div>
</body>

</html>