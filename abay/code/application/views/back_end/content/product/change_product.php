<div class="item">
	<div class="title">
    	Sửa Sản Phẩm
    </div>
    <?php
		echo form_open_multipart(base_url().$this->uri->uri_string());
			$this->table->add_row(array('data'=>'Tên Sản Phẩm', 'width'=>150), array('data'=>form_input('title_vi', $product['title_vi']), 'width'=>600));
			//$this->table->add_row(array('data'=>'Tên Sản Phẩm Tiếng Anh', 'width'=>150), array('data'=>form_input('title_en', $product['title_en']), 'width'=>600));
			foreach($main as $val){
				$option[$val['id']]=$val['title_vi'].'  '.$val['title_en'];
				foreach($sub[$val['id']] as $valsub){
					$option[$valsub['id']]='&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;'.$valsub['title_vi'];
				}
			}
			$this->table->add_row('Giá Sản Phẩm', form_input('price', $product['price']));
			$this->table->add_row('File Báo Giá',form_upload('user_file_quote').'<span style="color:#FF0"><br>Chỉ được tải lên các định dạng pdf, doc, docx, xls, xlsx, ppt, pptx, txt, zip, rar</span>');
			$this->table->add_row('Bảo Hành', form_input('warranty', $product['warranty']));
			$this->table->add_row('Tiêu Chuẩn', form_input('standard', $product['standard']));
			$this->table->add_row('Kích Thước', form_input('dimensions', $product['dimensions']));
			$this->table->add_row('Độ Dày', form_input('thickness', $product['thickness']));
			$this->table->add_row('Bề Mặt', form_input('surface', $product['surface']));
			$this->table->add_row('Thuộc Danh Mục', form_dropdown('product_type', $option, $product['id_type']));
			//$this->table->add_row('Giá Sản Phẩm', form_input('price', $product['price']));
			$this->table->add_row('Hình Đại Diện', form_upload('user_file'));
			$this->table->add_row('Chi Tiết Sản Phẩm', form_textarea('content_vi', $product['content_vi']));
			//$this->table->add_row('Chi Tiết Sản Phẩm Tiếng Anh', form_textarea('content_en', $product['content_en']));
			$this->table->add_row(array('data'=>form_submit('ok', 'Sửa', 'style="width:150px"'), 'colspan'=>2, 'style'=>'text-align:center'));
			echo $this->table->generate();
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