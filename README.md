# phpUpdateConfig
php 更新自定义配置文件函数

-- 

### usage

```php
<?php

include 'update_config.php';

/**
 * 修改config_path配置文件中gift_id = 2 的 probability配置为90
 */
$config_path = __DIR__ . '/config.php';
$res = update_config(['gift_id' => 2], ['probability' => '  90'], $config_path);

var_dump($res);
```
