<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Interactive Locationmapper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="index.css" />
</head>

<body>

    <header>
        <h1>Welcome to the Interactive Locationmapper</h1>
    </header>

    <div class="container instructions">
        <p>Please research location data at
            <a href="https://www.data.gv.at/datasets?query=WFS+GetFeature&searchin=data&format=JSON"
                target="_blank">data.gv.at</a> (e.g. for the City of Vienna).
        </p>
        <p>Under <strong>Distributions</strong>, and <strong>WFS GetFeature (JSON)</strong> click <strong>Download</strong><br> and copy the URL by
            right-clicking the link under <em>"Zugriff"</em> and selecting <strong>Copy Link Address</strong> in the context menu.</p>
        <img src="images/wfs_GetFeature_EN.png" alt="How to get the WFS URL">
        <p class="mt-3">Paste the link below and click <strong>Start</strong>.</p>
    </div>

    <div class="container form-section">
        <form action="map.php" method="post" id="location-form" class="text-center">
            <div class="mb-3">
                <label for="url_jsondata" class="form-label">URL:</label>
                <input type="url" class="form-control" id="url_jsondata" name="url_jsondata"
                    placeholder="https://www.data.gv.at/..." required>
            </div>

            <div class="d-flex justify-content-center gap-2">
                <button type="submit" class="btn btn-success">Start</button>
                <button type="button" id="resetBtn" class="btn btn-secondary">Reset</button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p><strong>Examples:</strong></p>
            <div class="btn-group-example">
                <button type="button" class="btn btn-info" onclick="loadExample('universities')">Universities in Vienna</button>
                <button type="button" class="btn btn-info" onclick="loadExample('pharmacies')">Pharmacies in Vienna</button>
                <button type="button" class="btn btn-info" onclick="loadExample('council')">Council housing (Gemeindebau)</button>
            </div>
        </div>
    </div>

    <script>
        const examples = {
            universities: "https://data.wien.gv.at/daten/geo?service=WFS&request=GetFeature&version=1.1.0&typeName=ogdwien:UNIVERSITAETOGD&srsName=EPSG:4326&outputFormat=json",
            pharmacies: "https://data.wien.gv.at/daten/geo?service=WFS&request=GetFeature&version=1.1.0&typeName=ogdwien:APOTHEKEOGD&srsName=EPSG:4326&outputFormat=json",
            council: "https://data.wien.gv.at/daten/geo?service=WFS&request=GetFeature&version=1.1.0&typeName=ogdwien:GEMBAUTENFLOGD&srsName=EPSG:4326&outputFormat=json"
        };

        function loadExample(type) {
            document.getElementById("url_jsondata").value = examples[type];
            document.getElementById("location-form").submit();
        }

        document.getElementById("resetBtn").addEventListener("click", () => {
            document.getElementById("url_jsondata").value = "";
        });
    </script>

</body>

</html>