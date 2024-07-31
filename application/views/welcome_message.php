<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AQI</title>
    <link rel="shortcut icon" href="https://mausam.imd.gov.in/responsive/img/logo/imd_icon.ico">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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
            background-color: #87CEEB;
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
            margin-left: 60%;
        }

        .aqi-color {
            height: 20px;
            width: 100px;
            border-radius: 3px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            color: white;
            padding-right: 10px;
            box-sizing: border-box;
        }

        .aqi-color1 {
            height: 30px;
            width: 30px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            background-color: #4CAF50;
        }


        .aqi-color span {
            text-align: right;
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
            margin: 5px 0;
        }



        .tab {
            cursor: pointer;
            padding: 10px;
            font-weight: normal;
        }

        .tab.active {
            font-weight: bold;
            border-bottom: 2px solid black;
        }
    </style>
</head>

<body>
    <div id="header"
        style="display: flex; align-items: center; justify-content: space-between; height: 60px; width: calc(100% - 60px); position: relative;padding: 0 30px;">
        <img src="img/emblem.png" alt="Emblem of India" height="50" style="margin-right: auto; margin-left: 10px;">
        <div style="flex: 1; text-align: center;">
            <span style="font-family: 'Times New Roman'; font-size: 24px; font-weight: bold; color:">AIR QUALITY
                INDEX</span>
        </div>
        <img src="img/imd_logo.png" alt="IMD logo" height="50" style="margin-left: auto; margin-right: -10px;">
    </div>
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
        </div>
        <div id="map"></div>
    </div>

    <script>
        var map = L.map('map').setView([23.665365, 78.661606], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        _dist_geojson = "DATA/INDIA_STATE.json";
        var geojson = new L.GeoJSON.AJAX(_dist_geojson, {
            style: function (feature) {
                return {
                    color: 'black',
                    fillColor: 'transparent',
                    opacity: 0.5,
                    fillOpacity: 0.0,
                    weight: 2
                };
            }
        });

        geojson.on('data:loaded', function () {
            geojson.addTo(map);
        });

        var weatherData = <?php echo json_encode($weather_data); ?>;
        // console.log("Weather Data:", weatherData);

        var sixhours_data = <?php echo json_encode($sixhours_data); ?>;
        // console.log("Six hours Data:", sixhours_data);

        var week_data = <?php echo json_encode($week_data); ?>;
        // console.log("week Data:", week_data);

        var month_data = <?php echo json_encode($month_data); ?>;
        // console.log("month Data:", month_data);

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
  <div class="aqi-color" style="background-color: ${aqiColor}; display: flex; justify-content: center; align-items: center;">
<div style="color:black;">${aqiText}</div>
</div>
    <p style="margin-top: 5px;"><span id="lastupdate">${data.lastUpdate}</span></p>
</div>

         <p style="display: flex; align-items: center;margin-top: -39px;">
    <b><i class="fa fa-thermometer-half" aria-hidden="true"></i> <span id="max-value" style="margin-left: 5px;">${data.max}</span></b>
    <b style="margin-left: 20px;"><i class="fa-solid fa-droplet"></i> <span id="min-value" style="margin-left: 5px;">${data.min}</span></b>
</p>

            <div style="    font-size: 80px;margin-left: 25%;"><span id="airQualityIndexValue">${data.airQualityIndexValue}</span></div>
                <div style="font-size: 15px;margin-left: 30%;">IND AQI</div><br>

            <!-- AQI Bar -->
            <div class="aqi-bar">
                <div class="aqi-bar-inner" style="width: ${getAQIBarWidth(data.airQualityIndexValue)};"></div>
                <div class="aqi-point" id="aqi-point" style="left: ${getAQIPointPosition(data.airQualityIndexValue)}; background-color: ${aqiColor};"></div>
            </div>
            <!-- End AQI Bar -->

            <!-- AQI Scale -->
            <div class="aqi-scale">
                <span>0</span>
                <span>100</span>
                <span>200</span>
                <span>300</span>
                <span>400</span>
                <span>500</span>
            </div>
            <!-- End AQI Scale -->

  <hr class="separator" />
  <div style="display: flex; align-items: center;">
    <div class="aqi-color1" style="background-color: ${aqiColor}; width: 20px; height: 20px; border-radius: 50%; margin-right: 10px;"></div>
    <span>${aqiTextwarning}</span>
</div>

  <hr class="separator" />

                    <div class="marker-info-box" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;height: 17%;">
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; padding: 10px; border: 1px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 30%; background-color: white;">          
<b style="font-size: 0.9em;">PM2.5</b>

       <span style="font-size: 1em;">${getAvgValue('PM2.5', data)}</span>
                        </div>
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; padding: 10px; border: 1px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 30%; background-color: white;">   
                            <b style="font-size: 0.9em;">PM10</b>

   <span style="font-size: 1em;">${getAvgValue('PM10', data)}</span>
                        </div>
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; padding: 10px; border: 1px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 30%; background-color: white;">          
                            <b style="font-size: 0.9em;">NO2</b>

               <span style="font-size: 1em;">${getAvgValue('NO2', data)}</span>
                        </div>
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; padding: 10px; border: 1px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 30%; background-color: white;">        
                            <b style="font-size: 0.9em;">CO</b>

               <span style="font-size: 1em;">${getAvgValue('CO', data)}</span>
                        </div>
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; padding: 10px; border: 1px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 30%; background-color: white;">       
                            <b style="font-size: 0.9em;">SO2</b>

               <span style="font-size: 1em;">${getAvgValue('SO2', data)}</span>
                        </div>
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; padding: 10px; border: 1px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 30%; background-color: white;">          
                            <b style="font-size: 0.9em;">O3</b>

                 <span style="font-size: 1em;">${getAvgValue('O3', data)}</span>
                        </div>

  <hr class="separator" />
                        
<div class="sixhoursdata" id="sixhoursdata-container" style="display: flex; flex-direction: column; align-items: center;">
    <div style="display: flex; justify-content: space-between; width: 100%; margin-bottom: 10px;">
        <div id="live-tab" class="tab"style=" font-weight: bold;
            border-bottom: 2px solid black;" onclick="showTab('live')">LIVE</div>
        <div id="week-tab" class="tab" onclick="showTab('week')">WEEK</div>
        <div id="month-tab" class="tab" onclick="showTab('month')">MONTH</div>
    </div>
    <canvas id="chart" width="340" height="190"></canvas>
  <canvas id="weekchart" width="340" height="190" style="display: none;"></canvas> 
    <canvas id="monthchart" width="340" height="190" style="display: none;"></canvas>
    <div id="data-html-container">
        ${getDataHTML(data.station)}
         ${getDataHTML1(data.station)}
          ${getDataHTML2(data.station)}
    </div>
</div>




                </div>
  
    
   
    `;
            renderChart();
            renderChart1();
            renderChart2();
        }

        function getAvgValue(indexId, data) {
            var avgData = weatherData.find(item => item.station === data.station && item.indexId === indexId);
            return avgData ? avgData.avg : 'N/A';
        }

        let chartInstance = null;
        let chartInstance1 = null;
        let chartInstance2 = null;

        let globalChartData = { labels: [], values: [], message: '' };
        let globalChartData1 = { labels1: [], values1: [], message: '' };
        let globalChartData2 = { labels2: [], values2: [], message: '' };

        let activeTab = 'live'; // Default active tab

        function getDataHTML(station) {
            const graphData = sixhours_data.filter(item => item.station === station);

            let labels = graphData.map(item => {
                let date = new Date(item.lastUpdate);
                let hours = date.getHours().toString().padStart(2, '0');
                let minutes = date.getMinutes().toString().padStart(2, '0');
                return `${hours}:${minutes}`;
            });
            let values = graphData.map(item => item.airQualityIndexValue);
            labels = labels.reverse();
            values = values.reverse();
            globalChartData = { labels: labels, values: values, message: '' };
            return ''; // Update as needed
        }

        function getDataHTML1(station) {
            const graphData = week_data.filter(item => item.station === station);

            let labels1 = graphData.map(item => {
                let date = new Date(item.lastUpdate);
                let hours = date.getHours().toString().padStart(2, '0');
                let minutes = date.getMinutes().toString().padStart(2, '0');
                return `${hours}:${minutes}`;
            });
            let values1 = graphData.map(item => item.airQualityIndexValue);
            labels1 = labels1.reverse();
            values1 = values1.reverse();
            globalChartData1 = { labels1: labels1, values1: values1, message: '' };
        }

        function getDataHTML2(station) {
            const graphData = month_data.filter(item => item.station === station);

            let labels2 = graphData.map(item => {
                let date = new Date(item.lastUpdate);
                let hours = date.getHours().toString().padStart(2, '0');
                let minutes = date.getMinutes().toString().padStart(2, '0');
                return `${hours}:${minutes}`;
            });
            let values2 = graphData.map(item => item.airQualityIndexValue);
            labels2 = labels2.reverse();
            values2 = values2.reverse();
            globalChartData2 = { labels2: labels2, values2: values2, message: '' };
        }

        function renderChart() {
            const ctx = document.getElementById('chart').getContext('2d');
            if (ctx) {
                if (chartInstance) {
                    chartInstance.destroy();
                }
                chartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: globalChartData.labels,
                        datasets: [{
                            label: 'AQI',
                            data: globalChartData.values,
                            fill: false,
                            borderColor: 'black',
                            tension: 0.1,
                            pointRadius: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { title: { display: true, text: "6 HOURS" }, grid: { display: false } },
                            y: { title: { display: true }, ticks: { stepSize: 50 }, suggestedMin: 0, suggestedMax: 500, grid: { display: false } }
                        }
                    }
                });
            }
        }

        function renderChart1() {
            const ctx = document.getElementById('weekchart').getContext('2d');
            if (ctx) {
                if (chartInstance1) {
                    chartInstance1.destroy();
                }
                chartInstance1 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: globalChartData1.labels1,
                        datasets: [{
                            label: 'AQI',
                            data: globalChartData1.values1,
                            fill: false,
                            backgroundColor: 'black',
                            borderColor: 'black',
                            tension: 0.1,
                            pointRadius: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { title: { display: true, text: "WEEK" }, grid: { display: false } },
                            y: { title: { display: true }, ticks: { stepSize: 50 }, suggestedMin: 0, suggestedMax: 500, grid: { display: false } }
                        }
                    }
                });
            }
        }

        function renderChart2() {
            const ctx = document.getElementById('monthchart').getContext('2d');
            if (ctx) {
                if (chartInstance2) {
                    chartInstance2.destroy();
                }
                chartInstance2 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: globalChartData2.labels2,
                        datasets: [{
                            label: 'AQI',
                            data: globalChartData2.values2,
                            fill: false,
                            backgroundColor: 'black',
                            borderColor: 'black',
                            tension: 0.1,
                            pointRadius: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { title: { display: true, text: "MONTH" }, grid: { display: false } },
                            y: { title: { display: true }, ticks: { stepSize: 50 }, suggestedMin: 0, suggestedMax: 500, grid: { display: false } }
                        }
                    }
                });
            }
        }

        function showTab(tabName) {
            document.getElementById('chart').style.display = 'none';
            document.getElementById('weekchart').style.display = 'none';
            document.getElementById('monthchart').style.display = 'none';

            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.classList.remove('active');
                tab.style.fontWeight = 'normal';
                tab.style.borderBottom = 'none';
            });

            if (tabName === 'live') {
                document.getElementById('chart').style.display = 'block';
                document.getElementById('live-tab').classList.add('active');
                document.getElementById('live-tab').style.fontWeight = 'bold';
                document.getElementById('live-tab').style.borderBottom = '2px solid black';
                document.getElementById('data-html-container').innerHTML = getDataHTML(data.station);
            } else if (tabName === 'week') {
                document.getElementById('weekchart').style.display = 'block';
                document.getElementById('week-tab').classList.add('active');
                document.getElementById('week-tab').style.fontWeight = 'bold';
                document.getElementById('week-tab').style.borderBottom = '2px solid black';
                document.getElementById('data-html-container').innerHTML = getDataHTML1(data.station);
            } else if (tabName === 'month') {
                document.getElementById('monthchart').style.display = 'block';
                document.getElementById('month-tab').classList.add('active');
                document.getElementById('month-tab').style.fontWeight = 'bold';
                document.getElementById('month-tab').style.borderBottom = '2px solid black';
                document.getElementById('data-html-container').innerHTML = getDataHTML2(data.station);
            }
        }


        document.addEventListener('DOMContentLoaded', function () {
            showTab('live');
        });











        function getColor(aqi) {
            if (isNaN(aqi) || aqi === 'NA') {
                return "#000000";
            }
            if (aqi <= 50) return "#479B55";
            if (aqi <= 100) return "#86ce00";
            if (aqi <= 200) return "#F6F926";
            if (aqi <= 300) return "#FF9616";
            if (aqi <= 400) return "#FB0DOD";
            return "#AF0038";
        }

        function getAQIText(aqi) {
            if (isNaN(aqi) || aqi === 'NA') return "NA";
            if (aqi <= 50) return "Good";
            if (aqi <= 100) return "Satisfactory";
            if (aqi <= 200) return "Moderate";
            if (aqi <= 300) return "Poor";
            if (aqi <= 400) return "Very Poor";
            return "Severe";
        }

        function getAQITextwarning(aqi) {
            if (aqi === null || aqi === undefined || isNaN(aqi)) {
                return 'N/A';
            }

            if (aqi <= 50) return '<b>GOOD:</b><br>Minimal impact.';
            if (aqi <= 100) return '<b>SATISFACTORY:</b><br>Minor breathing discomfort to sensitive people.';
            if (aqi <= 150) return '<b>MODERATE:</b><br>Breathing discomfort to most people on prolonged exposure.';
            if (aqi <= 200) return '<b>POOR:</b><br>Breathing discomfort to most people on prolonged exposure.';
            if (aqi <= 300) return '<b>VERY POOR:</b><br>Respiratory illness on prolonged exposure.';
            return '<b>SEVERE:</b><br>Healthy people and seriously impacts those with existing diseases.';
        }


        function getAQIBarWidth(aqi) {
            if (isNaN(aqi) || aqi === 'NA') return '0%';
            return `${Math.min((aqi / 500) * 100, 100)}%`;
        }

        function getAQIPointPosition(aqi) {
            if (isNaN(aqi) || aqi === 'NA') return '0%';
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