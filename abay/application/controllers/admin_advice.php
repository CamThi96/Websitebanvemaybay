<?php
	require_once('admindefault.php');
	class Admin_Advice extends admindefault{
		function __Construct(){
			parent::__Construct();
		}
		
		function index(){
			if($this->uri->segment(3)=='xoa'){
				$this->db->where('id', $this->uri->segment(4));
				$this->db->delete('advice');
				parent::HeaderAdmin($this->uri->segment(2));
			}
			$config=array(
				'full_tag_open'		=>	'<div class="pagenumber">',
				'full_tag_close'	=>	'</div>',
				'total_rows'		=>	$this->db->get('advice')->num_rows(),
				'per_page'			=>	10,
				'base_url'			=>	base_url().$this->uri->segment(1).'/'.$this->uri->segment(2),
				'num_links'			=>	7,
				'uri_segment'		=>	3,
			);
			$this->pagination->initialize($config);
			$this->db->order_by('status asc, time desc');
			(intval($this->uri->segment(3))<0)?$page=0:$page=intval($this->uri->segment(3));
			$this->db->limit(10, $page);
			$data['advice']=$this->db->get('advice')->result_array();
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/advice', $data));
			$this->my_layout->output();
		}
	}
?>