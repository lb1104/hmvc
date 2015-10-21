<?php
(defined('BASEPATH')) or exit('No direct script access allowed');

/* load the HMVC_Router class */

class MY_Router extends CI_Router {
    /**
     * Current module name
     *
     * @var string
     * @access public
     */
    var $module = '';
    var $locations = array();

    /*
     * 分析并构造路由
     */
    function _parse_routes() {

        $locations = $this->config->item('modules_locations');

        if (!$locations) {
            $locations = array('modules/');
        } else if (!is_array($locations)) {
            $locations = array($locations);
        }
        $this->locations = $locations;

        // Apply the current module's routing config
        if ($module = $this->uri->segment(0)) {

            foreach ($this->locations as $location) {
                if (is_file($file = $location . $module . '/config/routes.php')) {
                    include ($file);

                    $route = (!isset($route) or !is_array($route)) ? array() : $route;
                    $this->routes = array_merge($this->routes, $route);
                    unset($route);
                }
            }
        }

        //使用默认
        return parent::_parse_routes();
    }

    /**
     * 检测路径中是否包含需要的控制器文件
     *
     * @access	private
     * @param	array
     * @return	array
     */
    function _validate_request($segments) {

        if (count($segments) == 0) {
            return $segments;
        }
        // Locate the controller with modules support
        if ($located = $this->locate($segments)) {
            return $located;
        }

        return parent::_validate_request($segments);

    }



    /**
     * 寻找controller路径
     *
     * @param	array
     * @return	array
     */
    function locate($segments) {
        
        $module = $segments[0];

        foreach ($this->config->item('modules_locations') as $location) {
            $relative = APPPATH.$location;

            //如果 包含有 modules/$module/controllers文件夹
            if (is_dir($source = $relative . $module . '/controllers/')) {
                $this->module = $module;
                $this->directory =  '../'.$location.$module . '/controllers/';
                $seg=array_slice($segments,1);
            	$c=count($seg);
            	// var_dump($seg);
            	$i=0;
            	while($c-- > 0) {
            		$ac=current($seg);
            		$next=next($seg);
            		
                	// var_dump($c.'/'.$ac.'/'.$next);
            		// var_dump($source.$ac);

            		if ($ac && is_dir($source . $ac . '/')) {
                		$source .= $ac . '/';
                		$this->directory .= $ac . '/';
                		
            			if($next&&is_dir($source.$next.'/')){
            				// var_dump('next/');
            				$i++;
                			continue;
                		}
	                }
	                //var_dump($ac.'-'.$next);
                    if ($next && is_file($source . ucfirst($next) . '.php')) {
                    	// var_dump('next'.$source . ucfirst($next) . '.php');
                        return array_slice($seg, $i+1);
                    }
					
                    if (is_file($source . ucfirst($ac) . '.php')) {
                    	// var_dump('now'.$source . ucfirst($ac) . '.php');
                        return array_slice($seg, $i);
                    }
	                
            	}

            	//如果有 controllers/$module.php
                if (is_file($source . ucfirst($module) . '.php')) {
                    return $segments;
                }
                
            }
        }
        
    }
    
}