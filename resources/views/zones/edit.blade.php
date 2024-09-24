<x-master-layout>
    <style>
        #map {
            height: 500px;
            /* Set the height */
            width: 100%;
            /* Set the width to 100% */
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">المناطق </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('zone.update', $zone->id) }}">
                            @csrf

                            <!-- Input field for zone name -->
                            <div class="form-group">
                                <label for="name">اسم المنطقة</label>
                                <input class="form-control" type="text" value="{{ $zone->name }}" id="name" name="name" required>
                            </div>
                            <!-- Non-editable input field to display selected points -->
                            <div class="form-group">
                                <label for="coordinates">نقاط المنطقة </label>
                                <input type="text" class="form-control" id="polygon_coordinates" name="coordinates" value="{{ $zone->coordinates }}" readonly>
                            </div>

                            <div id="map" class="my-3" style="height: 400px;"></div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Save Polygon</button>
                                <button type="button" id="clear_button" class="btn btn-secondary">Clear Areas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUO0qLxbHg-sN2htKQmuLH_NWG1Mg0IDI&libraries=drawing,places&v=3.45.8"></script>
    <script>
        let map;
        let drawingManager;
        let selectedShape;
        let polygonCoordinates = [];
        let allShapes = []; // Array to store all drawn shapes
        let existingPolygonCoordinates = <?= json_encode($zone->coordinates) ?>;

        function initMap() {
            // Initialize the map
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 30.033333,
                    lng: 31.233334
                }, // Cairo coordinates
                zoom: 12,
            });

            // Initialize the Drawing Manager
            drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: ['polygon'],
                },
                polygonOptions: {
                    fillColor: '#ffff00',
                    fillOpacity: 0.5,
                    strokeWeight: 2,
                    clickable: true,
                    editable: true,
                    zIndex: 1,
                },
            });
            drawingManager.setMap(map);

            // Draw the existing polygon if coordinates exist
            if (existingPolygonCoordinates.length > 0) {
                let existingPolygon = new google.maps.Polygon({
                    paths: JSON.parse(existingPolygonCoordinates),
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                    editable: true,
                });
                existingPolygon.setMap(map);
                selectedShape = existingPolygon;
                allShapes.push(existingPolygon);

                // Set up event listener to handle edits on existing polygon
                google.maps.event.addListener(existingPolygon.getPath(), 'set_at', updateCoordinates);
                google.maps.event.addListener(existingPolygon.getPath(), 'insert_at', updateCoordinates);

                // Save the coordinates
                polygonCoordinates = existingPolygon.getPath().getArray().map(function(latLng) {
                    return {
                        lat: latLng.lat(),
                        lng: latLng.lng()
                    };
                });
                document.getElementById('polygon_coordinates').value = JSON.stringify(polygonCoordinates);
            }

            // Event listener for drawing new polygon
            google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                if (event.type === 'polygon') {
                    if (selectedShape) {
                        selectedShape.setMap(null); // Remove the previous polygon
                    }

                    selectedShape = event.overlay;
                    allShapes.push(selectedShape); // Store the new shape

                    polygonCoordinates = selectedShape.getPath().getArray().map(function(latLng) {
                        return {
                            lat: latLng.lat(),
                            lng: latLng.lng()
                        };
                    });

                    // Save coordinates in the hidden form input
                    document.getElementById('polygon_coordinates').value = JSON.stringify(polygonCoordinates);
                }
            });

            // Clear all shapes
            document.getElementById('clear_button').addEventListener('click', function() {
                clearAllShapes();
            });
        }

        function updateCoordinates() {
            polygonCoordinates = selectedShape.getPath().getArray().map(function(latLng) {
                return {
                    lat: latLng.lat(),
                    lng: latLng.lng()
                };
            });
            document.getElementById('polygon_coordinates').value = JSON.stringify(polygonCoordinates);
        }

        function clearAllShapes() {
            for (let i = 0; i < allShapes.length; i++) {
                allShapes[i].setMap(null); // Remove each shape from the map
            }
            allShapes = []; // Clear the array of shapes
            document.getElementById('polygon_coordinates').value = ''; // Clear the hidden input
        }

        // Initialize the map when the window loads
        window.onload = initMap;
    </script>
</x-master-layout>