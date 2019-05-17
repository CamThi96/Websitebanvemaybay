<?php
	require_once('right_default.php');
	class Services_Default extends right_Default{
		var $obj;
		function __Construct(){
			parent::__Construct();
			$this->obj=&get_instance();
			$this->obj->load->model('mdnews');
			$this->my_layout->set_data('content_for_title_website', 'Dịch Vụ - '.$this->my_layout->get_data('content_for_title_website'));
		}
		
		function index(){
			$this->Show_News();
			$this->my_layout->output();
		}
		
		function Show_News(){
			if($this->uri->segment(2)==''){
				$this->Show_all_news();
			}else{
				$data['news']=$this->obj->mdnews->GetNews($this->uri->segment(2), 'services');
				if($data['news']==false){
					$this->Show_all_news();
				}else{
					$this->my_layout->set_data('content_for_title_website', $data['news']['title'].' - '.$this->my_layout->get_data('content_for_title_website'));
					$data['not_news']=$this->obj->mdnews->GetNewsNotId($this->uri->segment(2));
					parent::Content_for_left($this->my_layout->input('front_end/news', $data));
				}
			}
		}
		
		function Show_all_news(){
			$data['news']=$this->obj->mdnews->GetNewsByType('services', 99999, 0);
			$data['title']='Dịch Vụ';
			parent::Content_for_left($this->my_layout->input('front_end/list_news', $data));
		}
	}
?>