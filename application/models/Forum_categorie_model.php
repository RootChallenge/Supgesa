<?php
	class Forum_categorie_model extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		function get_categorie($id_categorie)
		{
			return $this->db->get_where('forum_categorie',array('id_categorie'=>$id_categorie))->row_array();
		}
		
		public function get_all_categorie($limit = null, $offset = 0)
		{
			$this->db->select('*');
			return $this->db->get('forum_categorie', $limit, $offset)->result_array();
		}
		
		function add_categorie($params)
		{
			$this->db->insert('forum_categorie',$params);
			return $this->db->insert_id();
		}
		
		function update_categorie($id_categorie,$params)
		{
			$this->db->where('id_categorie',$code_entreprise);
			$this->db->update('forum_categorie',$params);
		}
		
		function delete_categorie($id_categorie)
		{
			$this->db->delete('forum_categorie',array('id_categorie'=>$id_categorie));
		}
		
		public function total_categorie()
		{
			return $this->db->count_all('forum_categorie');
		}
	}
?>