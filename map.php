<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Interactive Locationmapper</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="map.css" />
    <link rel="stylesheet" type="text/css" href="leaflet.css" />
</head>

<body>
    <header>
        <h1 class="h4 mb-0"><a href="./">Interactive Locationmapper</a></h1>
    </header>

    <!-- Form toolbar -->
    <div class="container-fluid toolbar">
        <form id="mapForm" action="map.php" method="post" class="d-flex flex-wrap justify-content-center gap-2">
            <label for="url_jsondata" class="visually-hidden">WFS JSON URL:</label>
            <input
                type="url"
                name="url_jsondata"
                id="url_jsondata"
                class="form-control"
                style="max-width: 680px;"
                placeholder="https://www.data.gv.at/..."
                required />
            <button type="submit" class="btn btn-success">Start</button>
            <button type="button" id="resetBtn" class="btn btn-secondary">Reset</button>
        </form>
    </div>

    <!-- Map -->
    <div id="map" style="width: 100%; height: 80vh;"></div>

    <!-- Map navigation buttons -->
    <div class="container mt-3 text-center">
        <div class="btn-group-map">
            <button class="btn btn-outline-primary" onclick="history.back()">Back</button>
            <button class="btn btn-outline-primary" onclick="history.forward()">Forward</button>
        </div>
        <p id="demo" class="text-muted small"></p>
    </div>

    <!-- Scripts -->
    <script src="leaflet.js"></script>
    <script src="maplayers.js"></script>

    <script>
        <?php if (isset($_POST['url_jsondata']) && !empty($_POST['url_jsondata'])): ?>
            // Initialize Leaflet map
            const map = L.map("map", {
                layers: [osmMap],
                zoomControl: true,
            }).setView([48.240326, 16.373], 14);

            L.control.layers(baseLayers).addTo(map);
            L.control.scale().addTo(map);

            // Custom style for features
            const myStyle = {
                color: "#ff7800",
                weight: 4,
                opacity: 0.8,
            };
            // Load GeoJSON data from PHP form post using fetch()
            const dataUrl = "<?php echo $_POST['url_jsondata']; ?>";

            if (dataUrl) {
                fetch(dataUrl)
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then((data) => {
                        const layer = L.geoJson(data, {
                            style: myStyle,
                            onEachFeature: function(feature, layer) {
                                let rows = "";
                                const p = feature.properties || {};

                                for (const key in p) {
                                    if (Object.prototype.hasOwnProperty.call(p, key)) {
                                        let value = String(p[key]);
                                        const maxLen = 50;

                                        if (value.includes("http")) {
                                            const shortVal = value.length > maxLen ? value.slice(0, maxLen) + "..." : value;
                                            rows += `<tr><td><b>${key}:</b> <a href="${p[key]}" target="_blank">${shortVal}</a></td></tr>`;
                                        } else {
                                            rows += `<tr><td><b>${key}:</b> ${value}</td></tr>`;
                                        }
                                    }
                                }

                                const popupContent = `<table class="table table-sm table-borderless mb-0">${rows}</table>`;
                                layer.bindPopup(popupContent);
                            },
                        }).addTo(map);
                    })
                    .catch((error) => {
                        console.error("Failed to load GeoJSON data from the provided URL.", error);
                    });
            }
        <?php else: ?>
            setTimeout(function() {
                const mapDiv = document.getElementById('map');
                mapDiv.style.textAlign = 'center';
                mapDiv.innerHTML = '<span style="color: red; font-weight: bold;">Please enter a URL to a valid GeoJSON file!</span>';
            }, 1000);
        <?php endif; ?>

        // Reset button clears URL field
        document.getElementById("resetBtn").addEventListener("click", () => {
            document.getElementById("url_jsondata").value = "";
        });

        // Optional: Show user location coordinates (if supported)
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                document.getElementById("demo").textContent =
                    "Geolocation not supported by this browser.";
            }
        }

        function showPosition(position) {
            document.getElementById("demo").innerHTML =
                `Latitude: ${position.coords.latitude}<br>Longitude: ${position.coords.longitude}`;
        }
    </script>
</body>

</html>