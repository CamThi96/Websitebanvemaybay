<div class="tvo_left_section">
	<div style="padding:15px;">
        <div style="color:#143B85; font-size:20px; font-weight:bold; padding-bottom:15px;">
            Tin Tức
        </div>
        
        <?php
			foreach($news as $val){
				?>
                	<div class="tvo_recruitment">
                    	<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$val['id']?>" title="<?=$val['title_vi']?>"><?=$val['title_vi']?>
                        	<img src="<?=base_url()?>public/uploads/news/<?=$val['image']?>">
                        </a>
                        <?=$val['summary_vi']?>
                        <div class="tvo_detail"><a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$val['id']?>" title="<?=$val['title_vi']?>">Chi tiết >></a></div>
                        <div class="clear"></div>
                    </div>
                <?php
			}
			echo $this->pagination->create_links();
		?>
    </div>
</div>