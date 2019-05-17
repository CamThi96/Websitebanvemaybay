<div class="item">
	<div class="title">
    	Thêm Tài Khoản
    </div>
    <div class="content">
    	<?php
			echo form_open(base_url().$this->uri->uri_string());
				$this->table->add_row(array('data'=>'Tên Đăng Nhập:', 'width'=>150), array('data'=>form_input('user_name', set_value('user_name')).'<br>'.form_error('user_name'), 'width'=>650));
				$this->table->add_row('Mật Khẩu',form_password('password').'<br>'.form_error('password'));
				$this->table->add_row('Nhập Lại Mật Khẩu', form_password('re_password').'<br>'.form_error('re_password'));
				$this->table->add_row('Họ Tên', form_input('name', set_value('name')));
				$this->table->add_row('Công Ty', form_input('company', set_value('company')));
				$this->table->add_row('Địa Chỉ', form_input('address', set_value('address')));
				$this->table->add_row('Số Điện Thoại', form_input('phone', set_value('phone')));
				$this->table->add_row('Email', form_input('email', set_value('email')));
				$this->table->add_row(array('data'=>form_submit('ok', 'Thêm', 'style="width:150px"'), 'colspan'=>2, 'style'=>'text-align:center'));
				echo $this->table->generate();
			echo form_close();
		?>
    </div>
</div>