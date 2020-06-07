

window.onload = $(function () {

    $.ajax({
        type: "PUT",
        url: "/public/getNearBy",
        data: {
        },
        beforeSend: function () {
//                    $('#loaderBox').modal('show');
        },
        success: function (data) {
            var beaches = JSON.parse(data);
            $("#ajaxModel").html(initMapV2(beaches));

        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
    var addressText = 'Address: ';
//        $('.map_address_' + mapId).each(function (index) {
//            if ($(this).text() != '') {
//                addressText += $(this).text();
//            }
//        });
    $('#modelHeading').html(addressText);
});
// The following example creates complex markers to indicate beaches near
// Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
// to the base of the flagpole.


function initMap() {

}
function initMapV2(beaches) {



    var mapOptions = {
        center: new google.maps.LatLng(parseFloat(beaches[0][1]), parseFloat(beaches[0][2])),
        gestureHandling: 'cooperative'

    };

    var map = new google.maps.Map(document.getElementById('map'), mapOptions);


    setMarkers(map, beaches);
}

// Data for the markers consisting of a name, a LatLng and a zIndex for the
// order in which these markers should display on top of each other.


function setMarkers(map, beaches) {


    var labels = '#12345';
    var labelIndex = 0;
    // Adds markers to the map.

    // Marker sizes are expressed as a Size of X,Y where the origin of the image
    // (0,0) is located in the top left of the image.

    // Origins, anchor positions and coordinates of the marker increase in the X
    // direction to the right and in the Y direction down.
    var image = {
        url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
        // This marker is 20 pixels wide by 32 pixels high.
        size: new google.maps.Size(20, 32),
        // The origin for this image is (0, 0).
        origin: new google.maps.Point(0, 0),
        // The anchor for this image is the base of the flagpole at (0, 32).
        anchor: new google.maps.Point(0, 32)
    };

    var markerBounds = new google.maps.LatLngBounds();
    
    for (var i = 0; i < beaches.length; i++) {
        var beach = beaches[i];

        position = new google.maps.LatLng(parseFloat(beach[1]), parseFloat(beach[2])),
                               
                new google.maps.Marker({
                    map: map,
                    position: position,
                    title: beach[0],
                    zIndex: beach[3],
                    label: labels[labelIndex++ % labels.length],
                    animation: google.maps.Animation.Drop
                });

        markerBounds.extend(position);
    }
    map.fitBounds(markerBounds);
}
