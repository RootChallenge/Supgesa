<?php
	class Panne_model extends MY_Model
	{
		protected $_table = 'panne';
		protected $primary_key = 'idPanne';
		protected $belongs_to = array('vehicule'=> array('primary_key'=>'idVehicule', 'model'=>'Vehicule_model'));
		
		public function __construct()
		{
			parent::__construct();
		}
		public function getPanne($idVehicule)
		{
			$this->db->select('*');
        return $this->db->get_where('panne',array('idVehicule'=>$idVehicule))->result();
		}
		
		public function getLastPanne($limit = 5, $offset = 0)
		{
			$this->db->select('*')
			->join('vehicule', 'vehicule.idVehicule = panne.idVehicule')
			 ->where('etat', 1)
			->limit($limit, $offset);
			return $this->db->get($this->_table)->result();
		}
		
	}
?>