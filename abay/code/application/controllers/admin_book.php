<?php
	require_once('admindefault.php');
	class Admin_Book extends admindefault{
		function __Construct(){
			parent::__Construct();
		}
		
		function index(){
			$act=$this->uri->segment(3);
			switch($act){
				case 'xoa':{
					$this->db->where('id', $this->uri->segment(4));
					$this->db->delete('dat_ve');
					$this->db->where('id', $this->uri->segment(4));
					$this->db->delete('chi_tiet_dat_ve');
					parent::HeaderAdmin($this->uri->segment(2));
					break;
				}
				case 'xem':{
					$this->_View();
					break;
				}
				default:{
					$this->_View_All();
				}
			}
			$this->my_layout->output();
		}
		
		function _View(){
			if($_POST){
				$this->db->where('id', $this->uri->segment(4));
				$this->db->update('dat_ve', array(
					'tinh_trang'		=>	strip_tags($this->input->post('tinh_trang')),
					'trang_thai'		=>	strip_tags($this->input->post('trang_thai')),
				));
			}
			$this->db->where('id', $this->uri->segment(4));
			$this->db->update('dat_ve', array('status'=>1));
			$this->load->model('mdschedule');
			$this->load->model('mdairport');
			$id_book=$this->uri->segment(4);
			$this->db->where('id', $id_book);
			$data['book']=$this->db->get('dat_ve')->result_array();
			$data['book']=$data['book'][0];
			$this->db->where('id', $id_book);
			$data['book_detail']=$this->db->get('chi_tiet_dat_ve')->result_array();
			$data['bay_di']=$this->mdschedule->_Get_Schedule_By_Id($data['book']['ma_chuyen_bay_di']);
			$data['bay_ve']=$this->mdschedule->_Get_Schedule_By_Id($data['book']['ma_chuyen_bay_ve']);
			$data['noi_di']=$this->mdairport->_Get_Airport_Full_By_Id($data['bay_di']['airport_code_go']);
			$data['noi_den']=$this->mdairport->_Get_Airport_Full_By_Id($data['bay_di']['airport_code_to']);
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/book/detail', $data));
			//print_r($data);
			//print_r($data);
		}
		
		function _View_All(){
			$config=array(
				'full_tag_open'		=>	'<div class="pagenumber">',
				'full_tag_close'	=>	'</div>',
				'base_url'			=>	base_url().$this->uri->segment(1).'/'.$this->uri->segment(2),
				'per_page'			=>	20,
				'num_links'			=>	7,
				'uri_segment'		=>	3,
				'total_rows'		=>	$this->db->get('dat_ve')->num_rows(),
			);
			$this->pagination->initialize($config);
			(intval($this->uri->segment(3))<0)?$page=0:$page=intval($this->uri->segment(3));
			$this->db->limit(20, $page);
			$this->db->order_by('status asc, time desc');
			$data['dat_ve']=$this->db->get('dat_ve')->result_array();
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/book/view', $data));
		}
	}
?>