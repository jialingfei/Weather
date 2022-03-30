<?php
namespace Tiramisu\test;

use Tiramisu\Weather;

require "../vendor/autoload.php";

class Test {

    public static function index(){
        Weather::test();
    }

    #请求天气
    public static function getWeather(){
        $weather = new Weather('da39dce4f8aa52155677ed8cd23a6470');
        $res = $weather->getWeather();
        print_r($res);die;
    }
}
Test::getWeather();die;
Test::index();