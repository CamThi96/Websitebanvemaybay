<?php
	require_once('admindefault.php');
	class Admin_Schedule extends admindefault{
		function __Construct(){
			parent::__Construct();
			$this->load->model('mdschedule');
		}
		
		function index(){
			$act=$this->uri->segment(3);
			switch($act){
				case 'them':{
					$this->_add();
					break;
				}
				case 'xoa':{
					$this->mdschedule->_delete($this->uri->segment(4));
					parent::HeaderAdmin($this->uri->segment(2));
					break;
				}
				case 'sua':{
					$this->_update();
					break;
				}
				default:{
					$this->_view_all();
				}
			}
			$this->my_layout->output();
		}
		
		function _update(){
			if($_POST)
			{
				$this->mdschedule->_update();
				parent::HeaderAdmin($this->uri->segment(2));
			}
			else
			{
				$data=$this->mdschedule->_Get_Schedule_By_Id($this->uri->segment(4));
				$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/schedule/change', $data));
			}
		}
		
		function _Add(){
			if($_POST)
			{
				$this->mdschedule->_Add();
				parent::HeaderAdmin($this->uri->segment(2));
			}
			else
			{
				$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/schedule/add', $data));
			}
		}
		
		function _View_All(){
			(intval($this->uri->segment(3))<0)?$page=0:$page=intval($this->uri->segment(3));
			$config=array(
				'total_rows'		=>	$this->mdschedule->_Count_All(),
				'per_page'			=>	20,
				'full_tag_open'		=>	'<div class="pagenumber">',
				'full_tag_close'	=>	'</div>',
				'num_links'			=>	7,
				'uri_segment'		=>	3,
				'base_url'			=>	base_url().$this->uri->segment(1).'/'.$this->uri->segment(2),
			);
			$this->pagination->initialize($config);
			$data['schedule']=$this->mdschedule->_Get_All(20, $page);
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/schedule/view', $data));
		}
	}
?>