<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class My_Img{
		var $obj;
		var $data;
		
		function My_Img(){
			$this->obj=&get_instance();
		}
		
		function watermark($sourcefile, $watermarkfile) {
			#
			# $sourcefile = Filename of the picture to be watermarked.
			# $watermarkfile = Filename of the 24-bit PNG watermark file.
			#
	 
			//Get the resource ids of the pictures
			$watermarkfile_id = imagecreatefrompng($watermarkfile);
	 
			imagealphablending($watermarkfile_id, false);
			imageSaveAlpha($watermarkfile_id, true);
	 
			$fileType = strtolower(substr($sourcefile, strlen($sourcefile)-3));
	 
			switch($fileType) {
				case('gif'):
					$sourcefile_id = imagecreatefromgif($sourcefile);
					break;
				case('png'):
					$sourcefile_id = imagecreatefrompng($sourcefile);
					break;
				default:
					$sourcefile_id = imagecreatefromjpeg($sourcefile);
			}
			//Get the sizes of both pix  
			$sourcefile_width=imagesx($sourcefile_id);
			$sourcefile_height=imagesy($sourcefile_id);
			$watermarkfile_width=imagesx($watermarkfile_id);
			$watermarkfile_height=imagesy($watermarkfile_id);
	 
			//$dest_x = ( $sourcefile_width / 2 ) - ( $watermarkfile_width / 2 );
			//$dest_y = ( $sourcefile_height / 2 ) - ( $watermarkfile_height / 2 );
	 
			//$dest_x = ( $sourcefile_width ) - ( $watermarkfile_width )-10;
			//$dest_y = ( $sourcefile_height ) - ( $watermarkfile_height)-10;
			$dest_x = 0;
			$dest_y = 0;
			// if a gif, we have to upsample it to a truecolor image
			if($fileType == 'gif') {
				// create an empty truecolor container
				$tempimage = imagecreatetruecolor($sourcefile_width, $sourcefile_height);
				   // copy the 8-bit gif into the truecolor image
				imagecopy($tempimage, $sourcefile_id, 0, 0, 0, 0, $sourcefile_width, $sourcefile_height);
				  // copy the source_id int
				$sourcefile_id = $tempimage;
			}
			imagecopy($sourcefile_id, $watermarkfile_id, $dest_x, $dest_y, 0, 0, $watermarkfile_width, $watermarkfile_height);
			//Create a jpeg out of the modified picture
			switch($fileType) {    
				// remember we don't need gif any more, so we use only png or jpeg.
				// See the upsaple code immediately above to see how we handle gifs
				case('png'):
					imagepng($sourcefile_id,$sourcefile);
					//header("Content-type: image/png");
					//imagepng ($sourcefile_id);
					break;
				case('gif'):{
				 	imagegif($sourcefile_id,$sourcefile);
					break;
				}
				default:
				 	imagejpeg($sourcefile_id,$sourcefile,100);
					//header("Content-type: image/jpg");
					//imagejpeg ($sourcefile_id);
			}
			imagedestroy($sourcefile_id);
			imagedestroy($watermarkfile_id);
		}
		
		function DoResize($nwidth, $nheight, $file_name, $tmp){
			$file=$tmp;
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
			$filename = $file_name;
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
		}
		
		function Upload($url_dir='public/uploads/images/', $upload_name='user_file'){
			$config['upload_path'] 		= 	$url_dir;
			$config['allowed_types'] 	= 	'gif|jpg|png';
			$config['max_size']			= 	8*1024;
			$config['max_width']  		= 	1024*100;
			$config['max_height']  		= 	1024*100;
			$config['max_filename']		=	250;
			$config['encrypt_name']		=	true;
			$this->obj->load->library('upload', $config);
			if (!$this->obj->upload->do_upload($upload_name)){
				$data['log']=$this->obj->upload->display_errors();
				$data['error']=false;
				return $data;
			}else{
				$data['upload_data']=$this->obj->upload->data();
				$data['error']=true;
				return $data;
			}
		}
	}
?>