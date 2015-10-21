基于codeigniter 3.0.2,  
修改https://git.oschina.net/liwenlong/Codeigniter-3-HMVC  
由于他修改了ci的system/core/Route.php  ,所以重新修改了一下  
由于ci3.0.2在controllers里面可以无限层级文件夹，修改了MY_Route里面的modules/controller的查找方法  
将MY_Loader.php和MY_Router.php复制到application/core/目录下  
在application/config/config.php里面添加如下  
```php
$config['modules_locations'] = array(
	'../modules/',
);
```
