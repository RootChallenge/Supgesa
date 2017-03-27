<?php
	class Accident_model extends MY_Model
	{
		protected $_table = 'accident';
		protected $primary_key = 'idAccident';
		protected $belongs_to = array('vehicule'=> array('primary_key'=>'idVehicule', 'model'=>'Vehicule_model','chauffeur'=> array('primary_key'=>'idChauffeur', 'model'=>'Chauffeur_model')));

		
		public function __construct()
		{
			parent::__construct();
		}
		
		function exists($conditions)
		{
			$query = $this->db->get_where('accident', $conditions);
			return $query->num_rows() > 0;
		}
		
		public function getAccident($idVehicule)
		{
			$this->db->select('*')
			->join('chauffeur', 'chauffeur.idChauffeur = accident.idChauffeur');
        return $this->db->get_where('accident',array('idVehicule'=>$idVehicule))->row_array();
		}
	}
?>
