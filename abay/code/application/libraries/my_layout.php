<?php
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class My_Layout{
		var $obj;
		var $layout;
		var $data;
		
		function My_Layout($layout=''){
			$this->obj=&get_instance();
			$this->layout=$layout;
			$this->data=array();
		}
		
		function Set_Layout($layout=''){
			$this->layout=$layout;
		}
		
		function Set_Data($dataname, $value){
			$this->data[$dataname]=$value;
		}
		
		function Get_Data($dataname){
			return $this->data[$dataname];
		}
		
		function OutPut(){
			$this->obj->load->view($this->layout, $this->data);
		}
		
		function InPut($filename, $data=''){
			return $this->obj->load->view($filename, $data, true);
		}
	}
?>