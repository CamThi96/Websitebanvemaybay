<?php
	class MdSearch extends CI_Model{
		function __Construct(){
			parent::__Construct();
			$this->load->database();
		}
		
		function _Xac_Nhan_Don_Hang($noi_di, $noi_den, $ngay_di, $ma_chuyen_bay){
			$this->db->where(array('airport_code_go'=>$noi_di, 'airport_code_to'=>$noi_den, 'tan_suat_bay like'=>"%{$ngay_di}%", 'ma_chuyen_bay'=>$ma_chuyen_bay));
			$this->db->join('airlines', 'lich_bay.airlines_code=airlines.id');
			//$this->db->limit($per_page, $page);
			$this->db->from('lich_bay');
			$data=$this->db->get()->result_array();
			return $data[0];
		}
		
		function _Tim_Ve_Mot_Chieu($noi_di, $noi_den, $ngay_di, $per_page=10, $page=0){
			//$this->db->where("airport_code_go='{$noi_di}' and airport_code_to='{$noi_den}' and tan_suat_bay like '%$ngay_di%'");
			$this->db->where(array('airport_code_go'=>$noi_di, 'airport_code_to'=>$noi_den, 'tan_suat_bay like'=>"%{$ngay_di}%"));
			$this->db->join('airlines', 'lich_bay.airlines_code=airlines.id');
			$this->db->limit($per_page, $page);
			$this->db->from('lich_bay');
			return $this->db->get()->result_array();
		}
	}
?>