<?php
	class MdSlideshow extends CI_Model{
		function __Construct(){
			parent::__Construct();
		}
		
		function _Do_Delete($id, $url_dir='public/uploads/slideshow/'){
			$data=$this->_Get_Slideshow_By_Id($id);
			unlink($url_dir.$data['image']);
			unlink($url_dir.'thumbs/'.$data['image']);
			$this->db->where('id', $id);
			$this->db->delete('slideshow');
		}
		
		function _Get_Slideshow_By_Id($id){
			$this->db->where('id',$id);
			$data=$this->db->get('slideshow');
			if($data->num_rows()==0){
				return false;
			}else{
				$data=$data->result_array();
				return $data[0];
			}
		}
		
		function _Get_All_Slideshow($type='slideshow', $perpage=9999, $page=0){
			$this->db->where('id_type', $type);
			return $this->db->get('slideshow', $perpage, $page)->result_array();
		}
		
		function _Add_Slideshow($type='slideshow', $url_dir='public/uploads/slideshow/', $width=750, $height=230, $thumbs=true, $widththumb=337, $heightthumb=90){
			$this->load->helper('uploadimg');
			$data=$this->DoUpload($url_dir);
			$this->DoResize($data['upload_data']['full_path'], $width, $height, $data['upload_data']['full_path']);
			$link=strip_tags($this->input->post('link'));
			if($thumbs==true){
				$this->DoResize($data['upload_data']['full_path'], $widththumb, $heightthumb, $url_dir.'thumbs/'.$data['upload_data']['file_name']);
			}
			$this->db->insert('slideshow', array(
				'id'		=>	md5(rand().time()),
				'id_type'	=>	$type,
				'image'		=>	$data['upload_data']['file_name'],
				'status'	=>	$link,
			));
		}
		
		function _Change_Slideshow($type='slideshow', $url_dir='public/uploads/slideshow/', $width=750, $height=230, $thumbs=true, $widththumb=337, $heightthumb=90){
			$image=$_FILES['user_file']['name'];
			$link=strip_tags($this->input->post('link'));
			$id=$this->uri->segment(4);
			if($image!='')
			{
				$data=$this->_Get_Slideshow_By_Id($id);
				unlink($url_dir.$data['image']);
				unlink($url_dir.'thumbs/'.$data['image']);
				$this->load->helper('uploadimg');
				$data=$this->DoUpload($url_dir);
				$this->DoResize($data['upload_data']['full_path'], $width, $height, $data['upload_data']['full_path']);
				if($thumbs==true){
					$this->DoResize($data['upload_data']['full_path'], $widththumb, $heightthumb, $url_dir.'thumbs/'.$data['upload_data']['file_name']);
				}
				$this->db->where('id', $id);
				$this->db->update('slideshow', array(
					'image'		=>	$data['upload_data']['file_name'],
					'status'	=>	$link,
				));
			}
			else
			{
				$this->db->where('id', $id);
				$this->db->update('slideshow', array(
					'status'	=>	$link,
				));
			}
		}
		
		function DoResize($source_file, $nwidth, $nheight, $file_name){
			$file=$source_file;
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
			//$newheight=$nheight;
			//$newwidth=$nwidth;
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
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			$filename =$file_name;
			if( $imgtype == IMAGETYPE_JPEG ) {
				 imagejpeg($tmp,$filename,100);
			  } elseif( $imgtype == IMAGETYPE_GIF ) {
				 imagegif($tmp,$filename);
			  } elseif( $imgtype == IMAGETYPE_PNG ) {
				 imagepng($tmp,$filename);
			  }
			imagedestroy($src);
			imagedestroy($tmp);
		}
		
		function DoUpload($url_dir){
			$config['upload_path'] 		= 	$url_dir;
			$config['allowed_types'] 	= 	'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
			$config['max_size']			= 	8*1024;
			$config['max_filename']		=	250;
			$config['encrypt_name']		=	true;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('user_file')){
				$data['log']=$this->upload->display_errors();
				$data['error']=false;
				return $data;
			}else{
				$data['upload_data']=$this->upload->data();
				$data['error']=true;
				return $data;
			}
		}
	}
?>