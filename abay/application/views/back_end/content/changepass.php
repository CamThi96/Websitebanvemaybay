<div class="item">
	<div class="title">
    	Đổi Mật Khẩu
	</div>
	<?php
        echo form_open(base_url().$this->uri->uri_string());
        $this->table->add_row(array('data'=>'Tên Đăng Nhập','width'=>'150px'),array('data'=>form_input('username',set_value('username')).'<br>'.form_error('username'),'width'=>'500px'));
		$this->table->add_row('Mật Khẩu Cũ',form_password('password').'<br>'.form_error('password'));
		$this->table->add_row('Mật Khẩu Mới',form_password('npassword',set_value('npassword')).'<br>'.form_error('npassword'));
		$this->table->add_row('Nhập Lại Mật Khẩu Mới',form_password('npassword2',set_value('npassword2')).'<br>'.form_error('npassword2'));
		$this->table->add_row(array('data'=>form_submit('ok','Đổi Mật Khẩu','style="width:150px"'),'colspan'=>2,'style'=>'text-align:center'));
		echo $this->table->generate();
    ?>
</div>