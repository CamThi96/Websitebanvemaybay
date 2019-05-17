<?php
	class Search_code extends CI_Controller{
		function index(){
			$this->load->database();
			$str=$this->input->get('q');
			$str=str_replace(' ', '%', $str);
			//$lenh=mysql_query("select * from airport_code, airport_country where (airport_code like '%$str%' or airport_name like '%$str%') and airport_country.country_code=airport_code.country_code limit 0,50");
			$this->db->where("airport_code like '%$str%' or airport_name like '%$str%'");
			$this->db->from('airport_code');
			$this->db->join('airport_country', 'airport_country.country_code=airport_code.country_code');
			$this->db->limit(50);
			$str=$this->db->get()->result_array();
			foreach($str as $cot){
				?>
                <?=$cot['airport_name']?> (<?=$cot['airport_code']?>) <b class='suggestCountry' style='float:right'><?=$cot['country_title']?></b>{<?=$cot['airport_code']?>
                <?php
			}
			//$string = file_get_contents('http://www.abay.vn/Abay/Search/AutoSuggestV2.aspx?q='.str_replace(' ', '%20', $_GET['q']).'&limit=50&timestamp=1348543743736');
			//print $string;
		}
	}
?>