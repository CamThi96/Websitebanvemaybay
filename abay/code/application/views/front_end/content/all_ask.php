<div class="tvo_left_section">
	<div style="padding:15px;">
        <div style="color:#143B85; font-size:20px; font-weight:bold; padding-bottom:15px;">
            Câu Hỏi Thường Gặp
        </div>
        
        <?php
			foreach($news as $val){
				?>
                	<div class="tvo_recruitment">
                    	<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$val['id']?>" title="<?=$val['title_vi']?>"><?=$val['title_vi']?></a>
                        <?=$val['summary_vi111']?>
                        <div class="tvo_detail"><a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$val['id']?>" title="<?=$val['title_vi']?>">Chi tiết >></a></div>
                    </div>
                <?php
			}
			echo $this->pagination->create_links();
		?>
    </div>
</div>