<?php
namespace Tiramisu;
use GuzzleHttp\Client;

class Weather {
    protected $appkey;
    protected $url;

    /**
     * Weather constructor.
     * @param $key 天气key值
     */
    public function __construct(string $appkey){
        $this->appkey = $appkey;
        $this->url = "https://way.jd.com/he/freeweather"; #天气api地址
    }

    /**
     * @param string $city 城市名称 city=北京，city=beijing，city=CN101010100，city= 60.194.130.1
     */
    public function getWeather($city = ''){
        #未空调用当前 默认北京
        if (!$city){
            $city = $this->getIp();
        }
        $client = new Client();
        $response = $client->request("GET",$this->url,
            [
                #提交参数
                'query' => [
                    'city' => $city,
                    'appkey' => $this->appkey
                ]
            ]
        );
        $result = $response->getBody()->getContents();#获取数据
        $code = $response->getStatusCode();# 状态码
        $reason = $response->getReasonPhrase();# OK

        $data['code'] = $code;
        $data['result'] = $result;
        $data['reason'] = $reason;

        return $data;
    }

    /**
     * 获取当前地址ip
     */
    public function getIp(){
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
        {
            $IP = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $IP = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $IP = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $IP = $_SERVER['REMOTE_ADDR'];
        }
        return $IP ? $IP : "beijing";
    }


    public function test(){
        echo "test";
    }

}
