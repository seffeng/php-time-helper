## PHP Helpers

### 安装

```shell
# 安装
$ composer require seffeng/time-helper
```

### 目录说明

```
|---src
|   |   Time.php
|   |---Traits
|           TimeTrait.php
|---tests
|       TimeTest.php
```

### 示例

```php
/**
 * TestController.php
 * 示例
 */
namespace App\Http\Controllers;

use Seffeng\TimeHelper\Time;

class TestController extends Controller
{
    public function index()
    {
        var_dump(Time::asWeekCN(time()));

        var_dump(Time::asTimestampDiff(strtotime('2022-01-01'), time()));
    }
}
```

### 备注

1、更多示例请参考 tests 目录下测试文件。