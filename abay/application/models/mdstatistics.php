<?php
	require_once("geoip.inc");
	class MdStatistics extends CI_Controller{
		private $log;
		function __Construct(){
			parent::__Construct();
			$this->load->database();
			$this->load->library('session');
			$id=$this->session->userdata('session_id');
			$timeout=time()-900;
			$this->db->query("delete from online where time<'$timeout'");
			$this->db->where('id',$id);
			$data=$this->db->get('online');
			if($data->num_rows()!=0){
				$data=$data->result_array();
				$this->log=$data[0]['content'];
				$this->db->where('id',$id);
				$this->db->update('online',array('time'=>time()));
			}else{
				$this->load->helper('php_browser_detection');
				$current = getdate();
    			$ngay=$current['year'].'-'.$current['mon'].'-'.$current['mday'];
				$phienban=browser_detection( 'browser_number' );
				$trinhduyet=browser_detection( 'browser_working' );
				$hdh=browser_detection( 'os' );
				$system=$this->os();
				$this->session->set_userdata('time',time());
				$ct=$this->getcountry();
				$this->log=$this->ip().' - '.$trinhduyet.' - '.$phienban.' - '.$hdh.' - '.$system.' - '.$ct['country_code'] .' - '.$ct['country_name'].' - '.date("Y-m-d H:i:s". ' - '.time());
				$this->db->insert('online',array('id'=>$id, 'time'=>time(), 'ip'=>$this->ip(),'content'=>$this->log));
				$this->db->where('type','yesterday');
				$data=$this->db->get('count');
				if($data->num_rows()==0){
					$this->db->insert('count',array('type'=>'yesterday', 'count'=>'0'));
				}
				$this->db->where('type','count');
				$data=$this->db->get('count');
				if($data->num_rows()==0){
					$this->db->insert('count',array('type'=>'count', 'count'=>'0'));
				}
				$this->db->where('type',$ngay);
				$data=$this->db->get('count');
				if($data->num_rows()==0){
					$data=$this->db->query('select * from count where type!=\'count\' and type!=\'yesterday\'')->result_array();
					//=$this->db->get('count')->result_array();
					$data=intval($data[0]['count']);
					$this->db->where('type','yesterday');
					$this->db->update('count',array('count'=>$data));
					$this->db->query('delete from count where type!=\'count\' and type!=\'yesterday\'');
					$this->db->insert('count',array('count'=>'1','type'=>$ngay));
				}else{
					$data=$data->result_array();
					$this->db->where('type',$ngay);
					$this->db->update('count',array('count'=>intval($data[0]['count'])+1));
				}
				$this->db->where('type','count');
				$data=$this->db->get('count')->result_array();
				$this->db->where('type','count');
				$this->db->update('count',array('count'=>intval($data[0]['count'])+1));
			}
		}
		
		function Get_log(){
			return $this->log;
		}
		
		function getonline(){
			$data=$this->db->get('online');
			return $data->num_rows();
		}
		
		function getcount(){
			$this->db->where('type','yesterday');
			$data['yesterday']=$this->db->get('count')->result_array();
			$data['yesterday']=$data['yesterday'][0]['count'];
			$this->db->where('type','count');
			$data['total']=$this->db->get('count')->result_array();
			$data['total']=$data['total'][0]['count'];
			$current = getdate();
    		$ngay=$current['year'].'-'.$current['mon'].'-'.$current['mday'];
			$this->db->where(array('type'=>$ngay));
			$data['today']=$this->db->get('count')->result_array();
			$data['today']=$data['today'][0]['count'];
			$data['online']=$this->getonline();
			return $data;
		}
		
		function getcountry(){
			$gi = geoip_open("GeoIP.dat",GEOIP_STANDARD);
			$data['country_code'] = geoip_country_code_by_addr($gi, $this->ip());
			$data['country_name'] = geoip_country_name_by_addr($gi, $_SERVER['REMOTE_ADDR']);
			geoip_close($gi);
			return $data;
		}
		
		function os(){
			$system=browser_detection( 'os_number' );
			switch($system){
				case 5:{
					return 'windows 2000';
					break;
				}
				case 5.1:{
					return 'windows xp';
					break;
				}
				case 5.2:{
					return 'Server 2003';
					break;
				}
				case 6.0:{
					return 'Windows Vista';
					break;
				}
				case 6.1:{
					return 'Windows 7';
					break;
				}
				default:{
					return $system;
				}
			}
		}
		
		function ip(){
			if(!empty($_SERVER['HTTP_CLIENT_IP'])){
				//check ip from share internet
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
				//to check ip is pass from proxy
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		}
	}
?>