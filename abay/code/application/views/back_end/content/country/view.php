<div class="item">
	<div class="title">
    	Danh Sách Các Nước
    </div>
    <?=$this->pagination->create_links()?>
    Tìm Kiếm: <input name="search" type="text"><br />
    <a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/them">Thêm</a>
    <?php
		$this->table->add_row(array('data'=>'Nước', 'width'=>300), array('data'=>'Sửa', 'width'=>300), array('data'=>'Xử Lý', 'width'=>150));
		//$this->table->add_row(array('data'=>'Tìm kiếm'),array('data'=>form_input('search'), 'colspan'=>2));
		foreach($country as $val){
			$a='<a id="delete" href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/xoa/'.$val['country_code'].'">Xoá</a>';
			$this->table->add_row($val['country_title'], form_open(base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/sua/'.$val['country_code']). 
									form_input('country_title', $val['country_title']). form_submit('ok', 'Sửa', 'style="width:50px"')
									.form_close(), $a);
		}
		echo $this->table->generate();
	?>
    <script language="javascript">
		$('form').submit(function(){
			var obj=$(this);
			url=$(this).attr('action')+'/ajax';
			title=$(this).find('input[name="country_title"]').val();
			$.post(url, { country_title: title }, function(data){
				obj.parent().parent().html(data);
			});
			return false;
		});
		$('a#delete').click(function(){
			var obj=$(this);
			$.get(obj.attr('href')+'/ajax',{ },function(){
				obj.parent().parent().html();
			});
			return false;
		});
		$('input[name="search"]').keypress(function(){
			url="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/search/";
			var obj=$(this);
			$.post(url, { str: obj.val() },function(data){
				obj.parent().find('table').html(data);
			});
        });
	</script>
</div>