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
        </div>
    </div>

    <div class="row justify-content-end align-items-start">
        <div class="card col-md-12">
            <div class="card-body">
                <div id="map"></div>
                <form method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" id="polygon_coordinates" name="polygon_coordinates">
                    <button type="submit" class="btn btn-primary">Save Polygon</button>
                    <button type="button" id="clear_button" class="btn btn-secondary">Clear Areas</button>
                </form>
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

            // Add event listener when the polygon is completed
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

            // Add event listener to clear button
            document.getElementById('clear_button').addEventListener('click', function() {
                clearAllShapes();
            });
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