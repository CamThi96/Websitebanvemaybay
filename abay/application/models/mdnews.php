<?php
	class MdNews extends CI_Model{
		var $obj;
		function __Construct(){
			parent::__Construct();
			$this->obj=&get_instance();
		}
		
		function GetNews($id, $type){
			$this->db->where(array('news.id'=>$id, 'type'=>$type));
			$this->db->from('news');
			$this->db->join('news_vi', 'news.id=news_vi.id');
			$this->db->join('news_en', 'news.id=news_en.id');
			$data=$this->db->get();
			if($data->num_rows()!=0){
				$data=$data->result_array();
				return $data[0];
			}else{
				return false;
			}
		}
		
		function CheckSub($sub){
			$this->db->where(array('type'=>'news', 'subtype'=>$sub));
			$data=$this->db->get('news')->num_rows();
			if($data==0){
				return false;
			}else{
				return true;
			}
		}
		
		function GetTopNewsBySub($sub){
			$this->db->where(array('type'=>'news', 'subtype'=>$sub));
			$this->db->from('news');
			$this->db->join('news_vi', 'news.id=news_vi.id');
			$this->db->limit(5);
			return $this->db->get()->result_array();
		}
		
		function GetAllNewsBySub($sub){
			$this->db->where(array('type'=>'news', 'subtype'=>$sub));
			$this->db->from('news');
			$this->db->join('news_vi', 'news.id=news_vi.id');
			return $this->db->get()->result_array();
		}
		
		function GetNewsBySub($id, $sub){
			$this->db->where(array('news.id'=>$id, 'type'=>'news', 'subtype'=>$sub));
			$this->db->from('news');
			$this->db->join('news_vi', 'news.id=news_vi.id');
			$data=$this->db->get();
			if($data->num_rows()!=0){
				$data=$data->result_array();
				return $data[0];
			}else{
				return false;
			}
		}
		
		function GetNewsNotId($id){
			$this->db->where('id', $id);
			$data=$this->db->get('news')->result_array();
			$this->db->where("news.id != '{$data[0]['id']}' and type='{$data[0]['type']}' and subtype='{$data[0]['subtype']}'");
			$this->db->order_by('date desc, time desc');
			$this->db->from('news');
			$this->db->join('news_vi', 'news.id=news_vi.id');
			return $this->db->get()->result_array();
		}
		
		function Delete_News($id, $type, $url_dir='public/uploads/news/'){
			$data=$this->GetNews($id, $type);
			unlink($url_dir.$data['image']);
			$this->db->where(array('id'=>$id, 'type'=>$type));
			$this->db->delete('news');
			$this->db->where('id',$id);
			$this->db->delete('news_vi');
			$this->db->where('id',$id);
			$this->db->delete('news_en');
		}
		
		function Change_News($type, $sub='', $url_dir='public/uploads/news/'){
			$id=$this->uri->segment(4);
			$this->load->helper('unicode');
			$this->obj->load->model('mdstatistics');
			$subtype=strip_tags($this->input->post('sub'));
			$log=$this->obj->mdstatistics->get_log();
			$title_vi=strip_tags($this->input->post('title_vi'));
			$title_en=strip_tags($this->input->post('title_en'));
			$date=ngay();
			$time=gio();
			$summary_vi=nl2br(strip_tags($this->input->post('summary_vi')));
			$summary_en=nl2br(strip_tags($this->input->post('summary_en')));
			$content_vi=$this->input->post('content_vi');
			$content_en=$this->input->post('content_en');
			$image=$_FILES['user_file']['name'];
			if($image!=''){
				$data=$this->GetNews($id, $type);
				unlink($url_dir.$data['image']);
				$this->load->library('my_img');
				$data=$this->my_img->upload($url_dir);
				if($data['error']==true){
					$image=$data['upload_data']['file_name'];
					$this->my_img->doresize(300, 190, $data['upload_data']['full_path'], $data['upload_data']['full_path']);
				}else{
					$image='default.jpg';
				}
				$this->db->where('id', $id);
				$this->db->update('news', array(
					'date_update'	=>	$date,
					'time_update'	=>	$time,
					'log'			=>	$log,
					'image'			=>	$image,
					'subtype'		=>	$subtype,
				));
				$this->db->where('id', $id);
				$this->db->update('news_vi', array(
					'summary_vi'	=>	$summary_vi,
					'content_vi'	=>	$content_vi,
					'title_vi'		=>	$title_vi,
				));
				$this->db->where('id', $id);
				$this->db->update('news_en', array(
					'summary_en'	=>	$summary_en,
					'content_en'	=>	$content_en,
					'title_en'		=>	$title_en,
				));
			}else{
				$this->db->where('id', $id);
				$this->db->update('news', array(
					'date_update'	=>	$date,
					'time_update'	=>	$time,
					'log'			=>	$log,
					'subtype'		=>	$subtype,
				));
				$this->db->where('id', $id);
				$this->db->update('news_vi', array(
					'summary_vi'	=>	$summary_vi,
					'content_vi'	=>	$content_vi,
					'title_vi'		=>	$title_vi,
				));
				$this->db->where('id', $id);
				$this->db->update('news_en', array(
					'summary_en'	=>	$summary_en,
					'content_en'	=>	$content_en,
					'title_en'		=>	$title_en,
				));
			}
		}
		
		function Add_News($type, $sub='', $url_dir='public/uploads/news/'){
			$this->load->helper('unicode');
			$this->obj->load->model('mdstatistics');
			$subtype=strip_tags($this->input->post('sub'));
			$log=$this->obj->mdstatistics->get_log();
			$title_vi=strip_tags($this->input->post('title_vi'));
			$title_en=strip_tags($this->input->post('title_en'));
			$id=khongdau($title_vi).rand5str();
			$date=ngay();
			$time=gio();
			$summary_vi=nl2br(strip_tags($this->input->post('summary_vi')));
			$summary_en=nl2br(strip_tags($this->input->post('summary_en')));
			$content_vi=$this->input->post('content_vi');
			$content_en=$this->input->post('content_en');
			$image=$_FILES['user_file']['name'];
			if($image!=''){
				$this->load->library('my_img');
				$data=$this->my_img->upload($url_dir);
				if($data['error']==true){
					$image=$data['upload_data']['file_name'];
					$this->my_img->doresize(300, 190, $data['upload_data']['full_path'], $data['upload_data']['full_path']);
				}else{
					$image='default.jpg';
				}
			}else{
				$image='default.jpg';
			}
			$this->db->insert('news', array(
				'id'		=>	$id,
				'type'		=>	$type,
				'order'		=>	time(),
				'date'		=>	$date,
				'time'		=>	$time,
				'log'		=>	$log,
				'image'		=>	$image,
				'subtype'	=>	$subtype,
			));
			$this->db->insert('news_vi', array(
				'id'		=>	$id,
				'summary_vi'=>	$summary_vi,
				'content_vi'=>	$content_vi,
				'title_vi'	=>	$title_vi,
			));
			$this->db->insert('news_en', array(
				'id'		=>	$id,
				'summary_en'=>	$summary_en,
				'content_en'=>	$content_en,
				'title_en'	=>	$title_en,
			));
		}
		
		function GetCountByType($type){
			$this->db->where('type', $type);
			return $this->db->get('news')->num_rows();
		}
		
		function GetNewsByType($type, $perpage, $page){
			$this->db->from('news');
			$this->db->where('type', $type);
			$this->db->limit($perpage, $page);
			$this->db->order_by('date desc, time desc');
			$this->db->join('news_vi', 'news.id=news_vi.id');
			$this->db->join('news_en', 'news.id=news_en.id');
			return $this->db->get()->result_array();
		}
	}
?>