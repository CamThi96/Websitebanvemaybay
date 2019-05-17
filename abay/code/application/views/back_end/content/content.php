<div class="item">
	<div class="title">
    	Thông Tin <?=$title_vi?>
    </div>
    <?php
		echo form_open(base_url().$this->uri->uri_string());
			$this->table->add_row(array('data'=>'Nội Dung', 'width'=>100), array('data'=>form_textarea('content_vi', $post['content_vi']), 'width'=>600));
			//$this->table->add_row('Nội Dung Tiếng Anh', form_textarea('content_en', $post['content_en']));
			echo $this->table->generate();
			$cke=new ckeditor();
			$ckf=new ckfinder();
			$cke->basePath=base_url().'ckeditor/';
			$ckf->basePath=base_url().'ckfinder/';
			$ckf->SetupCKEditorObject($cke);
			$cke->replace('content_vi');
			//$cke->replace('content_en');
			echo form_submit('ok', 'Sửa', 'style="width:150px"');
		echo form_close();
	?>
</div>