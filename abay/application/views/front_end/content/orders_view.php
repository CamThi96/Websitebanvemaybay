<div class="tvo_left_section">
	<div style="padding:15px;">
        <div style="color:#143B85; font-size:20px; font-weight:bold; margin-bottom:15px;">
        	Xem Thông Tin Đơn Hàng
        </div>
        <div style="color:#F00">
        	<?=$log?>
        </div>
        	<form method="post" action="<?=base_url()?><?=$this->uri->segment(1)?>">
            	Nhập mã đơn hàng: <br>
                <input name="orders_code" type="text">
                <br>
                <input type="submit" value="Xem" style="width:100px">
            </form>	
    </div>
</div>