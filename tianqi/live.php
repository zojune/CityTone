<?php
	//101040100 chongqing

class LiveWeather{
  public function getlivedata($cid) {
    if (!function_exists('curl_init')) {
      do {
        $data = file_get_contents('http://www.weather.com.cn/data/sk/'.$cid.'.html');
      } while ($data == '');
    }
    else {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'http://www.weather.com.cn/data/sk/'.$cid.'.html');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
      do {
        $data = curl_exec($ch);
      } while ($data == '');
      curl_close($ch);
    }
    $data = json_decode($data, TRUE);
    return $data['weatherinfo'];
  }
}
