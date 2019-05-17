<?php
	require_once('home_default.php');
	class Home_Search extends Home_Default{
		function __Construct(){
			parent::__Construct();
			parent::_Set_Default_Right();
			$this->load->model(array('mdairport', 'mdsearch', 'mdschedule'));
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
		
		function index(){
			if($_POST && ($this->uri->segment(9)!='xac-nhan-don-hang')){
				$diem_di=strtoupper(trim(strip_tags($this->input->post('go'))));
				$diem_di=explode('(',$diem_di);
				$diem_di=$diem_di[count($diem_di)-1];
				$diem_di=explode(')',$diem_di);
				$diem_di=$diem_di[0];
				$diem_den=strtoupper(trim(strip_tags($this->input->post('to'))));
				$diem_den=explode('(',$diem_den);
				$diem_den=$diem_den[count($diem_den)-1];
				$diem_den=explode(')',$diem_den);
				$diem_den=$diem_den[0];
				$ngay_di=strip_tags($this->input->post('date_go'));
				$ngay_ve=strip_tags($this->input->post('date_back'));
				//isdate
				if($this->valid_date($ngay_ve,'DD-MM-YYYY')==false){
					$ngay_ve='NULL';
				}
				$nguoi_lon=intval(strip_tags($this->input->post('cboAdult')));
				$tre_em=intval(strip_tags($this->input->post('cboChild')));
				$em_be=intval(strip_tags($this->input->post('cboInfant')));
				$url=$diem_di.'/'.$diem_den.'/'.$nguoi_lon.'/'.$tre_em.'/'.$em_be.'/'.$ngay_di.'/'.$ngay_ve.'/';
				/*$this->db->insert('thong_tin_tim_kiem', array(
					'id'		=>	time(),
					'nguoi_lon'	=>	$nguoi_lon,
					'tre_em'	=>	$tre_em,
					'em_be'		=>	$em_be,
					'ngay_di'	=>	$ngay_di,
					'ngay_ve'	=>	$ngay_ve,
					'diem_di'	=>	$diem_di,
					'diem_den'	=>	$diem_den,
				));*/
				header('location:'.base_url().$this->uri->segment(1).'/'.$url);
				exit;
			}elseif($_POST && ($this->uri->segment(9)=='xac-nhan-don-hang')){
				$id=rand(100000000,999999999);
				$nguoi_lon=$this->input->post('Adult');
				$ten_nguoi_lon=$this->input->post('txtFullNameAdult');
				$tre_em=$this->input->post('Child');
				$ngay_tre_em=$this->input->post('DayChild');
				$thang_tre_em=$this->input->post('MonthChild');
				$nam_tre_em=$this->input->post('YearChild');
				$ten_tre_em=$this->input->post('txtFullNameChild');
				$em_be=$this->input->post('Infant');
				$ngay_em_be=$this->input->post('DayInfant');
				$thang_em_be=$this->input->post('MonthInfant');
				$nam_em_be=$this->input->post('YearInfant');
				$ten_em_be=$this->input->post('txtFullNameInfant');
				for($i=0;$i<intval($this->uri->segment(4));$i++){
					$this->db->insert('chi_tiet_dat_ve', array(
						'id'		=>	$id,
						'loai_nguoi'=>	$nguoi_lon[$i],
						'ten_nguoi'	=>	strip_tags($ten_nguoi_lon[$i]),
					));
				}
				
				for($i=0;$i<intval($this->uri->segment(5));$i++){
					$this->db->insert('chi_tiet_dat_ve', array(
						'id'		=>	$id,
						'loai_nguoi'=>	$tre_em[$i],
						'ten_nguoi'	=>	strip_tags($ten_tre_em[$i]),
						'ngay_sinh'	=>	strip_tags($ngay_tre_em[$i]).'/'.strip_tags($thang_tre_em[$i]).'/'.strip_tags($nam_tre_em[$i]),
					));
				}
				
				for($i=0;$i<intval($this->uri->segment(6));$i++){
					$this->db->insert('chi_tiet_dat_ve', array(
						'id'		=>	$id,
						'loai_nguoi'=>	$em_be[$i],
						'ten_nguoi'	=>	strip_tags($ten_em_be[$i]),
						'ngay_sinh'	=>	strip_tags($ngay_em_be[$i]).'/'.strip_tags($thang_em_be[$i]).'/'.strip_tags($nam_em_be[$i]),
					));
				}
				
				$quy_danh=$this->input->post('Gender');
				$ten=$this->input->post('FullNameContact');
				$email=$this->input->post('Email');
				$so_dien_thoai=$this->input->post('Mobile');
				$quoc_gia=$this->input->post('country');
				$thanh_pho=$this->input->post('City');
				$dia_chi=$this->input->post('Street');
				$hoa_don=$this->input->post('IsInvoice');
				$ten_cong_ty=$this->input->post('NameInvoice');
				$dia_chi_cong_ty=$this->input->post('Address');
				$ma_so_thue=$this->input->post('Tax');
				$dia_chi_nhan_hoa_don=$this->input->post('InvoiceAddress');
				$nhan_thong_tin=$this->input->post('IsReceiveInformation');
				$yeu_cau=$this->input->post('txtRemark');
				$noi_di=strtoupper(strip_tags($this->uri->segment(2)));
				$noi_den=strtoupper(strip_tags($this->uri->segment(3)));
				$nguoi_lon=intval(strip_tags($this->uri->segment(4)));
				$tre_em=intval(strip_tags($this->uri->segment(5)));
				$em_be=intval(strip_tags($this->uri->segment(6)));
				$ngay_di=strip_tags($this->uri->segment(7));
				$ngay_ve=strip_tags($this->uri->segment(8));
				$ma_chuyen_bay_di=strtoupper(strip_tags($this->uri->segment(10)));
				$ma_chuyen_bay_ve=strtoupper(strip_tags($this->uri->segment(11)));
				$this->db->insert('dat_ve', array(
					'id'				=>	$id,
					'time'				=>	time(),
					'ngay_di'			=> 	$ngay_di,
					'ngay_ve'			=>	$ngay_ve,
					'nguoi_lon'			=>	$nguoi_lon,
					'tre_em'			=>	$tre_em,
					'em_be'				=>	$em_be,
					'ma_chuyen_bay_di'	=>	$ma_chuyen_bay_di,
					'ma_chuyen_bay_ve'	=>	$ma_chuyen_bay_ve,
					'ho_ten_nguoi_nhan'	=>	$ten,
					'dia_chi_nguoi_nhan'=>	$dia_chi,
					'email_nguoi_nhan'	=>	$email,
					'so_dien_thoai'		=>	$so_dien_thoai,
					'quoc_gia'			=>	$quoc_gia,
					'thanh_pho'			=>	$thanh_pho,
					'hoa_don'			=>	$hoa_don,
					'ten_cong_ty'		=>	$ten_cong_ty,
					'ma_so_thue'		=>	$ma_so_thue,
					'dia_chi_nhan_hoa_don'=>	$dia_chi_nhan_hoa_don,
					'dia_chi_cong_ty'	=>	$dia_chi_cong_ty,
					'nhan_thong_tin'	=>	$nhan_thong_tin,
					'yeu_cau'			=>	$yeu_cau,
					'quy_danh'			=>	$quy_danh,
					'tinh_trang'		=>	'chưa được thanh toán',
					'trang_thai'		=>	'chờ xác nhận',
				));
				header('location:'.base_url().'thong-tin-don-hang/'.$id);
				exit;
			}
			$act=$this->uri->segment(2);
			//if($this->uri->segment(9)=='xac-nhan-don-hang'){
			//	$this->_Order_information();
			//}else{
				switch($act){
					default:{
						$this->_search();
					}
				}
			//}
			$this->my_layout->output();
		}
		
		function _Order_information(){
			//$data['order']=$this->mdschedule->_Get_
			parent::_Set_Default_Left($this->my_layout->input('front_end/content/order_information', $data));
		}
		
		function _Search(){
			$noi_di=strtoupper(strip_tags($this->uri->segment(2)));
			$noi_den=strtoupper(strip_tags($this->uri->segment(3)));
			$nguoi_lon=intval(strip_tags($this->uri->segment(4)));
			$tre_em=intval(strip_tags($this->uri->segment(5)));
			$em_be=intval(strip_tags($this->uri->segment(6)));
			$ngay_di=strip_tags($this->uri->segment(7));
			$ngay_ve=strip_tags($this->uri->segment(8));
			if($this->valid_date($ngay_di,'DD-MM-YYYY')){
			//if($ngay_di!=''){
				$newDate = preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$2/$1/$3",$ngay_di);
				$dt = strtotime($newDate);
				$day = date("N", $dt);
				$this->session->set_userdata('date_go', $day);
				$day=$day+1;
				$ngay_di=$day;
				if($this->valid_date($ngay_ve,'DD-MM-YYYY')){
					$newDate = preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$2/$1/$3",$ngay_ve);
					$dt = strtotime($newDate);
					$day = date("N", $dt);
					$this->session->set_userdata('date_back', $day);
					$day=$day+1;
					$ngay_ve=$day;
				}
				if($this->uri->segment(9)=='xac-nhan-don-hang'){
					$xnnv=$this->mdschedule->_Get_Schedule_By_Id($this->uri->segment(11));
					//print_r($xnnv);
					if((intval($ngay_ve)!=0) && $xnnv==false){
						$this->_Chon_Cuu_Hoi($noi_di, $noi_den, $ngay_ve);
					}elseif(intval($ngay_ve)!=0){
						parent::_Add_Title('Xác Nhận Đơn Hàng');
						$data['orders']=$this->mdsearch->_Xac_Nhan_Don_Hang($noi_di, $noi_den, $ngay_di, $this->uri->segment(10));
						$data['go']=$this->mdairport->_Get_Airport_full_By_Id($this->uri->segment(2));
						$data['to']=$this->mdairport->_Get_Airport_full_By_Id($this->uri->segment(3));
						//print_r($data['orders_back']);
						$data['time_go']=explode(':',$data['orders']['gio_di']);
						$data['time_go']=$data['time_go'][0]*3600+$data['time_go'][1]*60+$data['time_go'][2];
						$data['time_to']=explode(':',$data['orders']['gio_den']);
						$data['time_to']=$data['time_to'][0]*3600+$data['time_to'][1]*60+$data['time_to'][2];
						if($data['time_to']<$data['time_go'])$data['time_to']=$data['time_to']+(24*3600);
						$data['time']=$data['time_to']-$data['time_go'];
						//print_r($data);
						$data['orders_back']=$this->mdsearch->_Xac_Nhan_Don_Hang($noi_den, $noi_di, $ngay_ve, $this->uri->segment(11));
						$data['time_back_go']=explode(':',$data['orders_back']['gio_di']);
						$data['time_back_go']=$data['time_back_go'][0]*3600+$data['time_back_go'][1]*60+$data['time_back_go'][2];
						$data['time_back_to']=explode(':',$data['orders_back']['gio_den']);
						$data['time_back_to']=$data['time_back_to'][0]*3600+$data['time_back_to'][1]*60+$data['time_back_to'][2];
						if($data['time_back_to']<$data['time_back_go'])$data['time_back_to']=$data['time_back_to']+(24*3600);
						$data['time_back']=$data['time_back_to']-$data['time_back_go'];
						parent::_Set_Default_Left($this->my_layout->input('front_end/content/order_information_2', $data));
					}else{
						parent::_Add_Title('Xác Nhận Đơn Hàng');
						$data['orders']=$this->mdsearch->_Xac_Nhan_Don_Hang($noi_di, $noi_den, $ngay_di, $this->uri->segment(10));
						$data['go']=$this->mdairport->_Get_Airport_full_By_Id($this->uri->segment(2));
						$data['to']=$this->mdairport->_Get_Airport_full_By_Id($this->uri->segment(3));
						$data['time_go']=explode(':',$data['orders']['gio_di']);
						$data['time_go']=$data['time_go'][0]*3600+$data['time_go'][1]*60+$data['time_go'][2];
						$data['time_to']=explode(':',$data['orders']['gio_den']);
						$data['time_to']=$data['time_to'][0]*3600+$data['time_to'][1]*60+$data['time_to'][2];
						if($data['time_to']<$data['time_go'])$data['time_to']=$data['time_to']+(24*3600);
						$data['time']=$data['time_to']-$data['time_go'];
						//print_r($data);
						parent::_Set_Default_Left($this->my_layout->input('front_end/content/order_information', $data));
					}
				}else{
					//if(intval($ngay_ve)!=0)
					//{
						//$ngay_ve='NULL';
					//}
					//else
					//{
						$this->_tim_ve_mot_chieu($noi_di, $noi_den, $ngay_di);
					//}
				}
			}else{
				parent::_Set_Default_Left($this->my_layout->input('front_end/error_search'));
			}
		}
		
		function _Xac_nhan_cuu_hoi(){
			
		}
		
		function _Chon_Cuu_Hoi($noi_di, $noi_den, $ngay_ve){
			parent::_Add_Title('Tìm Vé Khứ Hồi');
			$this->load->model('mdsearch');
			$data['lich_bay']=$this->mdsearch->_tim_ve_mot_chieu($noi_den, $noi_di, $ngay_ve);
			if(count($data['lich_bay'])!=0){
				$price=$this->uri->segment(4)*$data['lich_bay'][0]['gia_ve_nguoi_lon']+$this->uri->segment(5)*$data['lich_bay'][0]['gia_ve_tre_em']+$this->uri->segment(6)*$data['lich_bay'][0]['gia_ve_em_be'];
				$price+=($data['lich_bay'][0]['thue']/100)*$price;
				$price+=$this->uri->segment(4)*$data['lich_bay'][0]['phi_nguoi_lon']+$this->uri->segment(5)*$data['lich_bay'][0]['phi_tre_em']+$this->uri->segment(6)*$data['lich_bay'][0]['phi_em_be'];
				$this->db->where(array('diem_di'=>$noi_di, 'diem_den'=>$noi_den, 'sess_id'=>$this->session->userdata('session_id'), 'status'=>0));
				$price_list=$this->db->get('thong_tin_tim_kiem')->result_array();
				$this->db->where(array('diem_di'=>$noi_di, 'diem_den'=>$noi_den, 'sess_id'=>$this->session->userdata('session_id'), 'status'=>0));
				$this->db->update('thong_tin_tim_kiem',array('gia_ve'=>$price_list[0]['gia_ve']+$price, 'status'=>1, 'time'=>time()));
			}
			parent::_Set_Default_Right();
			//print_r($data);
			parent::_Set_Default_Left($this->my_layout->input('front_end/content/search_2', $data));
		}
		
		function _tim_ve_mot_chieu($noi_di, $noi_den, $ngay_di){
			parent::_Add_Title('Tìm Vé Một Chiều');
			$this->load->model('mdsearch');
			$data['lich_bay']=$this->mdsearch->_tim_ve_mot_chieu($noi_di, $noi_den, $ngay_di);
			//print_r($data);
			if(count($data['lich_bay'])!=0){
				//print_r($data['lich_bay'][0]);
				$this->db->where(array('id'=> $data['lich_bay'][0]['ma_chuyen_bay'], 'sess_id'=>$this->session->userdata('session_id'), 'ngay_di'=>$ngay_di));
				if($this->db->get('thong_tin_tim_kiem')->num_rows()==0){
					$price=$this->uri->segment(4)*$data['lich_bay'][0]['gia_ve_nguoi_lon']+$this->uri->segment(5)*$data['lich_bay'][0]['gia_ve_tre_em']+$this->uri->segment(6)*$data['lich_bay'][0]['gia_ve_em_be'];
					$price+=($data['lich_bay'][0]['thue']/100)*$price;
					$price+=$this->uri->segment(4)*$data['lich_bay'][0]['phi_nguoi_lon']+$this->uri->segment(5)*$data['lich_bay'][0]['phi_tre_em']+$this->uri->segment(6)*$data['lich_bay'][0]['phi_em_be'];
					//$this->session->set_userdata($this->session->userdata('sessi', time());
					$this->db->insert('thong_tin_tim_kiem', array(
						'id'		=>	$data['lich_bay'][0]['ma_chuyen_bay'],
						'nguoi_lon'	=>	$this->uri->segment(4),
						'tre_em'	=>	$this->uri->segment(5),
						'em_be'		=>	$this->uri->segment(6),
						'ngay_di'	=>	$this->uri->segment(7),
						'ngay_ve'	=>	$this->uri->segment(8),
						'diem_di'	=>	$this->uri->segment(2),
						'diem_den'	=>	$this->uri->segment(3),
						'gia_ve'	=>	$price,
						'sess_id'	=>	$this->session->userdata('session_id'),
						'status'	=>	0,
						'time'		=>	time(),
					));
				}
			}
			parent::_Set_Default_Right();
			parent::_Set_Default_Left($this->my_layout->input('front_end/content/search_1', $data));
		}
	}
?>