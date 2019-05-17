<?php
	require_once('home_default.php');
	class Right_Default extends Home_Default{
		var $obj;
		function __Construct(){
			parent::__Construct();
			$this->obj=&get_instance();
			$this->obj->load->model(array('mdproduct', 'mdnews'));
			$this->obj->load->library('cart');
			$this->obj->cart->product_name_rules.="\pL";
			$this->Content_for_right();
		}
		
		function Content_for_right(){
			$data['yahoo']=$this->db->get('yahoo')->result_array();
			$data['services']=$this->obj->mdnews->GetNewsByType('services', 100, 0);
			$data['top_product']=$this->obj->mdproduct->GetAllTopProduct();
			$data['orders']=$this->obj->cart->contents();
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('front_end/right', $data));
		}
		
		function Content_for_left($str){
			$this->my_layout->set_data('content_for_website', $str.$this->my_layout->get_data('content_for_website'));
		}
		
	}
?>