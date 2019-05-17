<div class="tvo_left_section">
	<p style="color:#143B85; font-size:20px; font-weight:bold;" class="p5">
    	Xin cảm ơn quý khách đã chọn dịch vụ của chúng tôi !
    </p>
    <div class="p5 mgb5" style="line-height:150%">
        Yêu cầu đặt vé của quý khác đã được xử lý trên hệ thống của chúng tôi. <br />
        Thông tin về đơn hàng sẽ được gửi tới địa chỉ email : <a href="mailto:<?=$orders['email_nguoi_nhan']?>" style="margin-left: 30px; color:#2286B7"><?=$orders['email_nguoi_nhan']?></a> . <br />
        Chúng tôi sẽ gọi điện xác nhận thông tin đơn hàng vào số: <strong><?=$orders['id']?></strong> <br />
        Quy khách hãy kiểm tra lại thông tin email và số điện thoại để đảm bảo không có sai sót.<br />
        <p style="margin-top:10px; padding:5px 10px; background: #fef4eb; border-bottom: 1px solid #fcdabf; border-top: 1px solid #fcdabf; ">
        	Đơn hàng của quý khách có mã <strong><?=$orders['id']?></strong> và <strong><?=$orders['tinh_trang']?></strong>. !
        </p>
    </div>
    <p style="color:#143B85; font-size:20px; font-weight:bold;" class="p5">
    	Thông tin đặt vé
    </p>
    <table class="tb0" width="100%" style="line-height:140%">
    	<tr>
        	<td width="20%">
            	Mã đơn hàng
            </td>
            <td width="80%" style="font-weight:bold">
            	<?=$orders['id']?>
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Trạng thái
            </td>
            <td width="80%" style="font-weight:bold">
            	<?=$orders['trang_thai']?>
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Tổng giá
            </td>
            <td width="80%" style="font-weight:bold">
            	<span style="color:#FF7B0F; font-size:18px; font-weight:bold"><?=number_format($total_price)?> VNĐ</span> (Chưa bao gồm hành lý)
            </td>
        </tr>
        <tr>
        	<td colspan="3"><div style="border-bottom:1px solid #CCC; margin-bottom:5px; padding-bottom:5px;"></div></td>
        </tr>
    	<tr>
        	<td width="20%">
            	Điểm đi
            </td>
            <td width="80%" style="font-weight:bold">
            	<?=$go['airport_name']?> (<?=$go['airport_code']?>)
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Điểm đến
            </td>
            <td width="80%" style="font-weight:bold">
            	<?=$to['airport_name']?> (<?=$to['airport_code']?>)
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Loại vé
            </td>
            <td width="80%" style="font-weight:bold">
            	<?=$bay_di['loai_veád']?>Khứ hồi
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Tóm tắt
            </td>
            <td width="80%" style="font-weight:bold">
            	<?=$orders['nguoi_lon']?> người lớn, <?=$orders['tre_em']?> trẻ em, <?=$orders['em_be']?> em bé.
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Ngày xuất phát
            </td>
            <td width="80%" style="font-weight:bold">
            	<?=$bay_di['gio_di']?>, <?=$orders['ngay_di']?>
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Ngày về
            </td>
            <td width="80%" style="font-weight:bold">
            	<?=$bay_ve['gio_di']?>, <?=$orders['ngay_ve']?>
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Hãng hàng không
            </td>
            <td width="80%" style="font-weight:bold; line-height:30px;">
            	<img src="<?=base_url()?>public/uploads/logos/<?=$hang_bay_di['image']?>" style="float:left;"/> - <?=$hang_bay_di['title']?><br>
                <img src="<?=base_url()?>public/uploads/logos/<?=$hang_bay_ve['image']?>" style="float:left;"/> - <?=$hang_bay_ve['title']?>
            </td>
        </tr>
        <?php
			foreach($orders_detail as $val){
				?>
                    <tr>
                        <td width="20%">
                           	<?=$val['loai_nguoi']?>
                        </td>
                        <td width="80%" style="font-weight:bold; line-height:30px;">
                            <?=$val['ten_nguoi']?> (<?=$val['ngay_sinh']?>)
                        </td>
                    </tr>
                <?php
			}
		?>
    </table>
    <div style="border-bottom:1px solid #CCC; margin-bottom:5px; padding-bottom:5px;"></div>
    <p style="color:#143B85; font-size:20px; font-weight:bold;" class="p5">
    	Hướng dẫn thanh toán:
    </p>
    <?=$huong_dan_thanh_toan?>
</div>