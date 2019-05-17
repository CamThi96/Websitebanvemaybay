<?php
	foreach($country as $val){
		?>
        	<option value="<?=$val['country_code']?>"><?=$val['country_title']?></option>
        <?php
	}
?>