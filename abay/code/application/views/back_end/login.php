<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/style/css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/style/css/admin.css" />
<title>Đăng Nhập Hệ Thống</title>
</head>

<body>
	<div class="login">
    	<div class="title">
        	Design by Donaweb.vn and Hosting by Tvo.com.vn
        </div>
        <div class="formlogin">
        	<div class="left">
                <span style="font-weight:bold; font-size:17px;">Administrator Login</span><br /><br />
                Sử dụng tên người dùng
                và mật khẩu hợp lệ để
                truy cập vào Administrator
                <img src="<?=base_url()?>public/style/img/lock.jpg" />
            </div>
            <div class="right">
            	<style>
					table, tr, td, tbody{
						border:0px;
					}
				</style>
            	<?php
                	echo form_open(base_url().'admin/login');
					$this->table->add_row(array('data'=>'<div class="error">'.$errorlog.'</div>','colspan'=>2));
					$this->table->add_row(array('data'=>'Tên Đăng Nhập:','width'=>'100px'),array('data'=>form_input('username',set_value('username')).'<br>'.form_error('username'),'width'=>'250px'));
					$this->table->add_row('Mật Khẩu',form_password('password',set_value('password')).'<br />'.form_error('password'));
					$this->table->add_row(array('data'=>form_submit('ok','Đăng Nhập','style="width:150px; margin:auto auto"'),'colspan'=>2));
					echo $this->table->generate();
					echo form_fieldset_close()
				?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</body>
</html>