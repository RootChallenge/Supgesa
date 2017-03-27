<?php
	class Chauffeur_model extends MY_Model
	{
		protected $_table = 'chauffeur';
		protected $primary_key = 'idChauffeur';
		
		public function __construct()
		{
			parent::__construct();
		}
		
		function exists($conditions)
		{
			$query = $this->db->get_where('chauffeur', $conditions);
			return $query->num_rows() > 0;
		}
	}
?>