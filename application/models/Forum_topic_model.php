<?php
	class Forum_topic_model extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		function get_topic($topic_id)
		{
			return $this->db->get_where('forum_topic',array('topic_id'=>$topic_id))->row_array();
		}
		
		public function get_all_topic($topic_id, $limit = null, $offset = 0)
		{
			$this->db->order_by('topic_id')
					 ->join('users', 'users.users_id = forum_topic.topic_createur')
					 ->where(array('forum_topic.topic_id' => $topic_id));
			return $this->db->get('forum_topic', $limit, $offset)->result_array();
		}
		
		public function get_all_annonce($limit = null, $offset = 0)
		{
			$this->db->order_by('topic_id')
					 ->where(array('annonce' => 1));
			return $this->db->get('forum_topic', $limit, $offset)->result_array();
		}
		
		function count_all($forum_id)
		{
			$query = $this->db->get_where('forum_topic', array('forum_id' => $forum_id));
			return $query->num_rows();
		}
		
		public function get_all_topic_by_forum($forum_id, $limit = null, $offset = 0)
		{
			$this->db->order_by('topic_id')
					 ->join('forum_forum', 'forum_forum.forum_id = forum_topic.forum_id')
					 ->join('users', 'users.users_id = forum_topic.topic_createur')
					 ->where(array('forum_topic.forum_id' => $forum_id));
			return $this->db->get('forum_topic', $limit, $offset)->result_array();
		}
		
		
		public function get_all_annonce_by_forum($forum_id, $limit = null, $offset = 0)
		{
			$this->db->order_by('topic_id')
					 ->join('forum_forum', 'forum_forum.forum_id = forum_topic.forum_id')
					 ->join('users', 'users.users_id = forum_topic.topic_createur')
					 ->where(array('forum_topic.forum_id' => $forum_id, 'forum_topic.annonce' => 1));
			return $this->db->get('forum_topic', $limit, $offset)->result_array();
		}
		
		function add_topic($params)
		{
			$this->db->insert('forum_topic',$params);
			return $this->db->insert_id();
		}
		
		function update_topic($topic_id,$params)
		{
			$this->db->where('topic_id',$topic_id);
			$this->db->update('forum_topic',$params);
		}
		
		function delete_topic($topic_id)
		{
			$this->db->delete('forum_topic',array('topic_id'=>$topic_id));
		}
		
		public function total_topic()
		{
			return $this->db->count_all('forum_topic');
		}
	}
?>