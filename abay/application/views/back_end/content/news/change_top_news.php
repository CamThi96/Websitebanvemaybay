<div class="item">
	<div class="title">
    	Sửa <?=$title?>
    </div>
    <?php
		echo form_open_multipart();
			$this->table->add_row(array('data'=>'Tên '.$title, 'width'=>100), array('data'=>form_input('title_vi', $news['title_vi']), 'width'=>700));
			$this->table->add_row('Nội Dung', form_textarea('content_vi', $news['content_vi']));
			$this->table->add_row(array('data'=>form_submit('ok', 'Sửa', 'style="width:150px"'), 'colspan'=>2, 'style'=>'text-align:center'));
			print $this->table->generate();
		echo form_close();
		$cke=new CKEditor();
		$ckf=new CKFinder();
		$cke->basePath=base_url().'ckeditor/';
		$ckf->basePath=base_url().'ckfinder/';
		$ckf->SetupCKEditorObject($cke);
		$cke->replace('content_vi');
	?>
</div>