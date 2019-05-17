	<div class="tvo_left_section">
        <div class="content" style="padding:10px; padding-left:20px; color:#666;">
    <h1 style="color:#143B85; font-size:20px; font-weight:bold; padding-bottom:15px;">
        	Tư vấn khách hàng
        </h1>	
    		<p class="desc">
    		    Xin vui lòng nhập vào câu hỏi của quý khách. Chúng tôi sẽ trả lời câu hỏi của quý khách trong thời gian sớm nhất.
                 Nếu muốn được tư vấn trực tiếp, bạn vui lòng liên hệ với chúng tôi theo thông tin <a href="<?=base_url()?>lien-he" title="Thông Tin Liên Hệ Trực Tiếp" style="color:#00F;
                 text-decoration:none;
                 font-weight:bold">ở đây</a>.
    		    </b>
    		</p>
            <div class="leaveMessage" style="float: left;clear: both; padding-top:15px;">
            <form method="post" action="<?=base_url()?>trang-tu-van">
            <?php
				if($_POST){
					?>
                    <span class="message-success">Câu hỏi của bạn đang được xử lý. Bạn sẽ nhận được câu trả lời sau vài phút nữa và sẽ được gửi vào email của bạn.</span>
                    <?php
				}
			?>
            <div class="clear"></div>
                <label>Tên người gửi</label>
                <input name="name" type="text" class="inputtext">
                <label>Email</label>
                <input name="email" type="text"  class="inputtext">
                <label>Số điện thoại</label>
                <input name="mobile" type="text"  class="inputtext">
                <label>Câu hỏi</label>
                <textarea name="question" rows="3" cols="50"  class="inputtextarea"></textarea>
                <input type="submit" name="send" value="Gửi"  class="submitMessage" style="background: url('<?=base_url()?>public/style/img/SendButton.png') repeat-x; float: right; height: 34px;width: 66px;cursor: pointer;  font-weight: bold; color: #fff; border: none !important; padding: 0 18px;">
            </form>
            </div>
    	</div>
        <div class="clear"></div>
    </div>
    <style>
	.main-khachhang  h3{font-size:16px; color:#04438d; font-weight:bold; text-transform:uppercase; margin:25px 10px 15px 10px; letter-spacing:-1px;}
.leaveMessage {width:400px; padding-left:10px;}
.leaveMessage label{display:block;width:50px; background:#04438d; padding:3px 10px; font-size:12px; color:#fff; -moz-border-radius-topleft: 5px; -webkit-border-top-left-radius: 5px; -moz-border-radius-topright: 5px; -webkit-border-top-right-radius: 5px; text-align:center;}
.leaveMessage .inputtext {width:380px; height:30px; border:solid 1px #04438d !important; margin-bottom:10px; font-size:12px; line-height:30px; padding:0px 10px;}
.leaveMessage .inputtextarea {width:380px; height:30px; border:solid 1px #04438d; margin-bottom:10px; height:100px; margin-top:0px; line-height:18px; font-size:12px; padding:0px 10px; }

	
        .leaveMessage label {
            font-weight: normal;
            width: 100px;
            color: white;
            line-height: 16px;
        }
		.message-success {
background: #EDF9ED;
color: #437941;

border: 1px solid #9BC97F;
float: left;
width: 95%;
padding: 5px 2%;
clear: both;
margin: 5px auto;
}
		
	</style>