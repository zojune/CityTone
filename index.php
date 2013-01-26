<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "zyftoke");
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();
$wechatObj->responseMsg();

class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>1</FuncFlag>
							</xml>";             
				if(!empty( $keyword ))
                {
              		$msgType = "text";
              		$contentStr="";
                	//$contentStr = "欢迎关注重庆城市通，你输入的是：".$keyword;
                    if($keyword=="tq")
                    {
                    	$url = "http://www.webxml.com.cn//WebServices/WeatherWS.asmx/getWeather?theCityCode=1599&theUserID=";
						if ($stream = fopen($url, 'r')) 
						{
							$xmlstring = stream_get_contents($stream, -1);

							$xml = simplexml_load_string($xmlstring);
							$strArray = $xml->string;

							echo $strArray[4];
							echo $strArray[7];
							echo $strArray[8];
							echo $strArray[12];
							echo $strArray[13];
							fclose($stream);
						}
                        $contentStr=$contentStr.$strArray[4]. ". ".$strArray[7]. ". ".$strArray[8]. ". ".$strArray[12]. ". ".$strArray[13];
                    }
                    elseif($keyword=="test")
                    {
                        $contentStr=$contentStr."。QQ:404722462".$fromUsername.":".$toUsername.":".$msgType;
                        //$to2="o7EPIjkbH5Eyivgw-lEmVJ7tf3Q0";
                        //$content2="第二条消息";
                        //$resultStr2 = sprintf($textTpl, $to2, $toUsername, $time, $msgType, $content2);
                        //echo $resultStr2;

                    }
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>