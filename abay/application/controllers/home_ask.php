<?php
	require_once('home_default.php');
	class Home_Ask extends Home_Default{
		function __Construct(){
			parent::__Construct();
			$this->load->library('pagination');
			$this->load->model('mdnews');
			parent::_Add_Title('Câu Hỏi Thường Gặp');
		}
		
		function index(){
			parent::_Set_Default_Right();
			$this->_Check_news();
			
			parent::_set_Default_Nav();
			$this->my_layout->output();
		}
		
		function _Check_news(){
			if($this->uri->segment(2)==''){
				$this->_View_All();
			}else{
				$data['news']=$this->mdnews->GetNews($this->uri->segment(2), 'ask');
				if($data['news']==false){
					$this->_View_All();
				}else{
					$data['title']=$data['news']['title_vi'];
					$data['content']=$data['news']['content_vi'];
					parent::_Add_Title($data['title']);
					parent::_Set_Default_Left($this->my_layout->input('front_end/left', $data));
				}
			}
		}
		
		function _View_All(){
			$config=array(
				'full_tag_open'		=>	'<div class="pagenumber">',
				'full_tag_close'	=>	'</div>',
				'total_rows'		=>	$this->mdnews->GetCountByType('ask'),
				'per_page'			=>	10,
				'uri_segment'		=>	2,
				'num_links'			=>	5,
				'base_url'			=>	base_url().$this->uri->segment(1),
			);
			$this->pagination->initialize($config);
			(intval($this->uri->segment(2))<0)?$page=0:$page=intval($this->uri->segment(2));
			$data['news']=$this->mdnews->GetNewsByType('ask', 10, $page);
			parent::_Set_Default_Left($this->my_layout->input('front_end/content/all_ask',$data));
		}
	}
?>