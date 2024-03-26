<?php
/**
 * Block Name: Location
 *
 */

$pin_1 = get_field('pin_1');
?>

<div class="location map-all">
  <div class="container map-container">
    <div class="row">
      <div id="mapall" class="map-responsive"></div>
    </div>
  </div>
</div>

<script>
  function initMap() {
    var villakabaya = {
      info:
        '<div class="pin-maps">\
        <a target="_blank" href="https://goo.gl/maps/iPSroxnt1KYW857S7"><strong>Villa Kabaya</strong><br>\
        Tumbu, Karangasem, Karangasem Regency, <br>Bali 80811<br></a>\
        <a class="direction" target="_blank" href="https://goo.gl/maps/iPSroxnt1KYW857S7">Get Directions</a></div>',
      lat: <?php echo $pin_1['latitude'] ?>,
      long: <?php echo $pin_1['longitude'] ?>,
    }

    var locations = [
      [villakabaya.info, villakabaya.lat, villakabaya.long, 1, villakabaya.info]
    ];

    var map = new google.maps.Map(document.getElementById('mapall'), {
      zoom: 16,
      center: new google.maps.LatLng(<?php echo $pin_1['latitude'] ?>, <?php echo $pin_1['longitude'] ?>),
      styles: [
        {
          featureType: "administrative",
          elementType: "labels",
          stylers: [
            { visibility: "off" }
          ]
        }
      ]
    });

    var infowindow = new google.maps.InfoWindow();
    var infowindow2 = new google.maps.InfoWindow();
    var activewindow;

    var marker, i;

    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        title: "locations",
      });

      google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
          if(activewindow != null) { activewindow.close(); }
          infowindow.close();
          infowindow2.setContent(locations[i][0]);
          infowindow2.open(map, marker);
          activewindow = infowindow;
        }
      })(marker, i));

      google.maps.event.addListener(marker, 'mouseout', function() {
        infowindow2.close();
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          if(activewindow != null) { activewindow.close(); }
          infowindow2.close();
          infowindow.setContent(locations[i][4]);
          infowindow.open(map, marker);
          //infowindow.open( this.url,'_blank');
          activewindow = infowindow;
        }
      })(marker, i));
    }
  }

</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4xEwqsg13xVpLvP5lqd6CAH7A_xa9JGc&callback=initMap"></script>
