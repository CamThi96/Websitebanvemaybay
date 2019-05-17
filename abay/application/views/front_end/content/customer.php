<div class="tvo_left_section">

<div class="content" style="padding:15px;">
<img src="<?=base_url()?>public/style/img/khnoivechungtoii.png">
<?php
	foreach($customer as $val){
		?>
        	<div class="tvo_customer">
            	<div class="content">
                	"<?=$val['content']?>"
                </div>
                <div class="time">
                	Gửi lúc: <?=date("H:i m/d/Y", $val['time'])?>
                </div>
                <div class="name">
                	<?=$val['name']?> - <?=$val['phone']?>
                </div>
            </div>
        <?php
	}
?>
<?=$this->pagination->create_links();?>
			<form action="<?=base_url()?>" method="post">
        			<h5>HÃY ĐỂ LẠI nhận xét của bạn tại đây</h5>
                <?php
					if($_POST){
						?>
                        <span id="cphWidget_usrKhachHangNoiVeChungToiHome1_lblMessage" class="message-success" style="background: #EDF9ED;
color: #437941;

border: 1px solid #9BC97F;
float: left;
width: 95%;
padding: 5px 2%;
clear: both;
margin: 5px auto;">Cảm ơn bạn đã có những lời nhận xét về chúng tôi</span>
<meta http-equiv="refresh" charset="utf-8" content="10;url=<?=base_url()?><?=$this->uri->uri_string()?>" />
                        <?php
					}
				?>
        			<label>Tên bạn</label>
        			<input name="FullName" type="text" id="FullName" class="inputName">
        			<label>Phone</label>
        			<input name="Phone" type="text" id="Phone" class="inputName">
        			<label>Nhận xét</label>
        			<textarea name="Review" rows="5" cols="50" id="Review" class="messageKH"></textarea>
            		<input type="submit" name="Send" value="Gửi" id="Send" class="submitMessage">
            	</form>
            <div class="clear"></div>
            </div>
</div>
<style>
	.tvo_left_section form h5{
			font-size:13px;
			font-weight:bold;
			text-transform:uppercase;
			letter-spacing:-1px;
			color:#04438d;
		}
		
		.tvo_left_section form label{
			font-size:11px;
			color:#155095;
			line-height:14px;
			font-weight:bold;
			margin-bottom:5px;
			display:block;
			padding-left:10px;
			background:url(<?=base_url()?>public/style/img/btn_circle.png) no-repeat left center;
			margin-top:5px;
		}
		
		.tvo_left_section form input{
			border: solid 1px #e4e4e4;
			height:24px;
			background:#fff;
			width:290px;
			margin-bottom:10px;
		}
		
		.tvo_left_section form .submitMessage{
			width:66px;
			height:34px;
			cursor: pointer;
			color:#fff;
			background:url(<?=base_url()?>public/style/img/SendButton.png) no-repeat center right;
			border:none;
			font-weight:bold;
			font-family:Arial, Helvetica, sans-serif;
			display:block;
		}
		
		.tvo_left_section form .messageKH {
			width:290px;
			height:65px;
			border: solid 1px #e4e4e4;
			font-size:12px;
			font-family:Arial, Helvetica, sans-serif;
		}
</style>