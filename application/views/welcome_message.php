<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AIR QUALITY FORECAST</title>

    <style>
        @media print {
            * {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
    </style>
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.plot.ly/plotly-2.31.1.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>plugins/plotly-2.31.1.min.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
</head>



</script>


<body>

    <!-- Print icon with inline CSS -->
    <a href="#" id="printButton"
        style="position: fixed; top: 20px; right: 20px; font-size: 24px; cursor: pointer; z-index: 1000;">
        <i class="fas fa-print"></i> Print
    </a>


    <div style="font-size: 25px; color: #0000e7; text-align: center;">AIR QUALITY FORECAST BY IMD SILAM MODEL</div>

    <div
        style="width: 555px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; display: flex; align-items: center; justify-content: space-between; background-color: #f9f9f9; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); position: relative; top: 50%; left: 50%; transform: translateY(50%) translateX(-50%);">
        <h2 style="font-size: 20px; margin-right: 5px; margin-bottom: 0; color: #333;">SELECT CITY:</h2>
        <div style="flex-grow: 1; margin-right: 5px;">
            <select id="options"
                style="width: 100%; padding: 5px; font-size: 14px; border: 1px solid #ccc; border-radius: 3px; outline: none; background-color: #fff;">
                <!-- Options will be populated dynamically via JavaScript -->
            </select>
        </div>
        <button type="submit"
            style="padding: 5px 10px; font-size: 14px; border: none; border-radius: 3px; background-color: #007bff; color: #fff; cursor: pointer;">Submit</button>
    </div>

    <div style="font-size: 20px; text-align: center; position: relative; top: 50px;">
        IMD SILAM Air Quality Forecast Over 
    </div>

    <div style="width: 450px; height: 450px; margin-top: 20px;">
        <canvas style="width: 600px; height: 600px; margin-top: 120px;" id="myChart"></canvas>
    </div>

    <div style="width: 415px;
    height: 27px;
    background-color: #00b050;
    margin-right: 10px;
    margin-top: -93px;
    margin-left: 34px;"></div>

    <div style="width: 415px;
    height: 27px;
    background-color: #92d051;
    margin-right: 10px;
    margin-top: -54px;
    margin-left: 34px;"></div>

    <div style="width: 415px;
    height: 27px;
    background-color: #ffff00;
    margin-right: 10px;
    margin-top: -54px;
    margin-left: 34px;"></div>

    <div style="width: 415px;
    height: 27px;
    background-color: #ff6500;
    margin-right: 10px;
    margin-top: -54px;
    margin-left: 34px;"></div>


    <div style="width: 415px;
    height: 111px;
    background-color: #ff0000;
    margin-right: 10px;
    margin-top: -138px;
    margin-left: 34px;"></div>


    <div style="    width: 415px;
    height: 133px;
    background-color: #c00000;
    margin-right: 10px;
    margin-top: -244px;
    margin-left: 34px;"></div>

    <div style="width: 450px; height: 450px; margin-top: -285px; margin-left: 500px;">
        <canvas style="width: 600px; height: 600px; margin-top: 120px;" id="myChart1"></canvas>
    </div>


    <div style="width: 415px;
    height: 35px;
    background-color:  #00b050;
    margin-right: 10px;
    margin-top: -100px;
    margin-left: 534px;"></div>

    <div style="width: 415px;
    height: 35px;
    background-color: #92d051;
    margin-right: 10px;
    margin-top: -70px;
    margin-left: 534px;"></div>

    <div style="width: 415px;
    height: 105px;
    background-color: #ffff00;
    margin-right: 10px;
    margin-top: -141px;
    margin-left: 534px;"></div>

    <div style="    width: 415px;
    height: 70px;
    background-color: #ff6500;
    margin-right: 10px;
    margin-top: -175px;
    margin-left: 534px;"></div>


    <div style="    width: 415px;
    height: 56px;
    background-color: #ff0000;
    margin-right: 10px;
    margin-top: -126px;
    margin-left: 534px;"></div>

    <div style="width: 415px;
    height: 50px;
    background-color: #c00000;
    margin-right: 10px;
    margin-top: -106px;
    margin-left: 534px;"></div>


    <div style="width: 450px; height: 450px; margin-top: -203px; margin-left: 980px;">
        <canvas style="width: 600px; height: 600px; margin-top: 120px;" id="myChart2"></canvas>
    </div>

    <div style="width: 398px;
    height: 25px;
    background-color: #00b050;
    margin-right: 10px;
    margin-top: -90px;
    margin-left: 1027px;"></div>


    <div style="width: 398px;
    height: 25px;
    background-color: #92d051;
    margin-right: 10px;
    margin-top: -50px;
    margin-left: 1027px;"></div>


    <div style="    width: 398px;
    height: 201px;
    background-color: #ffff00;
    margin-right: 10px;
    margin-top: -227px;
    margin-left: 1027px;"></div>


    <div style="width: 398px;
    height: 101px;
    background-color: #ff6500;
    margin-right: 10px;
    margin-top: -302px;
    margin-left: 1027px;"></div>



    <div style="width: 450px; height: 450px; margin-top: 400px;">
        <canvas style="width: 600px; height: 600px; margin-top: 309px;" id="myChart3"></canvas>
    </div>


    <div style="width: 411px;
    height: 56.8px;
    background-color: #00b050;
    margin-right: 10px;
    margin-top: -122px;
    margin-left: 34px;"></div>


    <div style="    width: 411px;
    height: 56.8px;
    background-color: #92d051;
    margin-right: 10px;
    margin-top: -114px;
    margin-left: 34px;"></div>

    <div style="    width: 411px;
    height: 142px;
    background-color: #ffff00;
    margin-right: 10px;
    margin-top: -198px;
    margin-left: 34px;"></div>


    <div style="    width: 411px;
    height: 97px;
    background-color: #ff6500;
    margin-right: 10px;
    margin-top: -239px;
    margin-left: 34px;
}"></div>

    <div style="width: 450px; height: 450px; margin-top: -250px; margin-left: 500px;">
        <canvas style="width: 600px; height: 600px; margin-top: 120px;" id="myChart4"></canvas>
    </div>

    <div style="width: 411px;
    height: 71px;
    background-color: #00b050;
    margin-right: 10px;
    margin-top: -136px;
    margin-left: 534px;"></div>


    <div style="width: 411px;
    height: 71px;
    background-color: #92d051;
    margin-right: 10px;
    margin-top: -142px;
    margin-left: 534px;"></div>


    <div style="width: 411px;
    height: 96.56px;
    background-color: #ffff00;
    margin-right: 10px;
    margin-top: -168px;
    margin-left: 534px;"></div>


    <div style="width: 411px;
    height: 114px;
    background-color: #ff6500;
    margin-right: 10px;
    margin-top: -210px;
    margin-left: 534px;"></div>

    <div style="width: 450px; height: 450px; margin-top: -266px; margin-left: 980px;">
        <canvas style="width: 600px; height: 600px; margin-top: 120px;" id="myChart5"></canvas>
    </div>


    <div style="width: 411px;
    height: 36px;
    background-color: #00b050;
    margin-right: 10px;
    margin-top: -102px;
    margin-left: 1014px;"></div>


    <div style="width: 411px;
    height: 36px;
    background-color: #92d051;
    margin-right: 10px;
    margin-top: -72px;
    margin-left: 1014px;"></div>


    <div style="    width: 411px;
    height: 273px;
    background-color: #ffff00;
    margin-right: 10px;
    margin-top: -309px;
    margin-left: 1014px;"></div>


    <div style="width: 411px;
    height: 7px;
    background-color: #ff6500;
    margin-right: 10px;
    margin-top: -280px;
    margin-left: 1014px;"></div>


    <div style="margin-top: 525px;">
        <div style="margin-right: 900px; font-size: 25px; text-align: center;">
            <div>AQI 2024-04-07 11:00:00 UTC</div>
            <div>Dominating: 03</div>
        </div>

        <!-- <div style="
    font-size: 25px;
    text-align: center;">
            <div>AQI 2024-04-08 11:00:00 UTC</div>
            <div>Dominating: 03</div>
        </div> -->


        <div id="guage"></div>
        <div id="guage1" style="margin-top: -300px; margin-left: 498px;"></div>
        <div id="guage2" style="margin-top: -300px; margin-left: 998px;"></div>
        <div id="guage3" style="margin-top: 100px; margin-left: 253px;"></div>
        <div id="guage4" style="margin-top: -300px; margin-left: 752px;"></div>
    </div>
    <div>


    </div style="margin-top: 70px;">
    <div
        style="width: 666px; height: 300px; background-color: #f0f0f0; border: 2px solid #333; border-radius: 10px; padding: 20px; text-align: center; margin: 0 auto; margin-top: 50px; margin-right: 300px;">
        HEALTH ADIVISORY


        <div style="display: flex; align-items: center; margin-top: 30px;">
            <div style="width: 40px; height: 10px; background-color:  #c00000; border-radius: 5px;"></div>
            <div style="margin-left: 10px; font-family: Arial, sans-serif; font-size: 12px; text-transform: uppercase;">
                Severe: Affects healthy people and seriously impacts those with existing diseases</div>
        </div>


        <div style="display: flex; align-items: center; margin-top: 30px;">
            <div style="width: 40px; height: 10px; background-color:  #ff0000; border-radius: 5px;"></div>
            <div style="margin-left: 10px; font-family: Arial, sans-serif; font-size: 12px; text-transform: uppercase;">
                Very Poor: Respiratory illness on prolonged exposure</div>
        </div>



        <div style="display: flex; align-items: center; margin-top: 30px;">
            <div style="width: 40px; height: 10px; background-color:  #ff6500; border-radius: 5px;"></div>
            <div style="margin-left: 10px; font-family: Arial, sans-serif; font-size: 12px; text-transform: uppercase;">
                Poor: Breathing discomfort to most people on prolonged exposure </div>
        </div>

        <div style="display: flex; align-items: center; margin-top: 30px;">
            <div style="width: 40px; height: 10px; background-color:  #ffff00; border-radius: 5px;"></div>
            <div style="margin-left: 10px; font-family: Arial, sans-serif; font-size: 12px; text-transform: uppercase;">
                Moderate: Breathing discomfort to people with lungs, asthma and haert diseases</div>
        </div>

        <div style="display: flex; align-items: center; margin-top: 30px;">
            <div style="width: 40px; height: 10px; background-color:  #92d051; border-radius: 5px;"></div>
            <div style="margin-left: 10px; font-family: Arial, sans-serif; font-size: 12px; text-transform: uppercase;">
                Satisfactory: Minor breathing discomfort to sensative people</div>
        </div>

        <div style="display: flex; align-items: center; margin-top: 30px;">
            <div style="width: 40px; height: 10px; background-color:  #00b050; border-radius: 5px;"></div>
            <div style="margin-left: 10px; font-family: Arial, sans-serif; font-size: 12px; text-transform: uppercase;">
                Good: Minimal impact</div>
        </div>



    </div>

    <!-- Include jQuery for easier JavaScript handling -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#printButton').on('click', function () {
                window.print();
                return false; // Prevent default behavior of the link
            });
        });
    </script>
    <script>



        var year = <?php echo json_encode($year); ?>;
        var month = <?php echo json_encode($mn); ?>;
        var day = <?php echo json_encode($day); ?>;
        var hour = <?php echo json_encode($hr); ?>;


        // PM2.5 CHART

        var pm25 = <?php echo json_encode($pm25); ?>;
        var pm25_std = <?php echo json_encode($pm25_std); ?>;

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: pm25.map((value, index) => day[index] + '/' + month[index] + '/' + year[index]),
                datasets: [{
                    label: 'pm25_std',
                    data: pm25_std,
                    backgroundColor: 'black',
                    borderColor: 'black',
                    borderWidth: 0.5
                },
                {
                    label: 'pm25',
                    data: pm25,
                    borderColor: 'black',
                    borderWidth: 1,
                    type: 'line',
                    pointRadius: 0,
                    cubicInterpolationMode: 'monotone'
                }
                ]
            },
            options: {
                scales: {
                    x: {
                        min: 0,
                        max: 96,
                        ticks: {
                            color: 'black',
                            callback: function (value, index, values) {
                                if (index === 0) {
                                    return day[0] + '/' + month[0] + '/' + year[0];
                                } else if (index === 24) {
                                    return day[24] + '/' + month[24] + '/' + year[24];
                                } else if (index === 48) {
                                    return day[48] + '/' + month[48] + '/' + year[48];
                                } else if (index === 72) {
                                    return day[72] + '/' + month[72] + '/' + year[72];
                                } else if (index === 90) {
                                    return day[90] + '/' + month[94] + '/' + year[94];
                                }
                                return '';
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        min: 0,
                        max: 400,
                        beginAtZero: true,
                        ticks: {
                            color: 'black',
                            callback: function (value, index, values) {
                                if (value === 0 || value === 50 || value === 100 || value === 150 || value === 200 || value === 250 || value === 300 || value === 350 || value === 400) {
                                    return value.toString();
                                } else {
                                    return value;
                                }
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y;
                                return label;
                            },
                            title: function (context) {
                                var index = context[0].dataIndex;
                                return day[index] + '/' + month[index] + '/' + year[index] + '  ' + hour[index] + 'hr';
                            }
                        }
                    }
                }
            }
        });






        // PM10 CHART

        var pm10 = <?php echo json_encode($pm10); ?>;
        var pm10_std = <?php echo json_encode($pm10_std); ?>;

        var ctx = document.getElementById('myChart1').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: pm10.map((value, index) => day[index] + '/' + month[index] + '/' + year[index]),
                datasets: [{
                    label: 'pm10_std',
                    data: pm10_std,
                    backgroundColor: 'black',
                    borderColor: 'black',
                    borderWidth: 0.5
                },
                {
                    label: 'pm10',
                    data: pm10,
                    borderColor: 'black',
                    borderWidth: 1,
                    type: 'line',
                    pointRadius: 0,
                    cubicInterpolationMode: 'monotone'
                }]
            },
            options: {
                scales: {
                    x: {
                        min: 0,
                        max: 96,
                        ticks: {
                            color: 'black',
                            callback: function (value, index, values) {
                                if (index === 0) {
                                    return day[0] + '/' + month[0] + '/' + year[0];
                                } else if (index === 24) {
                                    return day[24] + '/' + month[24] + '/' + year[24];
                                } else if (index === 48) {
                                    return day[48] + '/' + month[48] + '/' + year[48];
                                } else if (index === 72) {
                                    return day[72] + '/' + month[72] + '/' + year[72];
                                } else if (index === 90) {
                                    return day[90] + '/' + month[94] + '/' + year[94];
                                }
                                return '';
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        min: 0,
                        max: 500,
                        beginAtZero: true,
                        ticks: {
                            color: 'black',
                            callback: function (value, index, values) {
                                if (value === 0 || value === 100 || value === 200 || value === 300 || value === 400 || value === 500) {
                                    return value.toString();
                                }
                                return '';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y;
                                return label;
                            },
                            title: function (context) {
                                var index = context[0].dataIndex;
                                return day[index] + '/' + month[index] + '/' + year[index] + '  ' + hour[index] + 'hr';
                            }
                        }
                    }
                }
            }
        });

        // CO CHART


        var co = <?php echo json_encode($co); ?>;
        var co_std = <?php echo json_encode($co_std); ?>;

        var ctx = document.getElementById('myChart2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: co.map((value, index) => day[index] + '/' + month[index] + '/' + year[index]),
                datasets: [{
                    label: 'co_std',
                    data: co_std,
                    backgroundColor: 'black',
                    borderColor: 'black',
                    borderWidth: 0.5
                },
                {
                    label: 'co',
                    data: co,
                    borderColor: 'black',
                    borderWidth: 1,
                    type: 'line',
                    pointRadius: 0,
                    cubicInterpolationMode: 'monotone'
                }]
            },
            options: {
                scales: {
                    x: {
                        min: 0,
                        max: 96,
                        ticks: {
                            color: 'black',
                            callback: function (value, index, values) {
                                if (index === 0) {
                                    return day[0] + '/' + month[0] + '/' + year[0];
                                } else if (index === 24) {
                                    return day[24] + '/' + month[24] + '/' + year[24];
                                } else if (index === 48) {
                                    return day[48] + '/' + month[48] + '/' + year[48];
                                } else if (index === 72) {
                                    return day[72] + '/' + month[72] + '/' + year[72];
                                } else if (index === 90) {
                                    return day[90] + '/' + month[94] + '/' + year[94];
                                }
                                return '';
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        min: 0,
                        max: 14000,
                        beginAtZero: true,
                        ticks: {
                            color: 'black',
                            callback: function (value, index, values) {
                                if (
                                    value === 0 ||
                                    value === 2000 ||
                                    value === 4000 ||
                                    value === 6000 ||
                                    value === 8000 ||
                                    value === 10000 ||
                                    value === 12000 ||
                                    value === 14000
                                ) {
                                    return value.toString();
                                }
                                return ''; // Return an empty string for other values to hide the ticks
                            }
                        }
                    }

                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y;
                                return label;
                            },
                            title: function (context) {
                                var index = context[0].dataIndex;
                                return day[index] + '/' + month[index] + '/' + year[index] + '  ' + hour[index] + 'hr';
                            }
                        }
                    }
                }
            }
        });


        // NO2 CHARTS


        var no2 = <?php echo json_encode($no2); ?>;
        var no2_std = <?php echo json_encode($no2_std); ?>;

        var ctx = document.getElementById('myChart3').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: no2.map((value, index) => day[index] + '/' + month[index] + '/' + year[index]),
                datasets: [{
                    label: 'no2_std',
                    data: no2_std,
                    backgroundColor: 'black',
                    borderColor: 'black',
                    borderWidth: 0.5
                },
                {
                    label: 'no2',
                    data: no2,
                    borderColor: 'black',
                    borderWidth: 1,
                    type: 'line',
                    pointRadius: 0,
                    cubicInterpolationMode: 'monotone'
                }]
            },
            options: {
                scales: {
                    x: {
                        min: 0,
                        max: 96,
                        ticks: {
                            color: 'black',
                            callback: function (value, index, values) {
                                if (index === 0) {
                                    return day[0] + '/' + month[0] + '/' + year[0];
                                } else if (index === 24) {
                                    return day[24] + '/' + month[24] + '/' + year[24];
                                } else if (index === 48) {
                                    return day[48] + '/' + month[48] + '/' + year[48];
                                } else if (index === 72) {
                                    return day[72] + '/' + month[72] + '/' + year[72];
                                } else if (index === 90) {
                                    return day[90] + '/' + month[94] + '/' + year[94];
                                }
                                return '';
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        min: 0,
                        max: 250,
                        beginAtZero: true,
                        ticks: {
                            color: 'black',
                            callback: function (value, index, values) {
                                if (value === 0 || value === 50 || value === 100 || value === 150 || value === 200 || value === 250) {
                                    return value.toString();
                                }
                                return '';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y;
                                return label;
                            },
                            title: function (context) {
                                var index = context[0].dataIndex;
                                return day[index] + '/' + month[index] + '/' + year[index] + '  ' + hour[index] + 'hr';
                            }
                        }
                    }
                }
            }
        });


        // O3 CHARTS


        var o3 = <?php echo json_encode($o3); ?>;
        var o3_std = <?php echo json_encode($o3_std); ?>;

        var ctx = document.getElementById('myChart4').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: o3.map((value, index) => day[index] + '/' + month[index] + '/' + year[index]),
                datasets: [{
                    label: 'o3_std',
                    data: o3_std,
                    backgroundColor: 'black',
                    borderColor: 'black',
                    borderWidth: 0.5
                },
                {
                    label: 'o3',
                    data: o3,
                    borderColor: 'black',
                    borderWidth: 1,
                    type: 'line',
                    pointRadius: 0,
                    cubicInterpolationMode: 'monotone'
                }]
            },
            options: {
                scales: {
                    x: {
                        min: 0,
                        max: 96,
                        ticks: {
                            color: 'black',
                            callback: function (value, index, values) {
                                if (index === 0) {
                                    return day[0] + '/' + month[0] + '/' + year[0];
                                } else if (index === 24) {
                                    return day[24] + '/' + month[24] + '/' + year[24];
                                } else if (index === 48) {
                                    return day[48] + '/' + month[48] + '/' + year[48];
                                } else if (index === 72) {
                                    return day[72] + '/' + month[72] + '/' + year[72];
                                } else if (index === 90) {
                                    return day[90] + '/' + month[94] + '/' + year[94];
                                }
                                return '';
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        min: 0,
                        max: 250,
                        beginAtZero: true,
                        ticks: {
                            color: 'black',
                            callback: function (value, index, values) {
                                if (value === 0 || value === 50 || value === 100 || value === 150 || value === 200 || value === 250) {
                                    return value.toString();
                                }
                                return '';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y;
                                return label;
                            },
                            title: function (context) {
                                var index = context[0].dataIndex;
                                return day[index] + '/' + month[index] + '/' + year[index] + '  ' + hour[index] + 'hr';
                            }
                        }
                    }
                }
            }
        });

        // SO2 CHARTS



        var so2 = <?php echo json_encode($so2); ?>;
        var so2_std = <?php echo json_encode($so2_std); ?>;

        var ctx = document.getElementById('myChart5').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: so2.map((value, index) => day[index] + '/' + month[index] + '/' + year[index]),
                datasets: [{
                    label: 'so2_std',
                    data: so2_std,
                    backgroundColor: 'black',
                    borderColor: 'black',
                    borderWidth: 0.5
                },
                {
                    label: 'so2',
                    data: so2,
                    borderColor: 'black',
                    borderWidth: 1,
                    type: 'line',
                    pointRadius: 0,
                    cubicInterpolationMode: 'monotone'
                }]
            },
            options: {
                scales: {
                    x: {
                        min: 0,
                        max: 96,
                        ticks: {
                            color: 'black',
                            callback: function (value, index, values) {
                                if (index === 0) {
                                    return day[0] + '/' + month[0] + '/' + year[0];
                                } else if (index === 24) {
                                    return day[24] + '/' + month[24] + '/' + year[24];
                                } else if (index === 48) {
                                    return day[48] + '/' + month[48] + '/' + year[48];
                                } else if (index === 72) {
                                    return day[72] + '/' + month[72] + '/' + year[72];
                                } else if (index === 90) {
                                    return day[90] + '/' + month[94] + '/' + year[94];
                                }
                                return '';
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        min: 0,
                        max: 400,
                        beginAtZero: true,
                        ticks: {
                            color: 'black',
                            callback: function (value, index, values) {
                                if (value === 0 || value === 50 || value === 100 || value === 150 || value === 200 || value === 250 || value === 300 || value === 350 || value === 400) {
                                    return value.toString();
                                }
                                return '';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y;
                                return label;
                            },
                            title: function (context) {
                                var index = context[0].dataIndex;
                                return day[index] + '/' + month[index] + '/' + year[index] + '  ' + hour[index] + 'hr';
                            }
                        }
                    }
                }
            }
        });


        // GUAGE

        var data = [
            {
                domain: { x: [0, 1], y: [0, 1] },
                value: 50,
                title: { text: "Speed" },
                type: "indicator",
                mode: "gauge+number",
                gauge: {
                    axis: { range: [0, 500] },
                    steps: [
                        { range: [0, 50], color: "#00b050" },
                        { range: [50, 100], color: "#92d051" },
                        { range: [100, 200], color: "#ffff00" },
                        { range: [200, 300], color: "#ff6500" },
                        { range: [300, 400], color: "#ff0000" },
                        { range: [400, 500], color: "#c00000" }
                    ],
                    threshold: {
                        line: { color: "black", width: 4 },
                        thickness: 0.75,
                        value: 50
                    },
                    bar: { color: "black" }
                }
            }
        ];

        var layout = { width: 500, height: 300, margin: { t: 0, b: 0 } };
        Plotly.newPlot('guage', data, layout);

        var data = [
            {
                domain: { x: [0, 1], y: [0, 1] },
                value: 100,
                title: { text: "Speed" },
                type: "indicator",
                mode: "gauge+number",
                gauge: {
                    axis: { range: [0, 500] },
                    steps: [
                        { range: [0, 50], color: "#00b050" },
                        { range: [50, 100], color: "#92d051" },
                        { range: [100, 200], color: "#ffff00" },
                        { range: [200, 300], color: "#ff6500" },
                        { range: [300, 400], color: "#ff0000" },
                        { range: [400, 500], color: "#c00000" }
                    ],
                    threshold: {
                        line: { color: "black", width: 4 },
                        thickness: 0.75,
                        value: 100
                    },
                    bar: { color: "black" }
                }
            }
        ];

        var layout = { width: 500, height: 300, margin: { t: 0, b: 0 } };
        Plotly.newPlot('guage1', data, layout);





        var data = [
            {
                domain: { x: [0, 1], y: [0, 1] },
                value: 150,
                title: { text: "Speed" },
                type: "indicator",
                mode: "gauge+number",
                gauge: {
                    axis: { range: [0, 500] },
                    steps: [
                        { range: [0, 50], color: "#00b050" },
                        { range: [50, 100], color: "#92d051" },
                        { range: [100, 200], color: "#ffff00" },
                        { range: [200, 300], color: "#ff6500" },
                        { range: [300, 400], color: "#ff0000" },
                        { range: [400, 500], color: "#c00000" }
                    ],
                    threshold: {
                        line: { color: "black", width: 4 },
                        thickness: 0.75,
                        value: 150
                    },
                    bar: { color: "black" }
                }
            }
        ];

        var layout = { width: 500, height: 300, margin: { t: 0, b: 0 } };
        Plotly.newPlot('guage2', data, layout);


        var layout = { width: 500, height: 300, margin: { t: 0, b: 0 } };
        Plotly.newPlot('guage', data, layout);

        var data = [
            {
                domain: { x: [0, 1], y: [0, 1] },
                value: 200,
                title: { text: "Speed" },
                type: "indicator",
                mode: "gauge+number",
                gauge: {
                    axis: { range: [0, 500] },
                    steps: [
                        { range: [0, 50], color: "#00b050" },
                        { range: [50, 100], color: "#92d051" },
                        { range: [100, 200], color: "#ffff00" },
                        { range: [200, 300], color: "#ff6500" },
                        { range: [300, 400], color: "#ff0000" },
                        { range: [400, 500], color: "#c00000" }
                    ],
                    threshold: {
                        line: { color: "black", width: 4 },
                        thickness: 0.75,
                        value: 200
                    },
                    bar: { color: "black" }
                }
            }
        ];

        var layout = { width: 500, height: 300, margin: { t: 0, b: 0 } };
        Plotly.newPlot('guage3', data, layout);





        var data = [
            {
                domain: { x: [0, 1], y: [0, 1] },
                value: 250,
                title: { text: "Speed" },
                type: "indicator",
                mode: "gauge+number",
                gauge: {
                    axis: { range: [0, 500] },
                    steps: [
                        { range: [0, 50], color: "#00b050" },
                        { range: [50, 100], color: "#92d051" },
                        { range: [100, 200], color: "#ffff00" },
                        { range: [200, 300], color: "#ff6500" },
                        { range: [300, 400], color: "#ff0000" },
                        { range: [400, 500], color: "#c00000" }
                    ],
                    threshold: {
                        line: { color: "black", width: 4 },
                        thickness: 0.75,
                        value: 250
                    },
                    bar: { color: "black" }
                }
            }
        ];

        var layout = { width: 500, height: 300, margin: { t: 0, b: 0 } };
        Plotly.newPlot('guage4', data, layout);
    </script>





</body>

</html>