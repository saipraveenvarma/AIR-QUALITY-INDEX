<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AQI</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        #header {
            width: 100%;
            background-color: white;
            color: black;
            text-align: center;
            padding: 10px 0;
            font-size: 24px;
            font-weight: bold;
        }

        #content {
            display: flex;
            height: calc(100% - 50px);
        }

        #map {
            width: 75%;
            height: 100%;
        }

        #marker-info-container {
            width: 25%;
            height: 100%;
            display: flex;
            flex-direction: column;
            background-color: #f0f0f0;
            overflow-y: auto;
            padding: 10px;
            transition: background-color 0.3s ease;
        }

        .marker-info-box {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin: 10px;
            height: 100%;
        }

        .marker-info-box:last-child {
            border-bottom: none;
        }

        .marker-info-box h2 {
            margin-top: 0;
        }

        .marker-info-box p {
            margin-top: 5px;
            margin-bottom: 5px;
        }



        .custom-marker {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .aqi-value {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            color: white;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #000000;
        }

        .aqi-color-wrapper {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            /* Align items to the left */
            margin-left: 60%;
        }

        .aqi-color {
            height: 20px;
            width: 100px;
            /* Adjust width as needed */
            border-radius: 3px;
            display: flex;
            justify-content: flex-end;
            /* Align content to the right within the box */
            align-items: center;
            color: white;
            /* Ensure text color is visible against background */
            padding-right: 10px;
            /* Add padding to the right side to position text */
            box-sizing: border-box;
            /* Ensure padding is included in the width */
        }
        .aqi-color1 {
    height: 30px; /* Adjust height to match the circle diameter */
    width: 30px; /* Adjust width to match the circle diameter */
    border-radius: 50%; /* Make it a circle with 50% border-radius */
    display: flex;
    justify-content: center; /* Center content horizontally */
    align-items: center; /* Center content vertically */
    color: white; /* Text color */
    background-color: #4CAF50; /* Example background color */
}


        .aqi-color span {
            text-align: right;
            /* Align text to the right within the box */
        }



        .aqi-bar {
            width: 100%;
            height: 10px;
            background: linear-gradient(to right,
                    rgb(71, 155, 85) 0%,
                    rgb(134, 206, 0) 20%,
                    rgb(246, 249, 38) 40%,
                    rgb(255, 150, 22) 60%,
                    rgb(251, 13, 13) 80%,
                    rgb(175, 0, 56) 100%);
            border-radius: 5px;
            margin-top: 5px;
            position: relative;
        }

        .aqi-bar-inner {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            border-radius: 5px;
            transition: width 0.3s ease-in-out;
        }

        .aqi-scale {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }

        .aqi-point {
            position: absolute;
            top: -15px;
            transform: translateX(-50%);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .aqi-point::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 1px;
            height: calc(100% - 10px);
            background-color: black;
        }
        .separator {
        width: 100%;
        border: none;
        border-top: 1px solid #ddd;
        margin: 10px 0; /* Adjust margin for spacing */
    }
    
    </style>
</head>

<body>
    <div id="header">AQI</div>
    <div id="content">
        <div id="marker-info-container">
            <div class="marker-info-box" id="marker-info">
                <div id="marker-station" style="position: absolute; top: 0; right: 0; margin: 10px;">${data.station}
                </div>
                <div class="aqi-color-wrapper ${getAQISizeClass(data.airQualityIndexValue)}">
                    <div class="aqi-color"
                        style="background-color: ${aqiColor}; display: flex; align-items: center; position: absolute; right: 0; margin: 10px;">
                        <span>${aqiText}</span>
                    </div>
                    <p><b></b> <span id="lastupdate">${data.lastupdate}</span></p>


                </div>
                <p style="display: flex; align-items: center;">
                    <b><i class="fa fa-thermometer-half" aria-hidden="true"></i> <span id="max-value"
                            style="margin-left: 5px;">${data.max}</span></b>
                    <b style="margin-left: 20px;"><i class="fa-solid fa-droplet"></i> <span id="min-value"
                            style="margin-left: 5px;">${data.min}</span></b>
                </p>


                <p><b>Air Quality Index:</b> <span id="airQualityIndexValue">${data.airQualityIndexValue}</span></p>



            </div>
            <div class="marker-info-box" id="empty-box-1">

            </div>
            <div class="marker-info-box2" id="empty-box-2"></div>
        </div>
        <div id="map"></div>
    </div>

    <script>
        var map = L.map('map').setView([20.5937, 78.9629], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var weatherData = <?php echo json_encode($weather_data); ?>;
        console.log("Weather Data:", weatherData);

        function updateMarkerInfo(data) {
            document.getElementById('marker-station').textContent = data.station;
            document.getElementById('max-value').textContent = data.max;
            document.getElementById('min-value').textContent = data.min;
            document.getElementById('lastupdate').textContent = data.lastupdate;
            document.getElementById('airQualityIndexValue').textContent = data.airQualityIndexValue;

            var aqiColor = getColor(data.airQualityIndexValue);
            var aqiText = getAQIText(data.airQualityIndexValue);
            var aqiTextwarning = getAQITextwarning(data.airQualityIndexValue);

            var mainContainer = document.getElementById('marker-info-container');
            mainContainer.style.backgroundColor = aqiColor;
            mainContainer.innerHTML = `
        <div class="marker-info-box">
            <div id="marker-station">${data.station}</div>
           <div class="aqi-color-wrapper">
    <div class="aqi-color" style="background-color: ${aqiColor};">
        <span>${aqiText}</span>
    </div>
    <p style="margin-top: 5px;"><span id="lastupdate">${data.lastupdate}</span></p>
</div>

         <p style="display: flex; align-items: center;margin-top: -39px;">
    <b><i class="fa fa-thermometer-half" aria-hidden="true"></i> <span id="max-value" style="margin-left: 5px;">${data.max}</span></b>
    <b style="margin-left: 20px;"><i class="fa-solid fa-droplet"></i> <span id="min-value" style="margin-left: 5px;">${data.min}</span></b>
</p>

            <div style="    font-size: 89px;margin-left: 25%;"><span id="airQualityIndexValue">${data.airQualityIndexValue}</span></div>
            <!-- AQI Bar -->
            <div class="aqi-bar">
                <div class="aqi-bar-inner" style="width: ${getAQIBarWidth(data.airQualityIndexValue)};"></div>
                <div class="aqi-point" id="aqi-point" style="left: ${getAQIPointPosition(data.airQualityIndexValue)}; background-color: ${aqiColor};"></div>
            </div>
            <!-- End AQI Bar -->

            <!-- AQI Scale -->
            <div class="aqi-scale">
                <span>0</span>
                <span>50</span>
                <span>100</span>
                <span>150</span>
                <span>200</span>
                <span>300</span>
                <span>400</span>
                <span>500</span>
            </div>
            <!-- End AQI Scale -->

  <hr class="separator" />
  <div style="display: flex; align-items: center;">
    <div class="aqi-color1" style="background-color: ${aqiColor}; width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;"></div>
    <span>${aqiTextwarning}</span>
</div>

  <hr class="separator" />

                    <div class="marker-info-box" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;height: 21%;">
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; padding: 10px; border: 1px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 30%; background-color: white;">                            <span style="font-size: 1.5em;">${getAvgValue('PM2.5', data)}</span>
                            <b>PM2.5</b>
                        </div>
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; padding: 10px; border: 1px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 30%; background-color: white;">                            <span style="font-size: 1.5em;">${getAvgValue('PM10', data)}</span>
                            <b>PM10</b>
                        </div>
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; padding: 10px; border: 1px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 30%; background-color: white;">                            <span style="font-size: 1.5em;">${getAvgValue('NO2', data)}</span>
                            <b>NO2</b>
                        </div>
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; padding: 10px; border: 1px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 30%; background-color: white;">                            <span style="font-size: 1.5em;">${getAvgValue('CO', data)}</span>
                            <b>CO</b>
                        </div>
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; padding: 10px; border: 1px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 30%; background-color: white;">                            <span style="font-size: 1.5em;">${getAvgValue('SO2', data)}</span>
                            <b>SO2</b>
                        </div>
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; padding: 10px; border: 1px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 30%; background-color: white;">                            <span style="font-size: 1.5em;">${getAvgValue('O3', data)}</span>
                            <b>O3</b>
                        </div>
                </div>
  
    
   
    `;
        }

        function getAvgValue(indexid, data) {
            var avgData = weatherData.find(item => item.station === data.station && item.indexid === indexid);
            return avgData ? avgData.avg : 'N/A';
        }




        function getColor(aqi) {
            if (isNaN(aqi) || aqi === 'NA') {
                return "#000000"; // Black color for NA or undefined values
            }
            if (aqi <= 50) return "#479B55";
            if (aqi <= 100) return "#86ce00";
            if (aqi <= 200) return "#F6F926";
            if (aqi <= 300) return "#FF9616";
            if (aqi <= 400) return "#FB0DOD";
            return "#AF0038";
        }

        function getAQIText(aqi) {
            if (isNaN(aqi) || aqi === 'NA') return "NA"; // Handle 'NA' or undefined values
            if (aqi <= 50) return "Good";
            if (aqi <= 100) return "Satisfactory";
            if (aqi <= 200) return "Moderate";
            if (aqi <= 300) return "Poor";
            if (aqi <= 400) return "Very Poor";
            return "Severe";
        }

        function getAQITextwarning(aqi) {
            if (aqi <= 50) return 'Air quality is considered satisfactory, and air pollution poses little or no risk';
            if (aqi <= 100) return 'Air quality is acceptable; however, there may be some pollution for some pollutants for sensitive people';
            if (aqi <= 150) return 'Members of sensitive groups may experience health effects. The general public is not likely to be affected.';
            if (aqi <= 200) return 'Everyone may begin to experience health effects; members of sensitive groups may experience more serious health effects';
            if (aqi <= 300) return 'Health alert: everyone may experience more serious health effects';
            return 'Health warnings of emergency conditions. The entire population is more likely to be affected';
        }
        // Function to get AQI bar width based on AQI value
        function getAQIBarWidth(aqi) {
            if (isNaN(aqi) || aqi === 'NA') return '0%'; // Handle 'NA' or undefined values
            return `${Math.min((aqi / 500) * 100, 100)}%`;
        }

        // Function to get AQI point position based on AQI value
        function getAQIPointPosition(aqi) {
            if (isNaN(aqi) || aqi === 'NA') return '0%'; // Handle 'NA' or undefined values
            return `${Math.min((aqi / 500) * 100, 100)}%`;
        }

        function getAQISizeClass(aqi) {
            if (aqi <= 50) {
                return 'small';
            } else if (aqi <= 100) {
                return 'medium';
            } else {
                return 'large';
            }
        }


        function createAQIMarker(data) {
            var aqiColor = getColor(data.airQualityIndexValue);

            var markerIcon = L.divIcon({
                className: 'custom-marker',
                html: `<div class="aqi-value" style="background-color: ${aqiColor};">${data.airQualityIndexValue}</div>`,
                iconSize: [30, 30],
                iconAnchor: [15, 30]
            });

            var marker = L.marker([parseFloat(data.latitude), parseFloat(data.longitude)], {
                icon: markerIcon
            }).addTo(map);

            marker.on('click', function (e) {
                updateMarkerInfo(data);
            });
        }

        weatherData.forEach(function (data) {
            if (data.latitude && data.longitude) {
                createAQIMarker(data);
            }
        });

        const defaultStation = weatherData.find(data => data.station.includes("Lodhi Road, Delhi - IMD"));
        if (defaultStation) {
            updateMarkerInfo(defaultStation);
        }
    </script>
</body>

</html>
