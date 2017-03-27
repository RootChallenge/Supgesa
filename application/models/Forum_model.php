<?php
	class Forum_model extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		function get_forum($forum_id)
		{
			return $this->db->get_where('forum_forum',array('forum_id'=>$forum_id))->row_array();
		}
		
		public function get_all_forum($limit = null, $offset = 0)
		{
			$this->db->select('*');
			return $this->db->get('forum_forum', $limit, $offset)->result_array();
		}
		
		function count_all($forum_id)
		{
			$query = $this->db->get_where('forum_forum', array('forum_id' => $forum_id));
			return $query->num_rows();
		}
		
		public function get_all_forum_for_categorie($id_categorie, $limit = null, $offset = 0)
		{
			$this->db->order_by('forum_id')
					 ->join('forum_categorie', 'forum_categorie.id_categorie = forum_forum.forum_cat_id')
					 ->where(array('forum_cat_id' => $id_categorie));
			return $this->db->get('forum_forum', $limit, $offset)->result_array();
		}
		
		function add_forum($params)
		{
			$this->db->insert('forum_forum',$params);
			return $this->db->insert_id();
		}
		
		function alerte_moderateur($params)
		{
			$this->db->insert('alerte_moderateur', $params);
			return $this->db->insert_id;
		}
		
		function get_all_alerte()
		{
			$this->db->order_by('date_ajout')
					 ->join('forum_topic', 'forum_topic.topic_id = alerte_moderateur.id_topic')
					 ->join('users', 'users.users_id = alerte_moderateur.users_id');
			return $this->db->get('alerte_moderateur')->result_array();
		}
		
		function update_forum($forum_id,$params)
		{
			$this->db->where('forum_id',$forum_id);
			$this->db->update('forum_forum',$params);
		}
		
		function delete_forum($forum_id)
		{
			$this->db->delete('forum_forum',array('forum_id'=>$forum_id));
		}
		
		public function total_forum()
		{
			return $this->db->count_all('forum_forum');
		}
	}
?>