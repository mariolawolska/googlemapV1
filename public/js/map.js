

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
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        gestureHandling: 'cooperative',
        center: {lat: parseFloat(beaches[0][1]), lng: parseFloat(beaches[0][2])}
    });

    var iconBase =
            'https://developers.google.com/maps/documentation/javascript/examples/full/images/';

    var icons = {
        parking: {
            icon: iconBase + 'parking_lot_maps.png'
        },
        library: {
            icon: iconBase + 'library_maps.png'
        },
        info: {
            icon: iconBase + 'info-i_maps.png'
        }
    };

    setMarkers(map, beaches);
}

// Data for the markers consisting of a name, a LatLng and a zIndex for the
// order in which these markers should display on top of each other.


function setMarkers(map, beaches) {

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
    // Shapes define the clickable region of the icon. The type defines an HTML
    // <area> element 'poly' which traces out a polygon as a series of X,Y points.
    // The final coordinate closes the poly by connecting to the first coordinate.
    var shape = {
        coords: [1, 1, 1, 20, 18, 20, 18, 1],
        type: 'poly'
    };
    for (var i = 0; i < beaches.length; i++) {
        var beach = beaches[i];
        var marker = new google.maps.Marker({
            position: {lat: parseFloat(beach[1]), lng: parseFloat(beach[2])},
            map: map,
            icon: image,
            shape: shape,
            title: beach[0],
            zIndex: beach[3]
        });
    }
}