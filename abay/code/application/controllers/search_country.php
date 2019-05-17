<?php
	class Search_Country extends CI_Controller{
		function index(){
			$this->load->database();
			error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
			$str=$this->input->get('q');
			$str=str_replace(' ', '%', $str);
			//$lenh=mysql_query("select * from airport_code, airport_country where (airport_code like '%$str%' or airport_name like '%$str%') and airport_country.country_code=airport_code.country_code limit 0,50");
			$this->db->where("country_code like '%$str%' or country_title like '%$str%'");
			$this->db->from('airport_country');
			//$this->db->join('airport_country', 'airport_country.country_code=airport_code.country_code');
			$this->db->limit(50);
			$str=$this->db->get()->result_array();
			foreach($str as $cot){
				?>
                <?=$cot['country_title']?> (<?=$cot['country_code']?>){<?=$cot['country_code']?>
                
                <?php
			}
			//$string = file_get_contents('http://www.abay.vn/Abay/Search/AutoSuggestV2.aspx?q='.str_replace(' ', '%20', $_GET['q']).'&limit=50&timestamp=1348543743736');
			//print $string;
		}
	}
?>