<?php
	class MdAirlines extends CI_Model{
		function __Construct(){
			parent::__Construct();
			$this->load->database();
		}
		
		function _Count_All(){
			return $this->db->get('airlines')->num_rows();
		}
		
		function _Get_All($perpage, $page){
			$this->db->limit($perpage, $page);
			return $this->db->get('airlines')->result_array();
		}
		
		function _Delete($id){
			$data=$this->_Get_Airlines_By_Id($id);
			unlink('public/uploads/logos/'.$data['image']);
			$this->db->where('id', $id);
			$this->db->delete('airlines');
		}
		
		function _Change(){
			/*
			$this->table->add_row('Hành Lý Xách Tay', form_input('hanh_ly_xach_tay'));
			$this->table->add_row('Hàng Lý Ký Gửi', form_input('hanh_ly_ky_gui'));
			$this->table->add_row('Hoàn Vé', form_input('hoan_ve'));
			$this->table->add_row('Đổi Tên Hành Khách', form_input('doi_ten'));
			$this->table->add_row('Đổi Hành Trình', form_input('doi_hanh_trinh'));
			$this->table->add_row('Đổi Ngày Giờ Bay', form_input('doi_ngay_gio'));
			$this->table->add_row('Bảo Lưu', form_input('bao_luu'));
			$this->table->add_row('Đổi Chuyến Bay', form_input('doi_chuyen_bay'));
			$this->table->add_row('Nâng Hạng', form_input('nang_hang'));
			$this->table->add_row('Thời Hạn Dừng Tối Đa', form_input('thoi_han_dung'));
			$this->table->add_row('Thời Gian Thay Đổi', form_input('thoi_gian_doi'));
			*/
			$hanh_ly_xach_tay=strip_tags($this->input->post('hanh_ly_xach_tay'));
			$hanh_ly_ky_gui=strip_tags($this->input->post('hanh_ly_ky_gui'));
			$hoan_ve=strip_tags($this->input->post('hoan_ve'));
			$doi_ten=strip_tags($this->input->post('doi_ten'));
			$doi_hanh_trinh=strip_tags($this->input->post('doi_hanh_trinh'));
			$doi_ngay_gio=strip_tags($this->input->post('doi_ngay_gio'));
			$bao_luu=strip_tags($this->input->post('bao_luu'));
			$doi_chuyen_bay=strip_tags($this->input->post('doi_chuyen_bay'));
			$nang_hang=strip_tags($this->input->post('nang_hang'));
			$thoi_han_dung=strip_tags($this->input->post('thoi_han_dung'));
			$thoi_gian_doi=strip_tags($this->input->post('thoi_gian_doi'));
			$image=$_FILES['user_file']['name'];
			$title=strip_tags($this->input->post('airlines_name'));
			$id=$this->uri->segment(4);
			if($image!='')
			{
				$data=$this->_Get_Airlines_By_Id($id);
				unlink('public/uploads/logos/'.$data['image']);
				$this->load->library('my_img');
				$data=$this->my_img->upload('public/uploads/logos');
				$this->my_img->doresize(49, 29, $data['upload_data']['full_path'], $data['upload_data']['full_path']);
				$this->db->where('id', $id);
				$this->db->update('airlines', array(
					'image'		=>	$data['upload_data']['file_name'],
				));
			}
				$this->db->where('id', $id);
				$this->db->update('airlines', array(
					'title'		=>	$title,
					'hanh_ly_xach_tay'		=>	$hanh_ly_xach_tay,
					'hanh_ly_ky_gui'		=>	$hanh_ly_ky_gui,
					'hoan_ve'				=>	$hoan_ve,
					'doi_ten'				=>	$doi_ten,
					'doi_hanh_trinh'		=>	$doi_hanh_trinh,
					'doi_ngay_gio'			=>	$doi_ngay_gio,
					'bao_luu'				=>	$bao_luu,
					'doi_chuyen_bay'		=>	$doi_chuyen_bay,
					'nang_hang'				=>	$nang_hang,
					'thoi_han_dung'			=>	$thoi_han_dung,
					'thoi_gian_doi'			=>	$thoi_gian_doi,
				));
		}
		
		function _Add(){
			$hanh_ly_xach_tay=strip_tags($this->input->post('hanh_ly_xach_tay'));
			$hanh_ly_ky_gui=strip_tags($this->input->post('hanh_ly_ky_gui'));
			$hoan_ve=strip_tags($this->input->post('hoan_ve'));
			$doi_ten=strip_tags($this->input->post('doi_ten'));
			$doi_hanh_trinh=strip_tags($this->input->post('doi_hanh_trinh'));
			$doi_ngay_gio=strip_tags($this->input->post('doi_ngay_gio'));
			$bao_luu=strip_tags($this->input->post('bao_luu'));
			$doi_chuyen_bay=strip_tags($this->input->post('doi_chuyen_bay'));
			$nang_hang=strip_tags($this->input->post('nang_hang'));
			$thoi_han_dung=strip_tags($this->input->post('thoi_han_dung'));
			$thoi_gian_doi=strip_tags($this->input->post('thoi_gian_doi'));
			$this->load->helper('unicode');
			$title=strip_tags($this->input->post('airlines_name'));
			$id=khongdau($title);
			if($this->_Get_Airlines_By_Id($id)==false){
				$this->load->library('my_img');
				$data=$this->my_img->upload('public/uploads/logos');
				$this->my_img->doresize(49, 29, $data['upload_data']['full_path'], $data['upload_data']['full_path']);
				//print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
				//print($data['log']);
				$this->db->insert('airlines', array(
					'id'		=>	$id,
					'title'		=>	$title,
					'image'		=>	$data['upload_data']['file_name'],
					'hanh_ly_xach_tay'		=>	$hanh_ly_xach_tay,
					'hanh_ly_ky_gui'		=>	$hanh_ly_ky_gui,
					'hoan_ve'				=>	$hoan_ve,
					'doi_ten'				=>	$doi_ten,
					'doi_hanh_trinh'		=>	$doi_hanh_trinh,
					'doi_ngay_gio'			=>	$doi_ngay_gio,
					'bao_luu'				=>	$bao_luu,
					'doi_chuyen_bay'		=>	$doi_chuyen_bay,
					'nang_hang'				=>	$nang_hang,
					'thoi_han_dung'			=>	$thoi_han_dung,
					'thoi_gian_doi'			=>	$thoi_gian_doi,
				));
			}
		}
		
		function _Get_Airlines_By_Id($id){
			$this->db->where('id', $id);
			$data=$this->db->get('airlines');
			if($data->num_rows()!=0)
			{
				$data=$data->result_array();
				return $data[0];
			}
			else{
				return false;
			}
		}
	}
?>