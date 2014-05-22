<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>meetUP Home</title>
    <style>
      body{
        background-color:  #0099ff;
      }

      #wrapper {
        width : auto;
        height: 100%; 
        margin: 0 auto;
      }

      #map-canvas {
         float: right;
         width : 1050px;
         height: 100%;
         border-radius: 20px;
         border-color : #000066;
         border-width: 2px;
         border-style:inset;
      }

      #leftPanel {
        float: left;
        width: 250px;
        height: 100%;
      }

      #tabs{
        float: left;
        width: 50px;
        height: 100%;
        background-color: white;
      }

      #tab {

      }

      #dynamic_content {
        float: right;
        width: 200px;
        height: 100%;
        background-color: white ;
      }

      #logout{
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
        margin-top : 5px;
        margin-right : 15px;
        margin-left: 1240px;
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

<body onload="init()">
    <div id = "wrapper">
        <div id="leftPanel">
            <div id="tabs">
                <div id="tab" >
                    <a id="feed" href="#" onclick="selectTab(this); return false;">Feed</a>
                </div>
                <div id="tab" >
                    <a id="loc" href="#" onclick="selectTab(this); return false;">Locations</a>
                </div>
                <div id="tab" >
                    <a id="friends" href="#" onclick="selectTab(this); return false;">Friends</a>
                </div>
                <div id="tab" >
                    <a href="<?php echo site_url('user/logout');?>">Logout</a>
                </div>
            </div>
            <div id="dynamic_content">
                <div id="newfeed">
                    <p  id="feed_content" >FEED AICI</p>
                </div>
                <div id="newlocations">
                    <p  id="loc_content" style ="display: none;" >LOCATION AICI</p>
                </div>
                <div id="newfriends">
                    <p  id="friends_content" style ="display: none;" >FRIENDLIST</p>
                </div>
            </div>
        </div>
        <div id="map-canvas"></div>
    </div>

  <script type="text/javascript">
                var selectedTabColor = "#006887";   
                var selectedTabBackgroundColor = "#0086d1";

                var tabDefaultColor = " #00a0e9";
                var tabDefaultBackgroundColor = null;

                var selectedTab = null;

                function init() {
                    var defaultSelectedTab = document.getElementById("feed");
                    selectTab(defaultSelectedTab);
                }

                function selectTab(tab) {
                    
                    if (selectedTab != tab) {
                    
                        var content = null;
                        var selectedTabContent = null;
                        
                        if (selectedTab) {
                            selectedTab.style.color = tabDefaultColor;
                            selectedTab.style.backgroundColor = tabDefaultBackgroundColor;
                            
                            content = selectedTab.id + "_content";
                            selectedTabContent = document.getElementById(content);
                            selectedTabContent.style.display = "none";
                        }
                    
                        selectedTab = tab;
                        selectedTab.style.color = selectedTabColor;
                        selectedTab.style.backgroundColor = selectedTabBackgroundColor;
                        
                        content = selectedTab.id + "_content";
                        selectedTabContent = document.getElementById(content);
                        selectedTabContent.style.display = "block";
                    }
                    
                }
        </script>
</body>

</html>