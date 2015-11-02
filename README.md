基于codeigniter 3.0.2,  
修改https://git.oschina.net/liwenlong/Codeigniter-3-HMVC的Router  
由于他修改了ci的system/core/Route.php  ,所以重新修改了一下  
由于ci3.0.2在controllers里面可以无限级文件夹，修改了MY_Route里面的modules/controller的查找方法  
将MY_Loader.php和MY_Router.php复制到application/core/目录下  
在application/config/config.php里面添加如下  
```php
$config['modules_locations'] = array(
	'../modules/',
);
```

扩展MY_Model,定义M函数,//application/helpers/model_helper.php  
$m=M('user');//加载modules/models/User_model.php,不存在则返回new MY_Model('user');  
//$m=M('admin/user');M('a/user');M('admin/a/user');//a/user为modules/models/a/User_model.php  
$m->find(1);  
$m->get_file();  
//=
$this->load->model('user_model');
//$this->load->model('a/user_model');
$this->user_model->get_file();