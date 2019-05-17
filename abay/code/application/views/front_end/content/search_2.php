<div class="tvo_left_section">
<script language="javascript">
	$(document).ready(function(e) {
        $('span#view_detailt').click(function(){
			var obj=$(this);
			var hide_content=obj.parent().parent().find('.hide_content');
			if(hide_content.css('display')=='none'){
				hide_content.stop().show(500);
			}else{
				hide_content.stop().hide(500);
			}
		});
    });
</script>
<span style="display:block; padding-bottom:15px; margin-top:5px; margin-left:10px; font-weight:bold; color:red; font-size:28px">Giá đã bao gồm thuế và phí</span>
<span style="display:block; padding-bottom:15px; margin-top:5px; margin-left:10px; font-weight:bold; color:red; font-size:28px">Chọn vé khứ hồi</span>
<?php

	$data['to']=$this->mdairport->_Get_Airport_full_By_Id($this->uri->segment(2));
	$data['go']=$this->mdairport->_Get_Airport_full_By_Id($this->uri->segment(3));
	//print_r($data);
	?>
    <span style="color:#FF7B0F; margin-left:15px; font-weight:bold; font-size:20px"><?=$data['go']['airport_name']?></span> <span style="font-weight:bold; color:#666; font-size:16px;">đi</span> <span style="color:#FF7B0F; font-weight:bold; font-size:20px"><?=$data['to']['airport_name']?></span> <span class="dsb p5" /></span>
    <span style="font-weight:bold; margin-left:10px; color:#666; font-size:16px;">bay ngày</span> <span style="color:#143B85; font-size:20px;
    font-weight:bold;"><?=$this->uri->segment(8)?></span>
    <span class="dsb p5" /></span>
    <?php
	foreach($lich_bay as $val){
		//print_r($val);
		$nguoi_lon=intval($this->uri->segment(4));
		$tre_em=intval($this->uri->segment(5));
		$em_be=intval($this->uri->segment(6));
		$giave=(
				(
					($nguoi_lon*$val['gia_ve_nguoi_lon']) + ($tre_em*$val['gia_ve_tre_em']) + ($em_be* $val['gia_ve_em_be'])
				)
			);
		$giave+=$giave*($val['thue']/100)+(($nguoi_lon*$val['phi_nguoi_lon']) + ($tre_em*$val['phi_tre_em']) + ($em_be*$val['phi_em_be']));
		?>
        	<div class="tvo_schedule">
            	<div class="content">
                	<img src="<?=base_url()?>public/uploads/logos/<?=$val['image']?>" />
                    <span class="flight_code"><?=$val['ma_chuyen_bay']?></span>
                    <span class="time"><?=$val['gio_di']?> - <?=$val['gio_den']?></span>
                    <span class="price"><?=number_format($giave)?> VNĐ</span>
                    <span class="detailt" id="view_detailt">Xem Chi Tiết</span>
                    <span class="chosen">
                    	<a href="<?=base_url()?><?=$this->uri->uri_string()?>/<?=$val['ma_chuyen_bay']?>" title="Tiếp theo -> xác nhận đơn hàng"><input type="radio" name="chosen" /><span>Chọn</span></a>
                    </span>
                    <div class="clear"></div>
                </div>
                <div class="hide_content">
                	<div class="three">
                    	Từ <strong><?=$data['go']['airport_name']?></strong>, <?=$data['go']['country_title']?><br />
                        Sân Bay: <strong><?=$data['go']['airport_code']?></strong><br />
                        <strong><?=$val['gio_di']?></strong><!--, <?=$this->uri->segment(7)?>-->
                    </div>
                    
                	<div class="three">
                    	Tới <strong><?=$data['to']['airport_name']?></strong>, <?=$data['to']['country_title']?><br />
                        Sân Bay: <strong><?=$data['to']['airport_code']?></strong><br />
                        <strong><?=$val['gio_den']?></strong><!--, <?=$this->uri->segment(7)?>-->
                    </div>
                    
                	<div class="three">
                    	<img src="<?=base_url()?>public/uploads/logos/<?=$val['image']?>" />
                        <span><?=$val['title']?></span><br />
                        <strong><?=$val['ma_may_bay']?></strong><br />
                        <span>Loại vé: <strong><?=$val['loai_ve']?></strong></span>
                    </div>
                    <div class="clear" style="border-bottom:1px dashed #CCC; padding-bottom:5px; margin-bottom:5px;"></div>
                    <table class="tb0 red" width="100%">
                    	<tr>
                        	<td width="25%"><strong class="tlcl1">Loại hành khách</strong></td>
                        	<td width="15%"><strong class="tlcl1">Số lượng vé</strong></td>
                        	<td width="20%"><strong class="tlcl1">Giá mỗi vé</strong></td>
                        	<td width="20%"><strong class="tlcl1">Thuế & Phí mỗi vé</strong></td>
                        	<td width="20%"><strong class="tlcl1">Tổng giá</strong></td>
                        </tr>
                        <?php
							if($this->uri->segment(4)!=0){
								?>
                                	<tr>
                                    	<td>Người lớn</td>
                                        <td><?=$this->uri->segment(4)?></td>
                                        <td><strong><?=number_format($val['gia_ve_nguoi_lon'])?> VNĐ</strong></td>
                                        <td><strong><?=number_format($val['gia_ve_nguoi_lon']*($val['thue']/100)+$val['phi_nguoi_lon'])?> VNĐ</strong></td>
                                        <td><strong><?=number_format(($val['gia_ve_nguoi_lon']+($val['gia_ve_nguoi_lon']*($val['thue']/100)+$val['phi_nguoi_lon']))*$this->uri->segment(4))?> VNĐ</strong></td>
                                    </tr>
                                <?php
							}
						?>
                        <?php
							if($this->uri->segment(5)!=0){
								?>
                                	<tr>
                                    	<td>Trẻ em</td>
                                        <td><?=$this->uri->segment(5)?></td>
                                        <td><strong><?=number_format($val['gia_ve_tre_em'])?> VNĐ</strong></td>
                                        <td><strong><?=number_format($val['gia_ve_tre_em']*($val['thue']/100)+$val['phi_tre_em'])?> VNĐ</strong></td>
                                        <td><strong><?=number_format(($val['gia_ve_tre_em']+($val['gia_ve_tre_em']*($val['thue']/100)+$val['phi_tre_em']))*$this->uri->segment(4))?> VNĐ</strong></td>
                                    </tr>
                                <?php
							}
						?>
                        <?php
							if($this->uri->segment(6)!=0){
								?>
                                	<tr>
                                    	<td>Trẻ em</td>
                                        <td><?=$this->uri->segment(6)?></td>
                                        <td><strong><?=number_format($val['gia_ve_em_be'])?> VNĐ</strong></td>
                                        <td><strong><?=number_format($val['gia_ve_em_be']*($val['thue']/100)+$val['phi_em_be'])?> VNĐ</strong></td>
                                        <td><strong><?=number_format(($val['gia_ve_em_be']+($val['gia_ve_em_be']*($val['thue']/100)+$val['phi_em_be']))*$this->uri->segment(4))?> VNĐ</strong></td>
                                    </tr>
                                <?php
							}
						?>
                    </table>
                    <strong class="tlcl2">Điều kiện hành lý</strong>
                    <table class="tb0" width="100%">
                    	<tr>
                        	<td width="30%">Hành lý xách tay</td>
                            <td width="70%"><?=$val['hanh_ly_xach_tay']?></td>
                        </tr>
                        <tr>
                        	<td>Hàng lý ký gửi</td>
                            <td><?=$val['hanh_ly_ky_gui']?></td>
                        </tr>
                    </table>
                    <strong class="tlcl2">Điều kiện về vé</strong>
                    <table width="100%" class="tb0">
                    	<?php
							if(trim($val['hoan_ve'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Hoàn Vé</td>
                                        <td width="70%"><?=$val['hoan_ve']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($val['doi_ten'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Đổi Tên Hành Khách</td>
                                        <td width="70%"><?=$val['doi_ten']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($val['doi_hanh_trinh'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Đổi Hành Trình</td>
                                        <td width="70%"><?=$val['doi_hanh_trinh']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($val['doi_ngay_gio'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Đổi Ngày Giờ Chuyến Bay</td>
                                        <td width="70%"><?=$val['doi_ngay_gio']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($val['bao_luu'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Bảo Lưu</td>
                                        <td width="70%"><?=$val['bao_luu']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($val['thoi_gian_doi'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay, hành trình)</td>
                                        <td width="70%"><?=$val['thoi_gian_doi']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($val['doi_chuyen_bay'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Thay đổi chuyến bay</td>
                                        <td width="70%"><?=$val['doi_chuyen_bay']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($val['nang_hang'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Nâng Hạng</td>
                                        <td width="70%"><?=$val['nang_hang']?></td>
                                    </tr>
                                <?php
							}
						?>
                    	<?php
							if(trim($val['thoi_han_dung'])!=''){
								?>
                                	<tr>
                                    	<td width="30%">Thời Hạn Dừng Tối Đa</td>
                                        <td width="70%"><?=$val['thoi_han_dung']?></td>
                                    </tr>
                                <?php
							}
						?>
                    </table>
                </div>
            </div>
        <?php
	}
?>
</div>