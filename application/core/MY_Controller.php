<?php

/**
 * 项目公用controller
 * Created by PhpStorm.
 * User: li
 * Date: 15-10-9
 * Time: 下午4:18
 */


/**
 * Class MY_Controller
 *
 * @property CI_Loader     $load
 * @property CI_Output     $output
 * @property CI_Input      $input
 * @property CI_Log        $log
 * @property CI_Pagination $pagination
 * @property CI_Session    $session
 *
 */
class MY_Controller extends CI_Controller
{
    /**
     * 模块
     *
     * @var string
     */
    protected $module = '';

    /**
     * 所在模块controllers下的目录名称
     *
     * @var string
     */
    protected $directory = '';

    /**
     * 控制器名称
     *
     * @var string
     */
    protected $controller;

    /**
     * 控制器方法名称
     *
     * @var string
     */
    protected $action;

    /**
     * 赋值给view的数据
     *
     * @var array
     */
    private $_data = array();

    public function __construct()
    {

        parent::__construct();

        $this->module = $this->router->module;
        $this->controller = $this->router->class;
        $this->action = $this->router->method;
        if (empty($this->module)) {
            $this->directory = trim($this->router->directory, '/');
        } else {
            $str = substr(
                $this->router->directory,
                strpos($this->router->directory, 'controllers')
            );
            $this->directory = substr($str, 12);
            $this->directory = trim($this->directory, '/');
            $this->directory = trim($this->directory, '\\');
        }
        //$this->load->helper('url');
        //$this->load->library('session');
    }
}