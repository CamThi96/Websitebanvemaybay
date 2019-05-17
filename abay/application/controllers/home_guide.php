<?php
	require_once('home_default.php');
	class Home_Guide extends Home_Default{
		function __Construct(){
			parent::__Construct();
			parent::_Add_Title('Hướng Dẫn Đặt Vé');
		}
		
		function index(){
			parent::_Set_Default_Right();
			$this->load->model('mdpost');
			$data['content']=$this->mdpost->GetPostByCode('huong-dan-dat-ve');
			$data['content']=$data['content']['content_vi'];
			$data['title']='Hướng Dẫn Đặt Vé';
			parent::_Set_Default_Left($this->my_layout->input('front_end/left', $data));
			parent::_set_Default_Nav();
			$this->my_layout->output();
		}
	}
?>