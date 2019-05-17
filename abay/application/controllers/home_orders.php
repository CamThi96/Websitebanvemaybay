<?php
	require_once('home_default.php');
	class Home_Orders extends Home_Default{
		function __Construct(){
			parent::__Construct();
			$this->load->model(array('mdairport', 'mdschedule', 'mdairlines'));
			parent::_Add_Title('Thông Tin Đơn Hàng');
		}
		
		function index(){
			parent::_Set_Default_Right();
			$this->db->where('dat_ve.id',$this->uri->segment(2));
			$this->db->from('dat_ve');
			$data['orders']=$this->db->get()->result_array();
			$data['orders']=$data['orders'][0];
			$data['bay_di']=$this->mdschedule->_Get_schedule_By_id($data['orders']['ma_chuyen_bay_di']);
			$data['hang_bay_di']=$this->mdairlines->_Get_airlines_by_id($data['bay_di']['airlines_code']);
			$data['bay_ve']=$this->mdschedule->_Get_schedule_By_id($data['orders']['ma_chuyen_bay_ve']);
			$data['hang_bay_ve']=$this->mdairlines->_Get_airlines_by_id($data['bay_ve']['airlines_code']);
			$data['go']=$this->mdairport->_Get_airport_full_By_id($data['bay_di']['airport_code_go']);
			$data['to']=$this->mdairport->_Get_airport_full_By_id($data['bay_di']['airport_code_to']);
			$this->db->where('id', $data['orders']['id']);
			$data['orders_detail']=$this->db->get('chi_tiet_dat_ve')->result_array();
			if($this->valid_date($data['orders']['ngay_ve'],'DD-MM-YYYY') && $data['orders']['ma_chuyen_bay_ve']!=''){
				$data['total_price']=($data['orders']['nguoi_lon']*$data['bay_di']['gia_ve_nguoi_lon']+$data['orders']['tre_em']*$data['bay_di']['gia_ve_tre_em']+$data['orders']['em_be']*$data['bay_di']['gia_ve_em_be']);
				$data['total_price']+=($data['orders']['nguoi_lon']*$data['bay_ve']['gia_ve_nguoi_lon']+$data['orders']['tre_em']*$data['bay_ve']['gia_ve_tre_em']+$data['orders']['em_be']*$data['bay_ve']['gia_ve_em_be']);
				$data['total_price']+=$data['total_price']*($data['bay_di']['thue']/100);
				$data['total_price']+=($data['orders']['nguoi_lon']*$data['bay_di']['phi_nguoi_lon']+$data['orders']['tre_em']*$data['bay_di']['phi_tre_em']+$data['orders']['em_be']*$data['bay_di']['phi_em_be']);
				$data['total_price']+=($data['orders']['nguoi_lon']*$data['bay_ve']['phi_nguoi_lon']+$data['orders']['tre_em']*$data['bay_ve']['phi_tre_em']+$data['orders']['em_be']*$data['bay_ve']['phi_em_be']);
				parent::_Set_Default_Left($this->my_layout->input('front_end/content/orders_2', $data));
			}else{
				$data['total_price']=($data['orders']['nguoi_lon']*$data['bay_di']['gia_ve_nguoi_lon']+$data['orders']['tre_em']*$data['bay_di']['gia_ve_tre_em']+$data['orders']['em_be']*$data['bay_di']['gia_ve_em_be']);
				$data['total_price']+=$data['total_price']*($data['bay_di']['thue']/100);
				$data['total_price']+=($data['orders']['nguoi_lon']*$data['bay_di']['phi_nguoi_lon']+$data['orders']['tre_em']*$data['bay_di']['phi_tre_em']+$data['orders']['em_be']*$data['bay_di']['phi_em_be']);
				parent::_Set_Default_Left($this->my_layout->input('front_end/content/orders', $data));
			}
			$this->my_layout->output();
		}
		
		
		function valid_date($date, $format = 'YYYY-MM-DD'){
			if(strlen($date) >= 8 && strlen($date) <= 10){
				$separator_only = str_replace(array('M','D','Y'),'', $format);
				$separator = $separator_only[0];
				if($separator){
					$regexp = str_replace($separator, "\\" . $separator, $format);
					$regexp = str_replace('MM', '(0[1-9]|1[0-2])', $regexp);
					$regexp = str_replace('M', '(0?[1-9]|1[0-2])', $regexp);
					$regexp = str_replace('DD', '(0[1-9]|[1-2][0-9]|3[0-1])', $regexp);
					$regexp = str_replace('D', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp);
					$regexp = str_replace('YYYY', '\d{4}', $regexp);
					$regexp = str_replace('YY', '\d{2}', $regexp);
					if($regexp != $date && preg_match('/'.$regexp.'$/', $date)){
						foreach (array_combine(explode($separator,$format), explode($separator,$date)) as $key=>$value) {
							if ($key == 'YY') $year = '20'.$value;
							if ($key == 'YYYY') $year = $value;
							if ($key[0] == 'M') $month = $value;
							if ($key[0] == 'D') $day = $value;
						}
						if (checkdate($month,$day,$year)) return true;
					}
				}
			}
			return false;
		}
	}
?>