<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
	function uploadimg($filename='user_file', $url_dir, $nwidth=0, $nheight=0, $randname=false, $randstr){//file là file tạm được tải lên server, đường dẫn là nơi lưu hình ảnh sau khi xử lý, kích cỡ ảnh mong muốn
			//Tạo một hình ảnh từ nó để thay đổi kích cỡ
			//$src = load($uploadedfile);
			$file=$_FILES[$filename]['tmp_name'];
			$image_info = getimagesize($file);
			$imgtype = $image_info[2];
			if( $imgtype == IMAGETYPE_JPEG ) {
				 $src= imagecreatefromjpeg($file);
			  } elseif( $imgtype == IMAGETYPE_GIF ) {
				 $src= imagecreatefromgif($file);
			  } elseif( $imgtype == IMAGETYPE_PNG ) {
				 $src= imagecreatefrompng($file);
			  }
			  list($width,$height)=getimagesize($file);
			//Khỡi tạo kích cỡ
			$newwidth=$nwidth;
			
			if($nheight==0 && $nwidth!=0){
			  	$ratio = $nwidth / $width;
      			$newheight = $height * $ratio;
				$newwidth=$nwidth;
			}elseif($nwidth==0 && $nheight!=0){
				$ratio = $nheight / $height;
			  	$newwidth = $width * $ratio;
				$newheight=$nheight;
			}elseif($nheight==0 && $nwidth==0){
				$newheight=$height;
				$newwidth=$width;
			}else{
				$newheight=$nheight;
				$newwidth=$nwidth;
			}
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			imagealphablending($tmp, false);
			imagesavealpha($tmp,true);
			$transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
			imagefilledrectangle($tmp, 0, 0, $newwidth, $newheight, $transparent);
			//Thay đổi kích cỡ ảnh gốc
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			//Lưu ảnh đã sửa vào server
			if($randname==true){
				$name=md5($randname).'-';
			}
			$imagename=$name.khongdau($_FILES[$filename]['name']);
			$filename = $url_dir.$imagename;
			//imagejpeg($tmp,$filename,100);
			if( $imgtype == IMAGETYPE_JPEG ) {
				 imagejpeg($tmp,$filename,100);
			  } elseif( $imgtype == IMAGETYPE_GIF ) {
				 imagegif($tmp,$filename);
			  } elseif( $imgtype == IMAGETYPE_PNG ) {
				 imagepng($tmp,$filename);
			  }
			//kết thúc
			imagedestroy($src);
			imagedestroy($tmp);
			return $imagename;
		}
?>