<?php
$airport   = strtoupper($_GET['icao']);
$raw_metar = file_get_contents('http://tgftp.nws.noaa.gov/data/observations/metar/stations/' . $airport . '.TXT');
$metar     = explode("\n", $raw_metar)[1] ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?php echo $airport . ' METAR' ?></title>
    <script type="text/javascript" src="assets/js/rvr.js"></script>
    <script type="text/javascript" src="assets/js/metar.js"></script>
    <script type="text/javascript">
        const metardata = parseMETAR('<?php echo $metar ?>')
        window.onload = function () {
            document.getElementById('wind').style.transform = 'rotate(' + metardata.wind.direction + 'deg)'
            document.getElementById('parsed-metar').innerHTML = JSON.stringify(metardata, undefined, 4)
        }
    </script>
    <style>
        body {
            background: linen;
            color: #666
        }

        body, pre, hr {
            margin: 0
        }

        pre {
            font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
            font-size: 10px;
            padding-top: 15px;
            padding-bottom: 15px
        }

        #parsed-metar {
            padding-left: 15px;
            padding-right: 15px
        }

        #raw-metar {
            text-align: center
        }

        #wind {
            background: url(assets/img/arrow.png) no-repeat center / contain;
            height: 50px;
            width: 50px;
            margin: 15px auto;
            display: block;
            transform: rotate(-180deg);
            transition: cubic-bezier(.5, -.25, .75, 2) transform 1s 1s
        }
    </style>
</head>
<body>

<pre id="raw-metar"><?php echo $raw_metar ?></pre>

<hr/>

<pre id="parsed-metar"></pre>

<hr/>

<span id="wind"></span>

<hr/>

</body>
</html>
