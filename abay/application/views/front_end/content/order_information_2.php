<div class="tvo_left_section">
<style>
	.tvo_left_section table,tr,td{
		border:0px;
	}
	.thong-tin-lien-he td { vertical-align:top;}
.thong-tin-lien-he input[type="text"] { width:100%;}
.thong-tin-lien-he label { line-height:22px; font-weight:bold; color:#999; }
.thong-tin-lien-he label span { font-size:11px; font-weight:normal; color:#999;}
.thong-tin-lien-he select { width:100%; height:30px;}
.thong-tin-lien-he input{
	height:30px;
}
</style>
<form method="post" action="<?=base_url()?><?=$this->uri->uri_string()?>">
	<span class="sdb p5" style="font-weight:bold; font-size:20px; color:#143B85">Thông tin chuyến bay</span>
    <table class="tb0" width="100%">
    	<tr>
        	<td width="14%"><img src="<?=base_url()?>public/style/img/flight-icon.png" style="width:80px; position:absolute"></td>
            <td width="14%">Chuyến Bay :<br>Ngày xuất phát:</td>
            <td width="18%" style="font-weight:bold">Khứ hồi<br><?=$this->uri->segment(7)?></td>
            <td width="20%">Số lượng hành khách :<br>Ngày về:</td>
            <td width="44%" style="font-weight:bold">
            	<?php
					if($this->uri->segment(4)!=0)print $this->uri->segment(4).' người lớn, ';
					if($this->uri->segment(5)!=0)print $this->uri->segment(5).' trẻ em, ';
					if($this->uri->segment(6)!=0)print $this->uri->segment(6).' em bé';
				?>
            	<br><?=$this->uri->segment(8)?></td>
        </tr>
    </table>
    <span class="dsb p5"></span>
    <span class="dsb p5"></span>
    <p style="background:#F1F1F1; border-top:1px solid #E5E5E5; font-size:13px; padding:2px; position:relative; line-height:30px;">
    	<img src="<?=base_url()?>public/style/img/OutBound.png" style="float:left; margin-right:30px;" >
        Khởi hành từ <strong><?=$go['airport_name']?>, <?=$go['country_title']?></strong>
        <span class="dsb" style="position:absolute; width:200px; top:2px; right:10px;">Thời gian : <strong><?=intval($time/3600)?> giờ : <?php
			if($time>3600){
				$time=$time%3600;
				$toi=$this->uri->segment(8);
			}
			else
			{
				$toi=$this->uri->segment(7);
				$toi=explode('-', $toi);
				$toi=$toi[1].'/'.$toi[0].'/'.$toi[2];
				$toi=strtotime($toi);
				$toi=$toi+1*24*60*60;
				$toi=date('d-m-Y', $toi);
			}
			print intval($time/60);
        ?> phút</strong></span>
  		<span class="clear dsb"></span>
    </p>
    <table width="100%" class="tb0" style="line-height:140%">
    	<tr>
        	<td width="10%">
            	<img src="<?=base_url()?>public/uploads/logos/<?=$orders['image']?>" style="position:absolute">
            </td>
            <td width="37%">
            	Từ: <strong><?=$go['airport_name']?></strong> (<?=$go['airport_code']?>)<br>
                <strong><?=$orders['gio_di']?></strong>, <?=$this->uri->segment(7)?>
            </td>
            <td width="37%">
            	Tới: <strong><?=$to['airport_name']?></strong> (<?=$to['airport_code']?>)<br>
                <strong><?=$orders['gio_den']?></strong>, <?=$toi?>
            </td>
            <td width="16%">
            	<?=$orders['title']?>
                <br>(<strong><?=$orders['ma_may_bay']?></strong>)<br>
                Loại vé: <strong><?=$orders['loai_ve']?></strong>
            </td>
        </tr>
    </table>
    
    <!-- *************************************************************** -->
    <span class="dsb p5"></span>
    <span class="dsb p5"></span>
    <p style="background:#F1F1F1; border-top:1px solid #E5E5E5; font-size:13px; padding:2px; position:relative; line-height:30px;">
    	<img src="<?=base_url()?>public/style/img/InBound.png" style="float:left; margin-right:30px;" >
        Khởi hành từ <strong><?=$to['airport_name']?>, <?=$to['country_title']?></strong>
        <span class="dsb" style="position:absolute; width:200px; top:2px; right:10px;">Thời gian : <strong><?=intval($time_back/3600)?> giờ : <?php
			if($time_back>3600){
				$time_back=$time_back%3600;
				$toi=$this->uri->segment(8);
			}
			else
			{
				$toi=$this->uri->segment(8);
				$toi=explode('-', $toi);
				$toi=$toi[1].'/'.$toi[0].'/'.$toi[2];
				$toi=strtotime($toi);
				$toi=$toi+1*24*60*60;
				$toi=date('d-m-Y', $toi);
			}
			print intval($time_back/60);
        ?> phút</strong></span>
  		<span class="clear dsb"></span>
    </p>
    <table width="100%" class="tb0" style="line-height:140%">
    	<tr>
        	<td width="10%">
            	<img src="<?=base_url()?>public/uploads/logos/<?=$orders['image']?>" style="position:absolute">
            </td>
            <td width="37%">
            	Từ: <strong><?=$to['airport_name']?></strong> (<?=$to['airport_code']?>)<br>
                <strong><?=$orders_back['gio_di']?></strong>, <?=$this->uri->segment(8)?>
            </td>
            <td width="37%">
            	Tới: <strong><?=$go['airport_name']?></strong> (<?=$go['airport_code']?>)<br>
                <strong><?=$orders_back['gio_den']?></strong>, <?=$toi?>
            </td>
            <td width="16%">
            	<?=$orders_back['title']?>
                <br>(<strong><?=$orders_back['ma_may_bay']?></strong>)<br>
                Loại vé: <strong><?=$orders_back['loai_ve']?></strong>
            </td>
        </tr>
    </table>
    <!-- *********************** -->
    <span class="sdb p5" style="font-weight:bold; font-size:20px; color:#143B85">Điều kiện giá vé</span>
    <div class="p5 mgb5" style="border-bottom:1px solid #CCC;"></div>
    <p style="font-size:14px; font-weight:bold; padding:10px;">Điều kiện giá vé chiều đi</p>
     <table width="100%" class="tb0">
                    	<?php
							if(trim($orders['hoan_ve'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Hoàn Vé</td>
                                        <td width="70%"><?=$orders['hoan_ve']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders['doi_ten'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Đổi Tên Hành Khách</td>
                                        <td width="70%"><?=$orders['doi_ten']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders['doi_hanh_trinh'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Đổi Hành Trình</td>
                                        <td width="70%"><?=$orders['doi_hanh_trinh']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders['doi_ngay_gio'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Đổi Ngày Giờ Chuyến Bay</td>
                                        <td width="70%"><?=$orders['doi_ngay_gio']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders['bao_luu'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Bảo Lưu</td>
                                        <td width="70%"><?=$orders['bao_luu']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders['thoi_gian_doi'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay, hành trình)</td>
                                        <td width="70%"><?=$orders['thoi_gian_doi']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders['doi_chuyen_bay'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Thay đổi chuyến bay</td>
                                        <td width="70%"><?=$orders['doi_chuyen_bay']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders['nang_hang'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Nâng Hạng</td>
                                        <td width="70%"><?=$orders['nang_hang']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders['thoi_han_dung'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Thời Hạn Dừng Tối Đa</td>
                                        <td width="70%"><?=$orders['thoi_han_dung']?></td>
                                    </tr>
                                <?php
							}
						?>
                    </table>
                    
    <p style="font-size:14px; font-weight:bold; padding:10px;">Điều kiện giá vé chiều về</p>
    <table width="100%" class="tb0">
                    	<?php
							if(trim($orders_back['hoan_ve'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Hoàn Vé</td>
                                        <td width="70%"><?=$orders_back['hoan_ve']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders_back['doi_ten'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Đổi Tên Hành Khách</td>
                                        <td width="70%"><?=$orders_back['doi_ten']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders_back['doi_hanh_trinh'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Đổi Hành Trình</td>
                                        <td width="70%"><?=$orders_back['doi_hanh_trinh']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders_back['doi_ngay_gio'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Đổi Ngày Giờ Chuyến Bay</td>
                                        <td width="70%"><?=$orders_back['doi_ngay_gio']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders_back['bao_luu'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Bảo Lưu</td>
                                        <td width="70%"><?=$orders_back['bao_luu']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders_back['thoi_gian_doi'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay, hành trình)</td>
                                        <td width="70%"><?=$orders_back['thoi_gian_doi']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders_back['doi_chuyen_bay'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Thay đổi chuyến bay</td>
                                        <td width="70%"><?=$orders_back['doi_chuyen_bay']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders_back['nang_hang'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Nâng Hạng</td>
                                        <td width="70%"><?=$orders_back['nang_hang']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($orders_back['thoi_han_dung'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Thời Hạn Dừng Tối Đa</td>
                                        <td width="70%"><?=$orders_back['thoi_han_dung']?></td>
                                    </tr>
                                <?php
							}
						?>
                    </table>
    <div class="p5 mgb5"></div>
	<span class="sdb p5" style="font-weight:bold; font-size:20px; color:#143B85">Thông tin hành lý</span>
    <div class="p5 mgb5" style="border-bottom:1px solid #CCC;"></div>
    
    <p style="font-size:14px; font-weight:bold; padding:10px;">Hành lý chiều đi</p>
                    <table class="tb0" width="100%">
                    	<tr>
                        	<td width="30%">Hành lý xách tay</td>
                            <td width="70%"><?=$orders['hanh_ly_xach_tay']?></td>
                        </tr>
                        <tr>
                        	<td>Hàng lý ký gửi</td>
                            <td><?=$orders['hanh_ly_ky_gui']?></td>
                        </tr>
                    </table>
                    
    <p style="font-size:14px; font-weight:bold; padding:10px;">Hành lý chiều về</p>
                    <table class="tb0" width="100%">
                    	<tr>
                        	<td width="30%">Hành lý xách tay</td>
                            <td width="70%"><?=$orders_back['hanh_ly_xach_tay']?></td>
                        </tr>
                        <tr>
                        	<td>Hàng lý ký gửi</td>
                            <td><?=$orders_back['hanh_ly_ky_gui']?></td>
                        </tr>
                    </table>
    <div class="p5 mgb5"></div>
	<span class="sdb p5" style="font-weight:bold; font-size:20px; color:#143B85">Thông tin du khách</span>
    <div class="p5 mgb5" style="border-bottom:1px solid #CCC;"></div>
    
    <table>
    					<tr>
                            <td width="25%" style="display:block; width:60px;">
                            </td>
                            <td width="15%">
                                <b></b>
                            </td>
                            <td colspan="" width="25%" style="vertical-align: middle">
                                <b>Họ và tên</b><br>
                                <i style="font-size: 11px; color: #999; font-style: normal">(ví dụ: Nguyen Thi Hoai Thu)</i>
                            </td>
                            <td width="30%">
                                <b>
                                    Ngày sinh</b><br>
                                <i style="font-size: 11px; color: #999; font-style: normal">(ví dụ: 30/04/1975)</i>
                            </td>
                        </tr>
         	<?php
				for($i=0;$i<$this->uri->segment(4);$i++){
					?>
                    	<tr>
                        	<td>Người lớn</td>
                            <td><select name="Adult[]" id="">
                                <option selected="selected" value="Ông">Ông</option>
                                <option value="Bà">Bà</option>
                                <option value="Anh">Anh</option>
                                <option value="Chị">Chị</option>
                            </select></td>
                            <td><input name="txtFullNameAdult[]" type="text" value="" maxlength="500" id="" class="letterOnly i-require new LastNamePassengerFlight" style="width:300px;"></td>
                            <td></td>
                        </tr>
                    <?php
				}
			?>
         	<?php
				for($i=0;$i<$this->uri->segment(5);$i++){
					?>
                    	<tr>
                        	<td>Trẻ em</td>
                            <td><select name="Child[]" id="">
                                <option selected="selected" value="Trẻ Em Trai">Trẻ Em Trai</option>
                                <option value="Trẻ Em Gái">Trẻ Em Gái</option>
                            </select></td>
                            <td><input name="txtFullNameChild[]" type="text" value="" maxlength="500" id="" class="letterOnly i-require new LastNamePassengerFlight" style="width:300px;"></td>
                            <td >
                            	<select name="DayChild[]" id="">
                                    <option selected="selected" value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                                <select name="MonthChild[]" id="">
                                    <option selected="selected" value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <select name="YearChild[]" id="">
                                	<?php
										$now=date('Y');
										for($iz=$now-12;$iz<=$now;$iz++){
											?>
                                            	<option value="<?=$iz?>"><?=$iz?></option>
                                            <?php
										}
									?>
                                </select>
                            </td>
                        </tr>
                    <?php
				}
			?>
         	<?php
				for($i=0;$i<$this->uri->segment(6);$i++){
					?>
                    	<tr>
                        	<td>Em bé</td>
                            <td><select name="Infant[]" id="">
                                <option selected="selected" value="Em Bé Trai">Em Bé Trai</option>
                                <option value="Em Bé Gái">Em Bé Gái</option>
                            </select></td>
                            <td><input name="txtFullNameInfant[]" type="text" value="" maxlength="500" id="" class="letterOnly i-require new LastNamePassengerFlight" style="width:300px;"></td>
                            <td width="200px" style="display:block; width:200px">
                            	<select name="DayInfant[]" id="">
                                    <option selected="selected" value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                                <select name="MonthInfant[]" id="">
                                    <option selected="selected" value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <select name="YearInfant[]" id="">
                                	<?php
										$now=date('Y');
										for($iz=$now-3;$iz<=$now;$iz++){
											?>
                                            	<option value="<?=$iz?>"><?=$iz?></option>
                                            <?php
										}
									?>
                                </select>
                            </td>
                        </tr>
                    <?php
				}
			?>
    </table>
    
    <div class="p5 mgb5"></div>
	<span class="sdb p5" style="font-weight:bold; font-size:20px; color:#143B85">Thông tin liên hệ</span>
    <table class="booking-info-bg-table thong-tin-lien-he" width="100%">
                <tbody><tr>
                    <td class="_note" colspan="2">
                        Xin vui lòng điền vào tất cả các thông tin, chúng tôi sẽ liên hệ với bạn khi cần.
                        <span class="require"> * </span>Thông tin bắt buộc
                        ...
                    </td>
                </tr>
                <tr>
                    <td width="50%" valign="top" style="padding:0px;">
                        <table style="border-spacing: 0;">
                            <tbody><tr>
                                <td>
                                    <table style="border: 0px;border-spacing: 0;">
                                        <tbody><tr style="border: none">
                                            <td style="border: none">
                                                <label for="">
                                                    Quý danh
                                                    <span class="require">* </span>
                                                </label>
                                                <br>
                                                
                                                <select name="Gender" id="Gender" class="gender">
                                                    <option selected="selected" value="Ông">Ông</option>
                                                    <option value="Bà">Bà</option>
                                                    <option value="Anh">Anh</option>
                                                    <option value="Chị">Chị</option>
												</select>
                                            </td>
                                            <td colspan="2" style="border: none">
                                                <label for="">
                                                    Họ và tên
                                                    <span class="require">* </span>
                                                </label>
                                                <br>
                                                <input name="FullNameContact" type="text" value="" maxlength="250" id="FullNameContact" class="new last-name letterOnly i-require" style="width:240px;">
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0px; padding-left:5px; padding-right:5px; padding-bottom:5px;">
                                    <label for="">
                                        E-mail
                                        <span class="require">* </span><span class="example">
                                            Ví dụ: example@domain.com </span>
                                    </label>
                                    <br>
                                    <input name="Email" type="text" value="" maxlength="200" id="Email" class="new email i-require">
                                </td>
                            </tr>
                            <tr>
                                <td style="">
                                    <label for="">
                                        Số điện thoại
                                        <span class="require">* </span>
                                    </label>
                                    <br>
                                    <input name="Mobile" type="text" value="" maxlength="20" id="Mobile" class="new phone i-require">
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                    <td width="50%" valign="top">
                        <table style="border-spacing: 0;">
                            <tbody><tr>
                                <td>
                                    <label for="">
                                        Quốc Gia
                                        <span class="require">* </span>
                                    </label>
                                    <br>
                                    <input name="country" type="text">
	<script language="javascript">
		url_search="http://localhost/abay/admin/country/search_country";
		$(document).ready(function(e) {
            $('option[id="country"]').parent().css('position','relative');
        });
		$('input[name="code"]').keypress(function(){
			var obj=$(this);
			obj.parent().css('position','relative');
			obj.parent().find('select').addClass('option_select').bind('click',function(){
				return false;
			}).bind('dblclick',function(){
				obj.val($(this).val());
				$(this).removeClass();
			}).bind('change',function(){
				obj.val($(this).val());
				$(this).removeClass();
			});
			$.post(url_search, { str:obj.val() },function(data){
				obj.parent().find('select').html(data);
			});
		});
	</script>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 3px">
                                    <label for="">
                                        <label for="">
                                            Thành phố
                                            <span class="require">* </span>
                                        </label>
                                        </label>
                                        <br>
                                        <input name="City" type="text" value="" maxlength="250" id="City" class="new city i-require">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">
                                        Địa chỉ
                                        <span class="require">* </span>
                                    </label>
                                    <br>
                                    <input name="Street" type="text" value="" maxlength="250" id="Street" class="new i-require">
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td class="invoice" colspan="2" style="padding:0px;">
                        <input id="IsInvoice" type="checkbox" name="IsInvoice" style="width:20px; float:left;">
                        <label for="" style="line-height:35px;">
                            Tôi muốn xuất hóa đơn
                        </label>
                        <script language="javascript">
							$(document).ready(function(e) {
                                $('input#IsInvoice').click(function(){
									if($('tr#invoice_details').css('display')=='none'){
										$('tr#invoice_details').show(500);
									}else{
										$('tr#invoice_details').hide(500);
									}
								});
                            });
						</script>
                    </td>
                </tr>
                <tr id="invoice_details" style="display: none;">
                    <td colspan="2">
                        <fieldset class="radius-5px" style="display: block;
-webkit-margin-start: 2px;
-webkit-margin-end: 2px;
-webkit-padding-before: 0.35em;
-webkit-padding-start: 0.75em;
-webkit-padding-end: 0.75em;
-webkit-padding-after: 0.625em;
border: 2px groove threedface;
border-image: initial;">
                            <legend>
                                Chi tiết hóa đơn</legend>
                            <table style="width: 100%">
                                <tbody><tr>
                                    <td>
                                        <label for="">
                                            Tên Công ty
                                            <span class="require">* </span>
                                        </label>
                                        <br>
                                        <input name="NameInvoice" type="text" maxlength="250" id="NameInvoice" class="new i-require letterOnly">
                                    </td>
                                    <td>
                                        <label for="">
                                            Địa chỉ
                                            <span class="require">* </span>
                                        </label>
                                        <br>
                                        <input name="Address" type="text" maxlength="250" id="Address" class="new i-require">
                                    </td>
                                    <td>
                                        <label for="">
                                            Mã số thuế
                                            <span class="require">* </span>
                                        </label>
                                        <br>
                                        <input name="Tax" type="text" maxlength="250" id="Tax" class="new i-require">
                                    </td>
                                </tr>
                                <tr><td colspan="3">
                                        <label for="">
                                            Địa chỉ nhận hóa đơn
                                        </label>
                                        <br>
                                    <input name="InvoiceAddress" type="text" id="InvoiceAddress" style="width:99%;">
                                    </td></tr>
                            </tbody></table>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <td class="receive" colspan="2" style="padding:0px;">
                        <input id="IsReceiveInformation" type="checkbox" name="IsReceiveInformation" checked="checked" style="width:20px; float:left;">
                        <label for="" style="line-height:35px;">
                            Tôi muốn nhận được thông tin về chương trình khuyến mãi, tin tức....
                        </label>
                    </td>
                </tr>
               
            </tbody></table>
    <div class="p5 mgb5" style="border-bottom:1px solid #CCC;"></div>
    <div class="p5 mgb5"></div>
	<span class="sdb p5" style="font-weight:bold; font-size:20px; color:#143B85">Yêu cầu đặc biệt</span>
    <div class="p5 mgb5" style="border-bottom:1px solid #CCC;"></div>
    <table width="100%" class="tb0">
                <tbody>
                    <tr>
                        <td valign="top">
                            <p>
                                Viết yêu cầu của bạn vào ô bên dưới (Tiếng Anh hoặc Tiếng Việt).</p>
                            <textarea name="txtRemark" rows="5" cols="60" id="txtRemark"></textarea>
                        </td>
                        <td valign="middle" class="input-submit">
                           
                                <input type="submit" name="Continue" value="Xác Nhận" id="Continue" class="button-text radius-5px" style="
background: url('<?=base_url()?>public/style/img/continue-passenger.png') no-repeat;
height: 49px;
width: 133px;
padding: 9px 50px 8px 5px;
text-align: justify;
white-space: pre-line;
text-align: center;
font-size: 16px;
border:0px;
cursor: pointer;">
                            
                        </td>
                    </tr>
                </tbody>
            </table>
</div>
</form>