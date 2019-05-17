<?php
	$this->table->add_row(array('data'=>'Nước', 'width'=>300), array('data'=>'Sửa', 'width'=>300), array('data'=>'Xử Lý', 'width'=>150));
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
			$.get(obj.attr('href')+'/ajax', { },function(){
				obj.parent().parent().html('');
			});
			return false;
		});
		</script>