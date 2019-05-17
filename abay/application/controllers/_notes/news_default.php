<?php
	require_once('right_default.php');
	class News_Default extends right_Default{
		var $obj;
		function __Construct(){
			parent::__Construct();
			$this->obj=&get_instance();
			$this->obj->load->model('mdnews');
			$this->my_layout->set_data('content_for_title_website', 'Tin Tức - '.$this->my_layout->get_data('content_for_title_website'));
		}
		
		function index(){
			$this->Show_News();
			$this->my_layout->output();
		}
		
		function Show_News(){
			if($this->uri->segment(3)!=''){
				$data['news']=$this->obj->mdnews->getNewsBySub($this->uri->segment(3), $this->uri->segment(2));
				if($data['news']!=false){
					$data['not_news']=$this->obj->mdnews->GetNewsNotId($this->uri->segment(3));
					parent::Content_for_left($this->my_layout->input('front_end/news', $data));
					$this->my_layout->set_data('content_for_title_website', $data['news']['title']. ' - ' .$this->my_layout->get_data('content_for_title_website'));
				}else{
					$this->Show_news_sub();
				}
			}else{
				$this->Show_news_sub();
			}
		}
		
		function Show_news_sub(){
			if($this->uri->segment(2)==''){
				$this->Show_all_News();
			}else{
				$data=$this->obj->mdnews->CheckSub($this->uri->segment(2));
				if($data==false){
					$this->Show_all_News();
				}else{
					unset($data);
					$data['news']=$this->obj->mdnews->GetAllNewsBySub($this->uri->segment(2));
					$data['title']='Tin Tức '.strtoupper($this->uri->segment(2));
					parent::Content_for_left($this->my_layout->input('front_end/list_news', $data));
					$this->my_layout->set_data('content_for_title_website', $data['title']. ' - ' .$this->my_layout->get_data('content_for_title_website'));
				}
			}
		}
		
		function Show_all_News(){
			$data['ipod']=$this->obj->mdnews->GetTopNewsBySub('ipod');
			$data['iphone']=$this->obj->mdnews->GetTopNewsBySub('iphone');
			$data['ipad']=$this->obj->mdnews->GetTopNewsBySub('ipad');
			$data['mac']=$this->obj->mdnews->GetTopNewsBySub('mac');
			parent::Content_for_left($this->my_layout->input('front_end/news_module',$data));
		}
	}
?>