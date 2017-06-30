<?php
require_once('config.php');

//TOKEN
$api = $w3cview->select("siteset", "id='1'");
define("TOKEN", $api['token']);
define("APPID", $api['appid']);
define("APPSECRET", $api['appsecret']);

$wechatObj = new wechatCallbackapiTest();
if (!isset($_GET['echostr'])) {
    $wechatObj->responseMsg();
}else{
    $wechatObj->valid();
}

class wechatCallbackapiTest
{
    //验证消息
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    //检查签名
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if($tmpStr == $signature){
            return true;
        }else{
            return false;
        }
    }

    //响应消息
    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            switch ($RX_TYPE)
            {
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
                case "image":
                    $result = $this->receiveImage($postObj);
                    break;
				default:
                    $result = $this->receiveText($postObj);  //默认文本
                    break;
            }
            echo $result;
        }else {
            echo "";
            exit;
        }
    }

    //接收事件消息
    private function receiveEvent($object)
    {
        //添加关注用户
		$ACCESS_LIST = $this->curl(APPID, APPSECRET);//获取到的凭证
		
		if($ACCESS_LIST['access_token']!='')
		{
			$access_token = $ACCESS_LIST['access_token'];//获取到ACCESS_TOKEN
			$user = $this->curl_user($access_token, $object->FromUserName);
			if(!empty($user) && $user['nickname'] != "")
			{
				$w3cview = new BLL();
				$sql = "select * from " . $w3cview->prefix . "member where username='".$user['openid']."'";
				$query = $w3cview->query($sql);
				if($arr = mysql_fetch_array($query))
				{
					$w3cview->query("update " . $w3cview->prefix . "member set `join`='1' where id='".$arr['id']."'");
				}
				else{
					$w3cview->query("insert into " . $w3cview->prefix . "member set `username`='".$user['openid']."',`nickname`='".$user['nickname']."',`logo`='".$user['headimgurl'].".jpg',`registertime`='".date("Y-m-d H:i:s")."',`join`='1'");
				}
			}
		}
		
		$result = $this->transmitPic($object);
        return $result;
    }

    //接收文本消息
    private function receiveText($object)
    {
		$note = $object->Content;  //接收到的文本消息

		$createtime = time();
        $funcflag = $this->setFlag ? 1 : 0;
        $newTplHeader = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>{%s}</CreateTime>
        <MsgType><![CDATA[%s]]></MsgType>
        <ArticleCount>%s</ArticleCount><Articles>";
        $newTplItem = "<item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <Url><![CDATA[%s]]></Url>
            </item>";
        $newTplFoot = "</Articles>
            <FuncFlag>%s</FuncFlag>
            </xml>";
        $content = '';
		$w3cview = new BLL();
		$sql = "select * from " . $w3cview->prefix . "returninfor order by id asc";
		$result = $w3cview->query($sql);
		$keywords = "";
		while($arrs = mysql_fetch_array($result))
		{
			if($keywords == "") $keywords = $arrs['keyword']." ".$arrs['title'];
			else $keywords .= ",".$arrs['keyword']." ".$arrs['title'];
			
			if(trim($arrs['keyword']) == trim($note)){
				if ($arrs['url'] != "" && $arrs['picurl'] != ""){
					$type = 1;
					$content = sprintf($newTplItem,$arrs['title'],$arrs['description'],'http://'.$_SERVER['HTTP_HOST']."/".$arrs['picurl'],$arrs['url']);
				}
				else{
					 $type = 2;
					 $content = $arrs['description'];
				}
			}	
		}
        $header = sprintf($newTplHeader, $object->FromUserName, $object->ToUserName, time(), "news", 1);
        $footer = sprintf($newTplFoot,$funcflag);
		if($type == 1) $result = $content != '' ? $header . $content . $footer : $this->transmitText($object, "请输入关键词:".$keywords);
		else $result = $content != '' ? $this->transmitText($object, $content) : $this->transmitText($object, "请输入关键词:".$keywords);
        return $result;
    }

    //接收图片消息
    private function receiveImage($object)
    {
		$picurl = $object->PicUrl;
		$picurl = $picurl.".jpg";  //接收到的图片消息
		$result = $this->transmitText($object, "欢迎光临于家堡商业街区");
		return $result;
    }
	
    //回复文本消息
    private function transmitText($object, $content)
    {
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }
	
	//回复客服消息
    private function transmitService($object)
    {
        $textTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[transfer_customer_service]]></MsgType>
</xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
	
	//回复图文消息
    public function transmitPic($object)
    {
        $createtime = time();
        $funcflag = $this->setFlag ? 1 : 0;
        $newTplHeader = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>{%s}</CreateTime>
        <MsgType><![CDATA[%s]]></MsgType>
        <ArticleCount>%s</ArticleCount><Articles>";
        $newTplItem = "<item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <Url><![CDATA[%s]]></Url>
            </item>";
        $newTplFoot = "</Articles>
            <FuncFlag>%s</FuncFlag>
            </xml>";
        $content = '';
		$w3cview = new BLL();
		$sql = "select * from " . $w3cview->prefix . "message order by id asc";
		$itemsCount = $w3cview->getrecordcount($sql);
        $itemsCount = $itemsCount < 10 ? $itemsCount : 10;//微信公众平台图文回复的消息一次最多10条
        if ($itemsCount)
         {
            $result = $w3cview->query($sql);
			while($arrs = mysql_fetch_array($result))
			{
				if($itemsCount > 1) $content .= sprintf($newTplItem,$arrs['title'],$arrs['description'],'http://'.$_SERVER['HTTP_HOST']."/".$arrs['picurl'],$arrs['url'])."\r\n";//微信的信息数据
				else
				{
					if($itemsCount == 1)  //单条
					{
						if($arrs['picurl'] != "") $content = sprintf($newTplItem,$arrs['title'],$arrs['description'],'http://'.$_SERVER['HTTP_HOST']."/".$arrs['picurl'],$arrs['url']);//微信的信息数据
						else $content = $arrs['description'];
					}
				}
			}
         }
        $header = sprintf($newTplHeader, $object->FromUserName, $object->ToUserName, time(), "news", $itemsCount);
        $footer = sprintf($newTplFoot,$funcflag);
		if($itemsCount == 1) $return = $this->transmitText($object, $content);
		else $return = $header . $content . $footer;
        return $return;
    }
	
	//获取ACCESS_TOKEN
	public function curl($appid, $appsecret)
	{
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$tmpInfo = curl_exec($ch); 
		if (curl_errno($ch)) {  
		  echo 'Errno'.curl_error($ch);
		}
		curl_close($ch); 
		$arr = json_decode($tmpInfo,true);
		return $arr;
	}
	
	//获取用户信息
	public function curl_user($ACCESS_TOKEN, $openid)
	{
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$ACCESS_TOKEN."&openid=".$openid); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$tmpInfo = curl_exec($ch); 
		if (curl_errno($ch)) {  
		  echo 'Errno'.curl_error($ch);
		}
		curl_close($ch); 
		$arr = json_decode($tmpInfo,true);
		return $arr;
	}
	
	public function getip()
	{
		$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
		$user_IP = ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"];
		return $user_IP;
	}
}
?>