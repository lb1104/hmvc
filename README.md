����codeigniter 3.0.2,  
�޸�https://git.oschina.net/liwenlong/Codeigniter-3-HMVC��Router  
�������޸���ci��system/core/Route.php  ,���������޸���һ��  
����ci3.0.2��controllers����������޼��ļ��У��޸���MY_Route�����modules/controller�Ĳ��ҷ���  
��MY_Loader.php��MY_Router.php���Ƶ�application/core/Ŀ¼��  
��application/config/config.php�����������  
```php
$config['modules_locations'] = array(
	'../modules/',
);
```

��չMY_Model,����M����,//application/helpers/model_helper.php  
$m=M('user');//����modules/models/User_model.php,�������򷵻�new MY_Model('user');  
//$m=M('admin/user');M('a/user');M('admin/a/user');//a/userΪmodules/models/a/User_model.php  
$m->find(1);  
$m->get_file();  
//=
$this->load->model('user_model');
//$this->load->model('a/user_model');
$this->user_model->get_file();