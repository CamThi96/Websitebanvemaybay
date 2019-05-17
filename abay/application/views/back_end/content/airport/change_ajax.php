<td><?=$airport['airport_name']?></td><td><form action="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/sua/<?=$airport['airport_code']?>" method="post" accept-charset="utf-8"><input type="text" name="airport_name" value="<?=$airport['airport_name']?>"><input type="submit" name="ok" value="Sửa" style="width:50px"></form></td><td><a id="delete" href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/sua/<?=$airport['airport_code']?>">Sửa</a> | <a id="delete" href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/xoa/<?=$airport['airport_code']?>">Xoá</a></td>
<script language="javascript">
		$('form').submit(function(){
			var obj=$(this);
			url=$(this).attr('action')+'/ajax';
			name=$(this).find('input[name="airport_name"]').val();
			$.post(url, { airport_name: name }, function(data){
				obj.parent().parent().html(data);
			});
			return false;
		});
		$('a#delete').click(function(){
			var obj=$(this);
			$.get(obj.attr('href')+'/ajax',{ },function(){
				obj.parent().parent().html('');
			});
			return false;
		});
</script>