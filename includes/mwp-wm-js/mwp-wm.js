$(function(){
  var map,
      markerIndex = 0,
      markersCoords = {};

  if( $('input[name="mcoor_x"]').val() != '' && $('input[name="mcoor_y"]').val() ){
    var x = $('input[name="mcoor_x"]').val(),
        y = $('input[name="mcoor_y"]').val();
    // var markers = [x,y];
    console.log(x);
    var markers = [
            {latLng: [x, y]},
            // [0, 0],
          ];
  }

  map = new jvm.Map({
      map: 'world_mill_en',
      markerStyle: {
        initial: {
          fill: 'red'
        }
      },
      markers: markers,
      container: $('#map'),
      onMarkerTipShow: function(e, tip, code){
        map.tip.text(markersCoords[code].lat.toFixed(2)+' '+markersCoords[code].lng.toFixed(2));
      },
      onMarkerClick: function(e, code){
        map.removeMarkers([code]);
        map.tip.hide();
      },
      onRegionClick:function(event, code) {
        var name = map.getRegionName(code);                        
        // alert(name);   
        $('input[name="mcoor_country"]').val(name);
      }
  });

  $('#map').click(function(e, code){
    var x = e.pageX - map.container.offset().left,
        y = e.pageY - map.container.offset().top,
        latLng = map.pointToLatLng(x, y),
        targetCls = $(e.target).attr('id');

    if (latLng && (!targetCls || targetCls.indexOf('jvectormap-marker') === -1)) {
      markersCoords[markerIndex] = latLng;
      map.addMarker(markerIndex, {latLng: [latLng.lat, latLng.lng]});
      // markerIndex += 1;
    }
    $('input[name="mcoor_x"]').val(latLng.lat);
    $('input[name="mcoor_y"]').val(latLng.lng);
  });
  $('#map').bind('');
});

$('body').on('click', '.my_upl_button', function() {
  var currentInput = $(this).prev().attr('name');
    window.send_to_editor = function(html) {
      imgurl = $(html).attr('src')
      $('input[name="'+currentInput+'"]').val(imgurl);
      // $('#picsrc').attr("src",imgurl);
      // $('#'+currentInput).attr("src",imgurl);
      // $(this).find('#picsrc').attr("src",imgurl);
      tb_remove();
    }
    formfield = $('#my_image_URL').attr('name');
    tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
    return false;
});