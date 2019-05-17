<div class="item">
	<div class="title">
    	Sửa <?=$title?>
    </div>
    <?php
		echo form_open_multipart();
			$this->table->add_row(array('data'=>'Tên '.$title, 'width'=>100), array('data'=>form_input('title_vi', $news['title_vi']), 'width'=>700));
			//$this->table->add_row(array('data'=>'Tên '.$title. ' Tiếng Anh', 'width'=>100), array('data'=>form_input('title_en', $news['title_en']), 'width'=>700));
			//$this->table->add_row('Hình Đại Diện', form_upload('user_file'));
			if(isset($sub)){
				$option='';
				foreach($sub as $val){
					$option[$val['id']]=$val['title'];
				}
				$this->table->add_row('Thuộc Danh Mục', form_dropdown('sub', $option, $news['subtype']));
			}
			$this->table->add_row('Tóm Tắt', form_textarea('summary_vi', $news['summary_vi']));
			//$this->table->add_row('Tóm Tắt Tiếng Anh', form_textarea('summary_en', $news['summary_en']));
			$this->table->add_row('Nội Dung', form_textarea('content_vi', $news['content_vi']));
			//$this->table->add_row('Nội Dung Tiếng Anh', form_textarea('content_en', $news['content_en']));
			$this->table->add_row(array('data'=>form_submit('ok', 'Sửa', 'style="width:150px"'), 'colspan'=>2, 'style'=>'text-align:center'));
			print $this->table->generate();
		echo form_close();
		$cke=new CKEditor();
		$ckf=new CKFinder();
		$cke->basePath=base_url().'ckeditor/';
		$ckf->basePath=base_url().'ckfinder/';
		$ckf->SetupCKEditorObject($cke);
		$cke->replace('content_vi');
		//$cke->replace('content_en');
	?>
</div>