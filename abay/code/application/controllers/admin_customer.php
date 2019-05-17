<?php
	require_once('admindefault.php');
	class Admin_Customer extends admindefault{
		function __Construct(){
			parent::__Construct();
		}
		
		function index(){
			$act=$this->uri->segment(3);
			switch($act){
				case 'change':{
					$this->db->where('id', $this->uri->segment(4));
					$this->db->update('customer',array('status'=>intval(
										strip_tags($this->uri->segment(5))
										)));
					parent::HeaderAdmin($this->uri->segment(2));
				}
				default:{
					$this->_View_All();
				}
			}
			$this->my_layout->output();
		}
		
		function _View_All(){
			$config=array(
				'full_tag_open'		=>	'<div class="pagenumber">',
				'full_tag_close'	=>	'</div>',
				'uri_segment'		=>	3,
				'base_url'			=>	base_url().$this->uri->segment(1).'/'.$this->uri->segment(2),
				'per_page'			=>	10,
				'total_rows'		=>	$this->db->get('customer')->result_array(),
				'num_links'			=>	7,
			);
			$this->pagination->initialize($config);
			$this->db->order_by('status desc, time desc');
			(intval($this->uri->segment(3))<0)?$page=0:$page=intval($this->uri->segment(3));
			$this->db->limit(10, $page);
			$data['customer']=$this->db->get('customer')->result_array();
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/customer',$data));
		}
	}
?>