<?php
	class Search_Airlines extends CI_Controller{
		function index(){
			$this->load->database();
			$str=$this->input->get('q');
			$str=str_replace(' ', '%', $str);
			//$lenh=mysql_query("select * from airport_code, airport_country where (airport_code like '%$str%' or airport_name like '%$str%') and airport_country.country_code=airport_code.country_code limit 0,50");
			$this->db->where("id like '%$str%' or title like '%$str%'");
			$this->db->from('airlines');
			$this->db->limit(50);
			$str=$this->db->get()->result_array();
			foreach($str as $cot){
				?>
                <?=$cot['title']?> (<?=$cot['id']?>){<?=$cot['id']?>
                
                <?php
			}
			//$string = file_get_contents('http://www.abay.vn/Abay/Search/AutoSuggestV2.aspx?q='.str_replace(' ', '%20', $_GET['q']).'&limit=50&timestamp=1348543743736');
			//print $string;
		}
	}
?>