<div class="item">
	<div class="title">
    	Hình Ảnh Banner
    </div>
    <?=form_open_multipart(base_url().$this->uri->uri_string())?>
    <img src="<?=base_url()?>/public/uploads/images/<?=$code?>" style="width:717px">
    <?=form_upload('user_file')?>
    <?=form_submit('ok', 'Sửa', 'style="width:150px"')?>
    <?=form_close()?>
</div>