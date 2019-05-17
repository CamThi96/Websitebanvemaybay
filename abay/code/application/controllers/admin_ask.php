<?php
	require_once('admindefault.php');
	class Admin_Ask extends admindefault{
		function __Construct(){
			parent::__Construct();
			$this->load->model('mdnews');
		}
		
		function index(){
			$action=$this->uri->segment(3);
			if($action=='them'){
				$this->Add();
			}elseif($action=='sua'){
				$this->Update();
			}elseif($action=='xoa'){
				$this->mdnews->delete_news($this->uri->segment(4), 'ask');
				parent::HeaderAdmin($this->uri->segment(2));
			}else{
				$this->view();
			}
			$this->my_layout->output();
		}
		
		function Update(){
			if($_POST){
				$this->mdnews->change_news('news');
				parent::HeaderAdmin($this->uri->segment(2));
			}
			$data['title']='Câu Hỏi Thường Gặp';
			$data['news']=$this->mdnews->GetNews($this->uri->segment(4), 'ask');
			if($data['news']==false){
				parent::HeaderAdmin($this->uri->segment(2));
			}
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/news/change_news_no_image_summary', $data));
		}
		
		function Add(){
			if($_POST){
				$this->mdnews->add_news('ask');
				parent::HeaderAdmin($this->uri->segment(2));
			}
			$data['title']='Câu Hỏi Thường Gặp';
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/news/add_news_no_image_summary', $data));
		}
		
		function view(){
			$config=array(
				'full_tag_open'		=>	'<div class="pagenumber">',
				'full_tag_close'	=>	'</div>',
				'per_page'			=>	10,
				'base_url'			=>	base_url().$this->uri->segment(1).'/'.$this->uri->segment(2),
				'uri_segment'		=>	3,
				'total_rows'		=>	$this->mdnews->GetCountByType('ask'),
			);
			$this->pagination->initialize($config);
			$data['title']='Câu Hỏi Thường Gặp';
			(intval($this->uri->segment(3))<0)?$page=0:$page=intval($this->uri->segment(3));
			$data['news']=$this->mdnews->getNewsByType('ask', 10,$page);
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/news/view_all', $data));
		}
	}
?>