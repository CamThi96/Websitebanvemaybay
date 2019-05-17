<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Th_Layout{
		var $obj;
    	var $layout;
		var $data;
		
		function Th_Layout($layout = ""){
        	$this->obj =& get_instance();
        	$this->layout = $layout;
			$this->data=array();
    	}
		
		function SetLayout($layout)
    	{
      		$this->layout = $layout;
    	}
		
		function SetData($dataname, $val){
			$this->data[$dataname]=$val;
		}
		
		function GetData($dataname){
			return $this->data[$dataname];
		}
		
		function OutPut(){
			$this->obj->load->view($this->layout,$this->data);
		}
		
		function InPut($view, $data){
			return $this->obj->load->view($view,$data,true);
		}
		
		function View($view, $return=false){
			if($return)
			{
				$output = $this->obj->load->view($view, $this->data, true);
				return $output;
			}
			else
			{
				$this->obj->load->view($view, $this->data, false);
			}
   		}
	}
?>