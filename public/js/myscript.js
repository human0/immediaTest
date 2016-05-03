//$(function(){

var CLIENT_ID = 'WSRYQDSEQRXM3DVLGR35LUQLIDTHZZZHKN4WSY55B2DB0ESO';
var CLIENT_SECRET = 'VTRS3PHDSPYOWXO4NDBPAUTBR243X1B5MRT5L0DKLSO5QFFK';
var SEARCH = "hotel";
var API_ENDPOINT = 'https://api.foursquare.com/v2/venues/search' +
  '?client_id=CLIENT_ID' +
  '&client_secret=CLIENT_SECRET' +
  '&v=20130815' +
  '&ll=LATLON' +
  '&query=' + SEARCH +
  '&callback=?';


$LAT = $("input[name = 'lat']");
$LNG = $("input[name = 'lng']");;

navigator.geolocation.getCurrentPosition(function(data) {
    $LAT.val(data['coords']['latitude']);
    $LNG.val(data['coords']['longitude']);
});

function getVenues(){
  $.getJSON(API_ENDPOINT
    .replace('CLIENT_ID', CLIENT_ID)
    .replace('CLIENT_SECRET', CLIENT_SECRET)
    .replace('LATLON', $LAT.val() + ',' + $LNG.val()), 
    function(result, status) {
      if (status !== 'success') return alert('Request to Foursquare failed');
      if (result.response.venues.length < 1) return;
      var request_data = {};

      for (var i = 0; i < result.response.venues.length; i++) {
          var venue = result.response.venues[i];

          request_data[i] = {'search':SEARCH, 'name':venue.name , 'lat':venue.location.lat, 'lng':venue.location.lng};
      }

      getAndSavePics(request_data);
  });
}
function getAndSavePics(request_data){
  $.post('/immedia_test/public/pic', {'data':request_data},function(data) {
    each(data, function(){
        $("#new-search").append('<li>' + '<img scr="' + this.link + '">' +  this.name + ' (' + this.caption + ')</li>');
      });
    });
}