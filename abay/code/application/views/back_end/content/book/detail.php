<div class="item">
	<div class="title">
    	Thông Tin Đơn Hàng <a href="<?=base_url()?>thong-tin-don-hang/<?=$book['id']?>"><?=$book['id']?></a>
    </div>
    <?php
		
	?>
    <table class="tb0" width="100%">
    	<tr>
        	<td width="20%">
            	Thời gian đặt vé
            </td>
            <td width="80%">
            	<?=date("D, d M Y, H:i:s", $book['time'])?>
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Nơi đi
            </td>
            <td width="80%">
            	<?=$noi_di['airport_name']?> (<?=$noi_di['airport_code']?>) - <?=$noi_di['country_title']?>
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Nơi đến
            </td>
            <td width="80%">
            	<?=$noi_den['airport_name']?> (<?=$noi_den['airport_code']?>) - <?=$noi_den['country_title']?>
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Ngày đi
            </td>
            <td width="80%">
            	<?=$book['ngay_di']?>
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Ngày về
            </td>
            <td width="80%">
            	<?=$book['ngay_ve']?>
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Chuyến bay đi
            </td>
            <td width="80%">
            	<a href="<?=base_url()?><?=$this->uri->segment(1)?>/schedule/sua/<?=$book['ma_chuyen_bay_di']?>"><?=$book['ma_chuyen_bay_di']?></a>
                <br>
                Giờ bay: <?=$bay_di['gio_di']?><br>
                Giờ hạ cánh: <?=$bay_di['gio_den']?>
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Chuyến bay về
            </td>
            <td width="80%">
            	<a href="<?=base_url()?><?=$this->uri->segment(1)?>/schedule/sua/<?=$book['ma_chuyen_bay_ve']?>"><?=$book['ma_chuyen_bay_ve']?></a>
                <br>
                Giờ bay: <?=$bay_ve['gio_di']?><br>
                Giờ hạ cánh: <?=$bay_ve['gio_den']?>
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Hành khách:
            </td>
            <td width="80%">
            	<?=$book['nguoi_lon']?> người lớn, <?=$book['tre_em']?> trẻ em, <?=$book['em_be']?> em bé.<br>
                <?php
					foreach($book_detail as $val){
						?>
                        	<?=$val['loai_nguoi']?>: <?=$val['ten_nguoi']?> (<?=$val['ngay_sinh']?>)<br>
                        <?php
					}
				?>
            </td>
        </tr>
    	<tr>
        	<td width="20%">
            	Thông tin liên hệ
            </td>
            <td width="80%">
            	Người liên hệ: <?=$book['quy_danh']?> <?=$book['ho_ten_nguoi_nhan']?><br>
                Địa chỉ người nhận: <?=$book['dia_chi_nguoi_nhan']?><br>
                Email người nhận: <?=$book['email_nguoi_nhan']?><br>
                Số điện thoại: <?=$book['so_dien_thoai']?><br>
                Quốc gia: <?=$book['quoc_gia']?><br>
                Thành phố: <?=$book['thanh_pho']?><br>
                Hoá đơn: <?=$book['hoa_don']?><br>
                Tên công ty: <?=$book['ten_cong_ty']?><br>
                Mã số thuế: <?=$book['ma_so_thue']?><br>
                Địa chỉ nhận hoá đơn: <?=$book['dia_chi_nhan_hoa_don']?><br>
                Địa chỉ công ty: <?=$book['dia_chi_cong_ty']?><br>
                Nhận thông tin khuyến mãi: <?=$book['nhan_thong_tin']?><br>
                Yêu cầu: <?=$book['yeu_cau']?><br>
            </td>
        </tr>
        <tr>
        	<td>
            	Giá vé bay đi:
            </td>
            <td>
            	Giá vé chưa thuế: <?=number_format(($bay_di['gia_ve_nguoi_lon']*$book['nguoi_lon']+$bay_di['gia_ve_tre_em']*$book['tre_em']+$bay_di['gia_ve_em_be']*$book['em_be']))?><br>
            	Thuế (<?=$bay_di['thue']?>%): <?=number_format(($bay_di['gia_ve_nguoi_lon']*$book['nguoi_lon']+$bay_di['gia_ve_tre_em']*$book['tre_em']+$bay_di['gia_ve_em_be']*$book['em_be'])*($bay_di['thue']/100))?><br>
                Phí: <?=number_format(($bay_di['phi_nguoi_lon']*$book['nguoi_lon']+$bay_di['phi_tre_em']*$book['tre_em']+$bay_di['phi_em_be']*$book['em_be']))?><br>
                Tổng: <?=number_format(($bay_di['phi_nguoi_lon']*$book['nguoi_lon']+$bay_di['phi_tre_em']*$book['tre_em']+$bay_di['phi_em_be']*$book['em_be'])+($bay_di['gia_ve_nguoi_lon']*$book['nguoi_lon']+$bay_di['gia_ve_tre_em']*$book['tre_em']+$bay_di['gia_ve_em_be']*$book['em_be'])+(($bay_di['gia_ve_nguoi_lon']*$book['nguoi_lon']+$bay_di['gia_ve_tre_em']*$book['tre_em']+$bay_di['gia_ve_em_be']*$book['em_be'])*($bay_di['thue']/100)))?>
            </td>
        </tr>
        <tr>
        	<td>
            	Giá vé bay về:
            </td>
            <td>
            	Giá vé chưa thuế: <?=number_format(($bay_ve['gia_ve_nguoi_lon']*$book['nguoi_lon']+$bay_ve['gia_ve_tre_em']*$book['tre_em']+$bay_ve['gia_ve_em_be']*$book['em_be']))?><br>
            	Thuế (<?=$bay_ve['thue']?>%): <?=number_format(($bay_ve['gia_ve_nguoi_lon']*$book['nguoi_lon']+$bay_ve['gia_ve_tre_em']*$book['tre_em']+$bay_ve['gia_ve_em_be']*$book['em_be'])*($bay_ve['thue']/100))?><br>
                Phí: <?=number_format(($bay_ve['phi_nguoi_lon']*$book['nguoi_lon']+$bay_ve['phi_tre_em']*$book['tre_em']+$bay_ve['phi_em_be']*$book['em_be']))?><br>
                Tổng: <?=number_format(($bay_ve['phi_nguoi_lon']*$book['nguoi_lon']+$bay_ve['phi_tre_em']*$book['tre_em']+$bay_ve['phi_em_be']*$book['em_be'])+($bay_ve['gia_ve_nguoi_lon']*$book['nguoi_lon']+$bay_ve['gia_ve_tre_em']*$book['tre_em']+$bay_ve['gia_ve_em_be']*$book['em_be'])+(($bay_ve['gia_ve_nguoi_lon']*$book['nguoi_lon']+$bay_ve['gia_ve_tre_em']*$book['tre_em']+$bay_ve['gia_ve_em_be']*$book['em_be'])*($bay_ve['thue']/100)))?>
            </td>
        </tr>
        <tr>
        	<td>
            	Tổng giá vé:
            </td>
            <td>
            	<?=number_format(($bay_ve['phi_nguoi_lon']*$book['nguoi_lon']+$bay_ve['phi_tre_em']*$book['tre_em']+$bay_ve['phi_em_be']*$book['em_be'])+($bay_ve['gia_ve_nguoi_lon']*$book['nguoi_lon']+$bay_ve['gia_ve_tre_em']*$book['tre_em']+$bay_ve['gia_ve_em_be']*$book['em_be'])+(($bay_ve['gia_ve_nguoi_lon']*$book['nguoi_lon']+$bay_ve['gia_ve_tre_em']*$book['tre_em']+$bay_ve['gia_ve_em_be']*$book['em_be'])*($bay_ve['thue']/100))+($bay_di['phi_nguoi_lon']*$book['nguoi_lon']+$bay_di['phi_tre_em']*$book['tre_em']+$bay_di['phi_em_be']*$book['em_be'])+($bay_di['gia_ve_nguoi_lon']*$book['nguoi_lon']+$bay_di['gia_ve_tre_em']*$book['tre_em']+$bay_di['gia_ve_em_be']*$book['em_be'])+(($bay_di['gia_ve_nguoi_lon']*$book['nguoi_lon']+$bay_di['gia_ve_tre_em']*$book['tre_em']+$bay_di['gia_ve_em_be']*$book['em_be'])*($bay_di['thue']/100)))?> (chưa bao gồm hành lý)
            </td>
        </tr>
        <tr>
        	<td>Thông tin</td>
            <td>
            	<form action="<?=base_url()?><?=$this->uri->uri_string()?>" method="post">
                	Tình trạng: <br><input name="tinh_trang" type="text" value="<?=$book['tinh_trang']?>"><br>
                    Trạng thái: <br><input name="trang_thai" type="text" value="<?=$book['trang_thai']?>"><br>
                    <input type="submit" value="Cập nhật" style="width:150px">
                </form>
            </td>
        </tr>
    </table>
</div>