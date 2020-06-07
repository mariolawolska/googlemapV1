<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div id="map" ></div>
</div>

<script>
    $(function () {
        var mapId = $(this).attr('mapId');
        $.ajax({
            type: "PUT",
            url: "/public/getNearBy",
            data: {
                "_token": "{{ csrf_token() }}",
                'mapId': mapId
            },
            beforeSend: function () {
            },
            success: function (data) {
                var beaches = JSON.parse(data);
                initMap(beaches);
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
        $('#ajaxModel').modal('show');
    });


    function initMap(beaches) {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            center: {lat: parseFloat(beaches[0][1]), lng: parseFloat(beaches[0][2])}
        });
        setMarkers(map, beaches);
    }

    function setMarkers(map, beaches) {

        var image = {
            url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
            size: new google.maps.Size(20, 32),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(0, 32)
        };

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
</script>