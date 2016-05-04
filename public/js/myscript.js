$(document).ready(function(){

  $LAT = $("input[name='lat']");
  $LNG = $("input[name='lng']");

  navigator.geolocation.getCurrentPosition(function(data) {
      $LAT.val(data['coords']['latitude']);
      $LNG.val(data['coords']['longitude']);

      console.log(data['coords']['latitude']);
  });

  /* copy loaded thumbnails into carousel */
  $('.row .thumbnail').on('load', function() {}).each(function(i) {
    if(this.complete) {
      var item = $('<div class="item"></div>');
      var itemDiv = $(this).parents('div');
      var title = $(this).parent('a').attr("title");
      
      item.attr("title",title);
      $(itemDiv.html()).appendTo(item);
      item.appendTo('.carousel-inner'); 
      if (i==0) item.addClass('active');
    }
  });

  /* activate the carousel */
  $('#modalCarousel').carousel({interval:false});

  /* change modal title when slide changes */
  $('#modalCarousel').on('slid.bs.carousel', function () {
    $('.modal-title').html($(this).find('.active').attr("title"));
  })

  /* when clicking a thumbnail */
  $('.row .thumbnail').click(function(){
      var idx = $(this).parents('div').index();
      var id = parseInt(idx);
      $('#myModal').modal('show'); // show the modal
      $('#modalCarousel').carousel(id); // slide carousel to selected
      
  });

});

function getVenues(){
  var SEARCH = $("input[name='search']").val();
  var CLIENT_ID = 'WSRYQDSEQRXM3DVLGR35LUQLIDTHZZZHKN4WSY55B2DB0ESO';
  var CLIENT_SECRET = 'VTRS3PHDSPYOWXO4NDBPAUTBR243X1B5MRT5L0DKLSO5QFFK';
  var API_ENDPOINT = 'https://api.foursquare.com/v2/venues/search' +
    '?client_id=CLIENT_ID' +
    '&client_secret=CLIENT_SECRET' +
    '&v=20130815' +
    '&ll=LATLON' +
    '&query=' + SEARCH +
    '&callback=?';

  $.getJSON(API_ENDPOINT
    .replace('CLIENT_ID', CLIENT_ID)
    .replace('CLIENT_SECRET', CLIENT_SECRET)
    .replace('LATLON', $LAT.val() + ',' + $LNG.val()), 
    function(result, status) {
      if (status !== 'success') return alert('Request to Foursquare failed');
      $("#new-search").empty();
      for (var i = 0; i < result.response.venues.length; i++) {
          var venue = result.response.venues[i];

          getAndSavePics({'search':SEARCH, 'name':venue.name , 'lat':venue.location.lat, 'lng':venue.location.lng});
      }     
  });
}

function getAndSavePics(request_data){
  $.post('/immedia_test/public/pic', request_data, function(data) {
    $.each(data, function(i){
        if(i>5) return;
        $("#new-search").append('<div class="col-lg-3 col-sm-4 col-xs-6"><a title=" ' + 
          this.caption + '" href="#'+ 
          this.id +'"><img class="thumbnail img-responsive" src="' + 
          this.link + '"></a></div> '); 
    });  
  });
}