<?php
	class Marque_model extends MY_Model
	{
		protected $_table = 'marque';
		protected $primary_key = 'idMarque';
		
		public function __construct()
		{
			parent::__construct();
		}
		
		function exists($conditions)
		{
			$query = $this->db->get_where('marque', $conditions);
			return $query->num_rows() > 0;
		}
	}
?>