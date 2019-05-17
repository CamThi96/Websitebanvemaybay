<?php
	require_once('admindefault.php');
	class Admin_Airlines extends admindefault{
		function __Construct(){
			parent::__Construct();
			$this->load->model('mdairlines');
		}
		
		function index(){
			$act=$this->uri->segment(3);
			switch($act){
				case 'them':{
					$this->_Add();
					break;
				}
				case'xoa':
				{
					$this->mdairlines->_delete($this->uri->segment(4));
					parent::HeaderAdmin($this->uri->segment(2));
				}
				case 'sua':{
					$this->_update();
					break;
				}
				default:{
					$this->_View_All();
				}
			}
			$this->my_layout->output();
		}
		
		function _Update(){
			if($_POST)
			{
				$this->mdairlines->_Change();
				parent::HeaderAdmin($this->uri->segment(2));
			}
			else
			{
				$data=$this->mdairlines->_Get_Airlines_By_Id($this->uri->segment(4));
				$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/airlines/change', $data));
			}
		}
		
		function _Add(){
			if($_POST)
			{
				$this->mdairlines->_Add();
				parent::HeaderAdmin($this->uri->segment(2));
			}
			else
			{
				$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/airlines/add'));
			}
		}
		
		function _View_All(){
			$config=array(
				'full_tag_open'			=>	'<div class="pagenumber">',
				'full_tag_close'		=>	'</div>',
				'total_rows'			=>	$this->mdairlines->_Count_All(),
				'per_page'				=>	10,
				'uri_segment'			=>	3,
				'base_url'				=>	base_url().$this->uri->segment(1).'/'.$this->uri->segment(2),
			);
			$this->pagination->initialize($config);
			(intval($this->uri->segment(3))<0)?$page=0:$page=intval($this->uri->segment(3));
			$data['airlines']=$this->mdairlines->_Get_All(10, $page);
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/airlines/view', $data));
		}
	}
?>