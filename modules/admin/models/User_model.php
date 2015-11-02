<?php 

class User_model extends MY_Model{

	function get_file(){
		return __FILE__;
	}

	function get1(){
		return $this->find(1);
	}

}
