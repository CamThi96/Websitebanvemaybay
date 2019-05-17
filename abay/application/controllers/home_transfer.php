<?php
	require_once('home_default.php');
	class Home_Transfer extends Home_Default{
		function __Construct(){
			parent::__Construct();
			parent::_Add_Title('Thông Tin Chuyển Khoản');
		}
		
		function index(){
			parent::_Set_Default_Right();
			$this->load->model('mdpost');
			$data['content']=$this->mdpost->GetPostByCode('thong-tin-chuyen-khoan');
			$data['content']=$data['content']['content_vi'];
			$data['title']='Thông Tin Chuyển Khoản';
			parent::_Set_Default_Left($this->my_layout->input('front_end/left', $data));
			parent::_set_Default_Nav();
			$this->my_layout->output();
		}
	}
?>