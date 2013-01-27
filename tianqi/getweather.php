<?php
require_once 'live.php';
//require_once 'forecast.php';


$cityid ='101040100';
$liveObj = new LiveWeather();
$live=$liveObj->getlivedata('101040100');
$city = $live['city'];
$body = "{$live['time']}发布<br />\n温度：{$live['temp']}℃&nbsp;&nbsp;&nbsp;湿度：{$live['SD']}<br />\n风向：{$live['WD']}&nbsp;&nbsp;&nbsp;风力：{$live['WS']}<br />\n";



//$forcastObj = new ForeCastWeather();
//$forcast = $forcastObj->getforecast('101040100');
//$date = strtotime(preg_replace(array('/年/', '/月/', '/日/'), array('-', '-', ''), $forecast['date_y'])." {$forecast['fchh']}:00:00");
//$body2=$forcast;
//if ($forecast) {
//      $city2 = $forecast['city'];
//      $body2 = $forcastObj->printbody($forecast);
//    };


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo $city; ?>天气实况</title>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<link rel="stylesheet" href="style.css" type="text/css" media="all">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js" type="text/javascript"></script>
</head>

<body>
<div class="content">
	<div class="wrap">
        <div class="post">
        	<h3>今日天气实况</h3>
        	<h4><?php echo $body; ?></h4>
        	<p></p>
        	<h3>未来5天天气预报</h3>
        	<p><?php include 'forecast.php'; ?></p>
        </div>
    </div>
</div>

</body>
</html>
