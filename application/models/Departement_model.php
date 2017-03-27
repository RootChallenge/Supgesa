<?php
	class Departement_model extends MY_Model
    {
		protected $_table = "departement";
		protected $primary_key="idDepartement";
	
		public function __construct()
		{
			parent::__construct();
		}
	
		public function exists($conditions)
		{
			$query = $this->db->get_where('departement', $conditions);
			return $query->num_rows() > 0;
		}
	}
?>