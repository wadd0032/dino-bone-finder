$(document).ready(function () {
  var $dinoList = $('.dinos li');

  // Create an object that sets up the Google Maps API
  var gmapOptions = {
    center : new google.maps.LatLng(45.423494,-75.697933)
    , zoom : 13
    , mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  // Create a variable to hold the GMap and add the GMap to the page
  var map = new google.maps.Map(document.getElementById('map'), gmapOptions);

  // Loop through all the places and add a marker to the GMap
  $dinoList.each(function (i, elem) {
    var dino = $(this).find('a').html();
    var lat = $(this).find('meta[itemprop="latitude"]').attr('content');
    var lng = $(this).find('meta[itemprop="longitude"]').attr('content');
    var pos = new google.maps.LatLng(lat, lng);
    var marker = new google.maps.Marker({
      position : pos
      , map : map
      , title : dino
      , animation: google.maps.Animation.DROP
    });
  });
});
