<?php
	require_once('right_default.php');
	class Content extends Right_Default{
		var $obj;
		function __Construct(){
			parent::__Construct();
			$this->obj=&get_instance();
		}
		
		function index(){
			$this->obj->load->model('mdpost');
			$data=$this->obj->mdpost->GetPostByCode($this->uri->segment(1));
			parent::Content_for_left($this->my_layout->input('front_end/post', $data));
			$this->my_layout->set_data('content_for_title_website', $data['title']. ' - ' .$this->my_layout->get_data('content_for_title_website'));
			$this->my_layout->output();
		}
	}
?>