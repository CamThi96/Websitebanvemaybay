<div class="item">
	<div class="title">
    	Thêm Hãng Bay
    </div>
    <?php
		echo form_open_multipart(base_url().$this->uri->uri_string());
			$this->table->add_row(array('data'=>'Tên Hãng Bay', 'width'=>150), array('data'=>form_input('airlines_name'), 'width'=>500));
			$this->table->add_row('Hình Đại Diện', form_upload('user_file'));
			$this->table->add_row('Hành Lý Xách Tay', form_input('hanh_ly_xach_tay'));
			$this->table->add_row('Hàng Lý Ký Gửi', form_input('hanh_ly_ky_gui'));
			$this->table->add_row('Hoàn Vé', form_input('hoan_ve'));
			$this->table->add_row('Đổi Tên Hành Khách', form_input('doi_ten'));
			$this->table->add_row('Đổi Hành Trình', form_input('doi_hanh_trinh'));
			$this->table->add_row('Đổi Ngày Giờ Bay', form_input('doi_ngay_gio'));
			$this->table->add_row('Bảo Lưu', form_input('bao_luu'));
			$this->table->add_row('Đổi Chuyến Bay', form_input('doi_chuyen_bay'));
			$this->table->add_row('Nâng Hạng', form_input('nang_hang'));
			$this->table->add_row('Thời Hạn Dừng Tối Đa', form_input('thoi_han_dung'));
			$this->table->add_row('Thời Gian Thay Đổi', form_input('thoi_gian_doi'));
			$this->table->add_row(array('data'=>form_submit('ok', 'Thêm', 'style="width:150px"'), 'colspan'=>2));
			echo $this->table->generate();
		echo form_close();
	?>
</div>