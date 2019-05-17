<div class="item">
	<div class="title">
    	File Bảng Giá
    </div>
    <?php
		echo form_open_multipart(base_url().$this->uri->uri_string());
			echo form_upload('user_file');
			echo form_submit('ok', 'Tải file báo giá', 'style="width:150px"');
		echo form_close();
	?>
    <span style="color:#FF0"><?=$error?><br>Chỉ được tải lên các định dạng pdf, doc, docx, xls, xlsx, ppt, pptx, txt, zip, rar</span>
</div>