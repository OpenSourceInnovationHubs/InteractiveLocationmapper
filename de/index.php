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
        <h1>Wilkommen beim interaktiven Locationmapper<h1>
    </header>

    <div class="container instructions">
        <p>Bitte recherchieren sie unter
            <a href="https://www.data.gv.at/datasets?query=WFS+GetFeature&searchin=data&format=JSON"
                target="_blank">https://www.data.gv.at/</a> Standort-Daten (z.B. der Stadt Wien).
        </p>
        <p>Unter <strong>Distributionen</strong> klicken Sie bitte bei <strong>WFS GetFeature (JSON)</strong> auf <strong>Download</strong> und kopieren Sie die Adresse der URL <br>indem Sie mit der rechten Maustaste auf <i>Zugriff</i> klicken und <i><strong>Adresse des Links kopieren</strong></i> auswählen (siehe Abbildung unten).</p>
        <p><img src="images/wfs_GetFeature_DE.png" alt="Hilfestellung" width="900px"/></p>
        <p class="mt-3">Bitte fügen Sie den kopierten Link nun in das untenstehende Feld ein und klicken Sie auf <i><strong>Start</strong></i></p>


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
                <p><strong>Beispiele:</strong></p>
                <div class="btn-group-example">
                    <button type="button" class="btn btn-info" onclick="loadExample('universities')">Hochschulen in Wien</button>
                    <button type="button" class="btn btn-info" onclick="loadExample('pharmacies')">Apotheken in Wien</button>
                    <button type="button" class="btn btn-info" onclick="loadExample('council')">Gemeindebauwohnungen in Wien</button>
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