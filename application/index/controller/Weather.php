<?php
namespace app\index\controller;

class Weather
{
    public function index()
    {
		//this.requestByKey();
        //return '哈哈哈';
    }
	
	function requestByKey(){
        //准备请求参数
        $key ="5c8171a1a1224a30ae226a2df6236574";
        $location = "北京";
        $curlPost = "key=".$key."&location=".urlencode($location);
        //初始化请求链接
        $req=curl_init();
        //设置请求链接
        curl_setopt($req, CURLOPT_URL,'https://free-api.heweather.com/s6/weather/now?'.$curlPost);
        //设置超时时长(秒)
        curl_setopt($req, CURLOPT_TIMEOUT,3);
        //设置链接时长
        curl_setopt($req, CURLOPT_CONNECTTIMEOUT,10);
        //设置头信息
        $headers=array( "Accept: application/json", "Content-Type: application/json;charset=utf-8" );
        curl_setopt($req, CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($req, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($req);
        curl_close($req);
        return $data;
    }
	
	
	
	function requestBySign(){
        //准备请求参数（需要替换）
        $key ="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
        $params['location']='北京';
        //（需要替换）
        $params['username']='YYYYYYYYYYYYYYYYYYYYY';
        $params['t']=time();
        $sign = getSignature($params, $key);
        $curlPost = "sign=".$sign."&location=".urlencode($params['location'])."&username=".$params['username']."&t=".$params['t'];
        var_dump($curlPost);
        //初始化请求链接
        $req=curl_init();
        //设置请求链接
        curl_setopt($req, CURLOPT_URL,'https://free-api.heweather.com/s6/weather/now?'.$curlPost);
        //设置超时时长(秒)
        curl_setopt($req, CURLOPT_TIMEOUT, 3);
        
        //设置链接时长
        curl_setopt($req, CURLOPT_CONNECTTIMEOUT, 10);
        
        //设置头信息
        $headers=array( "Accept: application/json", "Content-Type: application/json;charset=utf-8" );
        curl_setopt($req, CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($req, CURLOPT_SSL_VERIFYHOST, false);
        
        $data = curl_exec($req);
        curl_close($req);
        return $data;
    }

    /**
     * 和风天气签名生成算法-PHP版本
     * @param array $params API调用的请求参数集合的关联数组（全部需要传递的参数组成的数组），不包含sign参数
     * @param $secret 用户的认证 key
     * @return string 返回参数签名值
     */
    function getSignature($params, $secret) {
        $str = '';  //待签名字符串
        //先将参数以其参数名的字典序升序进行排序
        array_filter($params);
        unset($params['sign']);
        unset($params['key']);
        ksort($params);
        //遍历排序后的参数数组中的每一个key/value对
        foreach($params as $k => $v){
            $str .= $k . '=' . $v . '&';
        }
        $str = substr($str,0,strlen($str)-1);
        //将签名密钥拼接到签名字符串最后面
        $str .= $secret;
        //通过md5算法为签名字符串生成一个md5签名，该签名就是我们要追加的sign参数值
        return base64_encode(md5($str, true));
    }
}
