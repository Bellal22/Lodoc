<?php
session()->regenerate();
if(Session('id')==null){
        echo "ليس لديك الصلاحيات للدخول على تلك الصفحة";
}else{
?>

@include('layout.head')
@include('clinic.barsClinic')
<div id="page-wrapper">
    <div id="app">
   
    
     
    <div id="map" style="width:1000px; height:530px; margin-top:10px">
    </div>
    <br>
    <form class="form-inline" method="post" action="#">
    {{csrf_field()}}
  
  <div class="form-group mx-sm-3 mb-2">
    
    <input type="text" class="form-control" id="lng"  onclick="toggleBounce(event)" readonly name="longr" placeholder="lng">
  
  </div>
  <div class="form-group mx-sm-3 mb-2">
    
    <input type="text" class="form-control" id="lat" placeholder="lat" onclick="toggleBounce(event)" readonly name="latr">
  </div>
  <button type="submit" class="btn btn-primary mb-2">ادخال</button>
</form>

    </div>
    
    <?php

    if($db==null){
    ?>
    <script>

// The following example creates a marker in Stockholm, Sweden using a DROP
// animation. Clicking on the marker will toggle the animation between a BOUNCE
// animation and no animation.

var marker;

 var lo=document.getElementById('getlog').value;
 var la=document.getElementById('getlat').value;

 console.log(ll);
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: {lat: 18.916680, lng:  11.489510}
  });

  marker = new google.maps.Marker({
    map: map,
    draggable: true,
    animation: google.maps.Animation.DROP,
    position: {lat: 18.916680, lng:  11.489510}
  });
  marker.addListener('click', toggleBounce);
}

function toggleBounce(event) {
  console.log(event.latLng.lng());
  console.log(event.latLng.lat());
  document.getElementById("lng").value = event.latLng.lng() ;
  document.getElementById("lat").value = event.latLng.lat() ;
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

//  ;
AIzaSyAiv-omklrridg8qsNcG_HDQZ_R4PqitXo
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkfAwoXIKThbzY5EMAJ46Q79f3yC-oSqI&callback=initMap">
</script>
<?php
    }
    else{
?>
<script>

// The following example creates a marker in Stockholm, Sweden using a DROP
// animation. Clicking on the marker will toggle the animation between a BOUNCE
// animation and no animation.

var marker;

 var lo=document.getElementById('getlog').value;
 var la=document.getElementById('getlat').value;

 console.log(ll);
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: {lat: {{$db->lat}}, lng:  {{$db->long}}}
  });

  marker = new google.maps.Marker({
    map: map,
    draggable: true,
    animation: google.maps.Animation.DROP,
    position: {lat: {{$db->lat}}, lng: {{$db->long}}}
  });
  marker.addListener('click', toggleBounce);
}

function toggleBounce(event) {
  console.log(event.latLng.lng());
  console.log(event.latLng.lat());
  document.getElementById("lng").value = event.latLng.lng() ;
  document.getElementById("lat").value = event.latLng.lat() ;
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

//  ;
AIzaSyAiv-omklrridg8qsNcG_HDQZ_R4PqitXo
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkfAwoXIKThbzY5EMAJ46Q79f3yC-oSqI&callback=initMap">
</script>
<?php
    }
?>
  </body>
</html>

@include('layout.footer')
<script src={{asset("js/adminpanel.js")}}></script>
<?php
}
?>