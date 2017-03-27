<?php
	class Fournisseur_model extends MY_Model
	{
		protected $_table = 'fournisseur';
		protected $primary_key = 'idFournisseur';
		
		public function __construct()
		{
			parent::__construct();
		}
		
		public function exists($conditions)
		{
			$query = $this->db->get_where('fournisseur', $conditions);
			return $query->num_rows() > 0;
		}
	}
?>