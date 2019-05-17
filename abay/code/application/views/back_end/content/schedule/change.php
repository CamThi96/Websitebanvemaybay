<div class="item">
	<div class="title">
    	Sửa Lịch Bay
    </div>
    <?php
		echo form_open(base_url().$this->uri->uri_string());
			$this->table->add_row(array('data'=>'Mã Chuyến Bay', 'width'=>150), array('data'=>form_input('ma_chuyen_bay', $ma_chuyen_bay), 'width'=>600));
			$this->table->add_row('Máy Bay', form_input('may_bay', $ma_may_bay));
			$this->table->add_row('Hãng Bay', form_input('airlines_code', $airlines_code));
			$this->table->add_row('Nơi Đi', form_input('noi_di', $airport_code_go));
			$this->table->add_row('Nơi Đến', form_input('noi_den', $airport_code_to));
			$this->table->add_row('Giờ Cất Cánh: (hh:mm:ss)', form_input('gio_di', $gio_di));
			$this->table->add_row('Giờ Hạ Cánh: (hh:mm:ss)', form_input('gio_den', $gio_den));
			$this->table->add_row('Hạng Vé', form_input('hang_ve', $loai_ve));
			$this->table->add_row('Giá Vé Người Lớn', form_input('gia_ve_nguoi_lon', $gia_ve_nguoi_lon));
			$this->table->add_row('Giá Vé Trẻ Em', form_input('gia_ve_tre_em', $gia_ve_tre_em));
			$this->table->add_row('Giá Vé Em Bé', form_input('gia_ve_em_be', $gia_ve_em_be));
			$this->table->add_row('Phí Người Lớn', form_input('phi_nguoi_lon', $phi_nguoi_lon));
			$this->table->add_row('Phí Trẻ Em', form_input('phi_tre_em', $phi_tre_em));
			$this->table->add_row('Phí Em Bé', form_input('phi_em_be', $phi_em_be));
			$this->table->add_row('Phần Trăm Thuế (Nhập số nguyên)', form_input('thue', $thue));
			$options=array(
				2=>'Thứ Hai',
				3=>'Thứ Ba',
				4=>'Thứ Tư',
				5=>'Thứ Năm',
				6=>'Thứ Sáu',
				7=>'Thứ Bảy',
				8=>'Chủ Nhật',
			);
			$tan_suat=explode(',', $tan_suat_bay);
			$this->table->add_row('Các Ngày Bay Trong Tuần',form_multiselect('date[]', $options,$tan_suat));
			$this->table->add_row(array('colspan'=>2, 'data'=>form_submit('ok', 'Sửa', 'style="width:150px"'), 'style'=>'text-align:center'));
			echo $this->table->generate();
		echo form_close();
	?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/style/css/jquery.autocomplete.css">
    <script language="javascript" src="<?=base_url()?>public/style/js/jquery.autocomplete.js"></script>
    <script>
		$(document).ready(function () {
    // Set auto complete
    	$('input[name="noi_di"]').autocomplete("<?=base_url()?>search_code",
        {
            max: 50,
            highlight: false,
            matchSubset: false,
            scrollHeight: 260,
            width: 261,
            formatItem: function (item, index, total, value) {
                return value.split("{")[0];
            },
            formatResult: function (item, value) {
                return value.split("{")[1];
            }
        });
		$('input[name="noi_di"]').result(function () {
		});
		
		$('input[name="noi_den"]').autocomplete("<?=base_url()?>search_code",
        {
            max: 50,
            highlight: false,
            matchSubset: false,
            scrollHeight: 260,
            width: 261,
            formatItem: function (item, index, total, value) {
                return value.split("{")[0];
            },
            formatResult: function (item, value) {
                return value.split("{")[1];
            }
        });
		$('input[name="noi_den"]').result(function () {
		});
		
		$('input[name="airlines_code"]').autocomplete("<?=base_url()?>search_airlines",
        {
            max: 50,
            highlight: false,
            matchSubset: false,
            scrollHeight: 260,
            width: 261,
            formatItem: function (item, index, total, value) {
                return value.split("{")[0];
            },
            formatResult: function (item, value) {
                return value.split("{")[1];
            }
        });
		$('input[name="airlines_code"]').result(function () {
		});
	});
	</script>
</div>