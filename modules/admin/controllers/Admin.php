<?php
class Admin extends MY_Controller{
	function index(){
		
		echo __FILE__;
	}
	function show(){
		print_r($this);
	}
}