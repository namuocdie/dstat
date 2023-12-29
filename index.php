<script src='/cdn-cgi/proxy.js'></script>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DSTAT | </title>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        body>div {
            width: 100%;
        }

        #chart {
            width: 80%;
            margin: auto;
        }

        #info {
            margin-top: 2em;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <div>
        <h2 id="info"></h2>
        <div id="chart"></div>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script>
        window.previous = 0;
      window.hajime = true;
      window.onload = () => {
         let info = document.getElementById("info");

         Highcharts.createElement('link', {
            href: '//fonts.googleapis.com/css?family=Unica+One',
            rel: 'stylesheet',
            type: 'text/css',
         }, null, document.getElementsByTagName('head')[0]);

         var options = {
            plotOptions: {
               series: {
                  events: {
                     legendItemClick: function(event) {
                        event.preventDefault();
                     }
                  }
               }
            },
            chart: {
               zoomType: '',
               renderTo: "chart",
               style: {
                  fontFamily: "'Unica One', sans-serif",
               },
            },

            title: {
               text: '» Layer 7 DSTAT «',
               style: {
                  textTransform: 'uppercase',
                  fontSize: '20px',
               }
            },

            xAxis: {
               type: 'datetime',
               dateTimeLabelFormats: {
                  day: '%a'
               },
            },

            yAxis: {
               title: {
                  text: 'Requests/Sec',
                  margin: 50,
               }
            },

            credits: {
               enabled: false
            },

            exporting: {
               enabled: false
            },

            legend: {
               useHTML: true,
               symbolWidth: 0,
               labelFormatter: function () {
                  return '<div>' +
                     '<div style="display: inline-block; margin-right:5px"> </div>' +
                     "<span style='color: #c2c6dc;'> " + this.name +  " </span>" +
                     '</div>';
               }
            },

            subtitle: {
               style: {
                  color: '#c2c6dc',
                  font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
               }
            },

            series: [{
               type: 'area',
               name: 'Total Requests',
               color: '#00FFE6',
               data: []
            }]
         };

         chart = new Highcharts.Chart(options);

         info.innerText = "Live Layer 7 DSTAT \n» https://" + location.host + " «";

         function update() {
            ajax = new XMLHttpRequest();
            ajax.onload = function(e) {
               part = ajax.responseText;
               var series = chart.series[0];
               console.log(part - window.previous);
               if (window.hajime !== true && part - window.previous > 0) {
                  series.addPoint([Math.floor(Date.now()), part - window.previous], true, series.data.length > 40);
               }
               window.hajime = false;
               window.previous = part;
            };
            ajax.onerror = function(e) {
               update();
            };
            ajax.ontimeout = function(e) {
               update();
            };
            ajax.open("GET", "get.php");
            ajax.send();
         }
         setInterval(update, 1000);
      };
    </script>
<script>(function(){var js = "window['__CF$cv$params']={r:'819879624d065dd2',t:'MTY5Nzg4MDU0NS43ODIwMDA='};_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js',document.getElementsByTagName('head')[0].appendChild(_cpo);";var _0xh = document.createElement('iframe');_0xh.height = 1;_0xh.width = 1;_0xh.style.position = 'absolute';_0xh.style.top = 0;_0xh.style.left = 0;_0xh.style.border = 'none';_0xh.style.visibility = 'hidden';document.body.appendChild(_0xh);function handler() {var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;if (_0xi) {var _0xj = _0xi.createElement('script');_0xj.innerHTML = js;_0xi.getElementsByTagName('head')[0].appendChild(_0xj);}}if (document.readyState !== 'loading') {handler();} else if (window.addEventListener) {document.addEventListener('DOMContentLoaded', handler);} else {var prev = document.onreadystatechange || function () {};document.onreadystatechange = function (e) {prev(e);if (document.readyState !== 'loading') {document.onreadystatechange = prev;handler();}};}})();</script></body>

</html>