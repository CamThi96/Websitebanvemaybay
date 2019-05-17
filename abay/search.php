<?php
	/*mysql_connect('localhost', 'root', '') or die('false connect');
	mysql_select_db('abay') or die ('false select db');
	$str=$_GET['q'];
	$lenh=mysql_query("select * from airport_code, airport_country where (airport_code like '%$str%' or airport_name like '%$str%') and airport_country.country_code=airport_code.country_code limit 0,50");
	$result = array();
	while($cot=mysql_fetch_array($lenh)){
		 //echo $cot['airport_name'].' ('.$cot['airport_code'].') {'.$cot['airport_name'].' ('.$cot['airport_code'].') ';
		 ?>
         <?=$cot['airport_name']?> (<?=$cot['airport_code']?>) <b class='suggestCountry' style='float:right'><?=$cot['country_title']?></b>{<?=$cot['airport_name']?> (<?=$cot['airport_code']?>)
         <?php
		 //hà nội (HAN) <b class='suggestCountry' style='float:right'>việt nam</b>{hà nội (HAN)
		//array_push($result, array("id"=>$cot['airport_code'], "label"=>$cot['airport_name'], "value" => $cot['airport_code']));
	}
	//echo json_encode($result);*/
	
	$string = file_get_contents('http://www.abay.vn/Abay/Search/AutoSuggestV2.aspx?q='.str_replace(' ', '%20', $_GET['q']).'&limit=50&timestamp=1348543743736');
	print $string;
?>