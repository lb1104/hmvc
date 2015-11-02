<?php
class Admin extends MY_Controller{
	function index(){
		echo __FILE__;
	}
	function a($b='0'){
		echo 'admin/a'.$b;
	}
}