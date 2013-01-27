<?php
/**
*  微信 公众平台消息接口
*  @author zojune
*  @version 1.0.20130127
*/
error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set("Asia/Shanghai");

require_once 'weixin.class.php';
//require_once 'tianqi/live.php';

define('TOKEN', 'zyftoke');	//微信公众平台自定义接口处设置的 Token
define('DEBUG', true);			//是否调试模式 true/false (开启调试将会把收发的信息写入文件)
define('LOGPATH', './');		//日志目录

$weixin = new weixin(TOKEN,DEBUG,LOGPATH);

$weixin->valid();
$weixin->getMsg();
$type = $weixin->msgtype;

$domain = 'http://'.$_SERVER['HTTP_HOST'];
$filename = (string)end(explode('/',$_SERVER['SCRIPT_NAME']));
$strURL = $domain . str_replace($filename,'',$_SERVER['SCRIPT_NAME']);

if ($type==='text') {
	//用户发送文本信息
	if ($weixin->msg['Content']=='Hello2BizUser') {
		//用户关注成功后,微信服务器将发送该字符串到接口. 用以标识用户关注事件
		$note = '感谢您的关注，重庆城市通，现在就和我互动吧。回复help获取神秘暗号，更多自动功能敬请期待';
		$reply = $weixin->makeText($note);
	}elseif ($weixin->msg['Content']=='help') {
		//用户关注成功后,微信服务器将发送该字符串到接口. 用以标识用户关注事件
		$note = '现已实现以下功能，更多好玩敬请期待。              回复tq---查询重庆天气   回复gj---查询重庆公交    回复dy---查询电影信息    回复ms---查询美食信息';
		$reply = $weixin->makeText($note);
	}elseif ($weixin->msg['Content']=='tq') {
		
		//$liveObj = new LiveWeather();
		//$live=$liveObj->getlivedata('101040100');
		//$city = $live['city'];
		$body = '点击查看！';
		//$body = "{$live['time']}发布<br />\n温度：{$live['temp']}℃<br />\n湿度：{$live['SD']}<br />\n风向：{$live['WD']}<br />\n风力：{$live['WS']}<br />\n";
		$description=$body;
		//如有必要可以为此条信息标星
		//$weixin->setFlag = true;
		$news['items'] =  array(
				array(
					'title' => '重庆天气实况及未来5天天气预报',
					'description' => '重庆天气预报:'.$body,
					'picurl' => $strURL.'tianqi/101040100.jpg',	//图片地址为接口域名下图片
					'url' => 'http://www.zaiyifang.com/wechat/tianqi/getweather.php'
				)
		);
		$reply = $weixin->makeNews($news);
	}elseif ($weixin->msg['Content']=='gj') {
		
		//$liveObj = new LiveWeather();
		//$live=$liveObj->getlivedata('101040100');
		//$city = $live['city'];
		$body = '点击查看！';
		//$body = "{$live['time']}发布<br />\n温度：{$live['temp']}℃<br />\n湿度：{$live['SD']}<br />\n风向：{$live['WD']}<br />\n风力：{$live['WS']}<br />\n";
		$description=$body;
		//如有必要可以为此条信息标星
		//$weixin->setFlag = true;
		$news['items'] =  array(
				array(
					'title' => '重庆公交信息实现中，敬请期待',
					'description' => '重庆公交信息:'.$body,
					'picurl' => $strURL.'tianqi/101040100.jpg',	//图片地址为接口域名下图片
					'url' => 'http://www.zaiyifang.com/wechat/tianqi/pleasewaiting.php'
				)
		);
		$reply = $weixin->makeNews($news);
	}elseif ($weixin->msg['Content']=='dy') {
		
		//$liveObj = new LiveWeather();
		//$live=$liveObj->getlivedata('101040100');
		//$city = $live['city'];
		$body = '点击查看！';
		//$body = "{$live['time']}发布<br />\n温度：{$live['temp']}℃<br />\n湿度：{$live['SD']}<br />\n风向：{$live['WD']}<br />\n风力：{$live['WS']}<br />\n";
		$description=$body;
		//如有必要可以为此条信息标星
		//$weixin->setFlag = true;
		$news['items'] =  array(
				array(
					'title' => '今日影讯开发中，敬请期待',
					'description' => '今日影讯:'.$body,
					'picurl' => $strURL.'tianqi/101040100.jpg',	//图片地址为接口域名下图片
					'url' => 'http://www.zaiyifang.com/wechat/tianqi/pleasewaiting.php'
				)
		);
		$reply = $weixin->makeNews($news);
	}elseif ($weixin->msg['Content']=='单条图文') {
		//如有必要可以为此条信息标星
		//$weixin->setFlag = true;
		$news['items'] =  array(
				array(
					'title' => '微信 公众平台消息接口 SDK',
					'description' => '这是图文消息内容,仅在单条图文的时候会显示',
					'picurl' => $strURL.'/sdk.jpg',	//图片地址为接口域名下图片
					'url' => 'http://www.xhxu.cn'
				)
		);
		$reply = $weixin->makeNews($news);
	}elseif ($weixin->msg['Content']=='多条图文') {
		//如有必要可以为此条信息标星
		//$weixin->setFlag = true;
		//图文内容条数最大10(多余10条将自动丢弃)
		$news['items'] =  array(
				array(
					'title' => '微信 公众平台消息接口 SDK (标题1)',
					'description' => '微信 公众平台消息接口SDK 说明1 (多条图文时,不会显示)',
					'picurl' => $strURL.'/sdk.jpg',	//图片地址为接口域名下图片
					'url' => 'http://www.xhxu.cn'
				),
				array(
					'title' => '微信 公众平台消息接口 SDK (标题2)',
					'description' => '微信 公众平台消息接口SDK 说明2 (多条图文时,不会显示)',
					'picurl' => $strURL.'/sdk.jpg',	//图片地址为接口域名下图片
					'url' => 'http://www.xhxu.cn'
				),
				array(
					'title' => '微信 公众平台消息接口 SDK (标题3)',
					'description' => '微信 公众平台消息接口 SDK 说明3 (多条图文时,不会显示)',
					'picurl' => $strURL.'/sdk.jpg',
					'url' => 'http://www.xhxu.cn'
				)
		);
		$reply = $weixin->makeNews($news);
	}else{
		$note = '你好,你发的信息是:'.$weixin->msg['Content'].' 更多自动功能回复help获取。';
		$reply = $weixin->makeText($note);
	}

}elseif ($type==='location') {
	//用户发送位置信息
	$note = '您的位置在: '.$weixin->msg['Label'].'坐标是: X:'.$weixin->msg['Location_X'].' Y:'.$weixin->msg['Location_Y'];
	$reply = $weixin->makeText($note);
}elseif ($type==='image') {
	//用户发送图片消息
	$note = '你发送的图片地址是: '.$weixin->msg['PicUrl'];
	$reply = $weixin->makeText($note);
}elseif ($type==='voice') {
	//用户发送语音信息
	$note = '你发送了一条语音信息.';
	$reply = $weixin->makeText($note);
}
//输出
$weixin->reply($reply);