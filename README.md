# weather
天气查询

### 引入包文件
```
composer require tiramisu/weather
```

### 申请天气接口appkey

天气接口地址  https://www.free-api.com/doc/462

### 使用

```
use Tiramisu\Weather;

public function index(){
    $weather = new Weather("申请的key值");
    $res = $weather->getWeather();
}
```