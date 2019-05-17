<?php
	class MdSchedule extends CI_Model{
		function __Construct(){
			parent::__Construct();
			$this->load->database();
		}
		
		function _Get_All($perpage, $page){
			$this->db->limit($perpage, $page);
			$this->db->order_by('ma_chuyen_bay');
			return $this->db->get('lich_bay')->result_array();
		}
		
		function _Count_All(){
			return $this->db->get('lich_bay')->num_rows();
		}
		
		function _Get_Schedule_By_Id($id){
			$this->db->where('ma_chuyen_bay =\''. $id.'\'');
			$data=$this->db->get('lich_bay');
			if($data->num_rows()==0)
			{
				return false;
			}
			else
			{
				$data=$data->result_array();
				return $data[0];
			}
		}
		
		function _Delete($id){
			$this->db->where('ma_chuyen_bay', $id);
			$this->db->delete('lich_bay');
		}
		
		function _Update(){
			$this->load->helper('unicode');
			$ma_chuyen_bay=strtoupper(khongdau(strip_tags($this->input->post('ma_chuyen_bay'))));
			$hang_bay=strip_tags($this->input->post('airlines_code'));
			$may_bay=strip_tags($this->input->post('may_bay'));
			$noi_di=strtoupper(strip_tags($this->input->post('noi_di')));
			$noi_den=strtoupper(strip_tags($this->input->post('noi_den')));
			$gio_di=$this->input->post('gio_di');
			$gio_den=$this->input->post('gio_den');
			$hang_ve=strip_tags($this->input->post('hang_ve'));
			$gia_ve_nguoi_lon=intval(strip_tags($this->input->post('gia_ve_nguoi_lon')));
			$gia_ve_tre_em=intval(strip_tags($this->input->post('gia_ve_tre_em')));
			$gia_ve_em_be=intval(strip_tags($this->input->post('gia_ve_em_be')));
			$phi_nguoi_lon=intval(strip_tags($this->input->post('phi_nguoi_lon')));
			$phi_em_be=intval(strip_tags($this->input->post('phi_em_be')));
			$phi_tre_em=intval(strip_tags($this->input->post('phi_tre_em')));
			$thue=intval(strip_tags($this->input->post('thue')));
			$date=$this->input->post('date');
			$tan_suat_bay=$date;
			$str='';
			foreach($tan_suat_bay as $val){
				$str.=$val.',';
			}
			$tan_suat_bay=$str;
			if($this->_Get_Schedule_By_Id($ma_chuyen_bay)!=false)
			{
				$this->db->where('ma_chuyen_bay', $this->uri->segment(4));
				$this->db->update('lich_bay', array(
					'ma_chuyen_bay'		=>	$ma_chuyen_bay,
					'ma_may_bay'		=>	$may_bay,
					'airport_code_go'	=>	$noi_di,
					'airport_code_to'	=>	$noi_den,
					'gio_di'			=>	$gio_di,
					'gio_den'			=>	$gio_den,
					'loai_ve'			=>	$hang_ve,
					'gia_ve_nguoi_lon'	=>	$gia_ve_nguoi_lon,
					'gia_ve_tre_em'		=>	$gia_ve_tre_em,
					'gia_ve_em_be'		=>	$gia_ve_em_be,
					'phi_nguoi_lon'		=>	$phi_nguoi_lon,
					'phi_tre_em'		=>	$phi_tre_em,
					'phi_em_be'			=>	$phi_em_be,
					'thue'				=>	$thue,
					'tan_suat_bay'		=>	$tan_suat_bay,
					'airlines_code'		=>	$hang_bay,
				));
			}
		}
		
		function _Add(){
			$this->load->helper('unicode');
			$ma_chuyen_bay=strtoupper(khongdau(strip_tags($this->input->post('ma_chuyen_bay'))));
			$hang_bay=strip_tags($this->input->post('airlines_code'));
			$may_bay=strip_tags($this->input->post('may_bay'));
			$noi_di=strtoupper(strip_tags($this->input->post('noi_di')));
			$noi_den=strtoupper(strip_tags($this->input->post('noi_den')));
			$gio_di=$this->input->post('gio_di');
			$gio_den=$this->input->post('gio_den');
			$hang_ve=strip_tags($this->input->post('hang_ve'));
			$gia_ve_nguoi_lon=intval(strip_tags($this->input->post('gia_ve_nguoi_lon')));
			$gia_ve_tre_em=intval(strip_tags($this->input->post('gia_ve_tre_em')));
			$gia_ve_em_be=intval(strip_tags($this->input->post('gia_ve_em_be')));
			$phi_nguoi_lon=intval(strip_tags($this->input->post('phi_nguoi_lon')));
			$phi_em_be=intval(strip_tags($this->input->post('phi_em_be')));
			$phi_tre_em=intval(strip_tags($this->input->post('phi_tre_em')));
			$thue=intval(strip_tags($this->input->post('thue')));
			$date=$this->input->post('date');
			$date=$this->input->post('date');
			$tan_suat_bay=$date;
			$str='';
			foreach($tan_suat_bay as $val){
				$str.=$val.',';
			}
			$tan_suat_bay=$str;
			if($this->_Get_Schedule_By_Id($ma_chuyen_bay)==false)
			{
				$this->db->insert('lich_bay', array(
					'ma_chuyen_bay'		=>	$ma_chuyen_bay,
					'ma_may_bay'		=>	$may_bay,
					'airport_code_go'	=>	$noi_di,
					'airport_code_to'	=>	$noi_den,
					'gio_di'			=>	$gio_di,
					'gio_den'			=>	$gio_den,
					'loai_ve'			=>	$hang_ve,
					'gia_ve_nguoi_lon'	=>	$gia_ve_nguoi_lon,
					'gia_ve_tre_em'		=>	$gia_ve_tre_em,
					'gia_ve_em_be'		=>	$gia_ve_em_be,
					'phi_nguoi_lon'		=>	$phi_nguoi_lon,
					'phi_tre_em'		=>	$phi_tre_em,
					'phi_em_be'			=>	$phi_em_be,
					'thue'				=>	$thue,
					'tan_suat_bay'		=>	$tan_suat_bay,
					'airlines_code'		=>	$hang_bay,
				));
			}
		}
	}
?>