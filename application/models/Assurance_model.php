<?php
	class Assurance_model extends MY_Model
	{
		protected $_table = 'assurance';
		protected $primary_key = 'idAssurance';
		
		public function __construct()
		{
			parent::__construct();
		}
		
		function exists($conditions)
		{
			$query = $this->db->get_where('assurance', $conditions);
			return $query->num_rows() > 0;
		}
	}
?>