<?php
	class Forum_post_model extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		function get_post($post_id)
		{
			return $this->db->get_where('forum_post',array('post_id'=>$post_id))->row_array();
		}
		
		public function get_all_post($post_id, $limit = null, $offset = 0)
		{
			$this->db->order_by('topic_id')
					 ->join('users', 'users.users_id = forum_topic.topic_createur')
					 ->where(array('forum_topic.topic_id' => $topic_id));
			return $this->db->get('forum_topic', $limit, $offset)->result_array();
		}
		
		public function get_all_post_by_topic($topic_id, $limit = null, $offset = 0)
		{
			$this->db->order_by('post_id')
					 ->join('forum_topic', 'forum_topic.topic_id = forum_post.topic_id')
					 ->join('users', 'users.users_id = forum_post.post_createur')
					 ->where(array('forum_post.topic_id' => $topic_id));
			return $this->db->get('forum_post', $limit, $offset)->result_array();
		}
		
		function add_post($params)
		{
			$this->db->insert('forum_post',$params);
			return $this->db->insert_id();
		}
		
		function update_post($post_id,$params)
		{
			$this->db->where('post_id',$post_id);
			$this->db->update('forum_post',$params);
		}
		
		function delete_post($post_id)
		{
			$this->db->delete('forum_post',array('post_id'=>$post_id));
		}
		
		public function total_post()
		{
			return $this->db->count_all('forum_post');
		}
	}
?>