<div class="item">
	<div class="title">
    	Keywords
    </div>
    <?php
		echo form_open(base_url().$this->uri->uri_string());
		$this->table->add_row(array('data'=>'Keywords','width'=>'100px'),array('data'=>form_input('keywords',$post['content_vi']),'width'=>'600px'));
		$this->table->add_row(array('data'=>'Description','width'=>'100px'),array('data'=>form_input('description',$post['summary_vi'])));
		$this->table->add_row(array('colspan'=>2,'data'=>form_submit('ok','Sửa','style="width:150px"'),'style'=>'text-align:center'));
		echo $this->table->generate();
	?>
</div>