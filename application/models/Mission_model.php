<?php
	class Mission_model extends MY_Model
    {
		protected $_table = "mission";
		protected $primary_key="idMission";
		protected $belongs_to= array('vehicule' => array('primary_key'=>'idVehicule', 'model'=>'Vehicule_model'),'chauffeur'=> array('primary_key'=>'idChauffeur', 'model'=>'Chauffeur_model'));
	
		public function __construct()
		{
			parent::__construct();
		}
		
		public function getMission($idVehicule)
		{
			$this->db->select('*')
			->join('chauffeur', 'chauffeur.idChauffeur = mission.idChauffeur');
        return $this->db->get_where('mission',array('idVehicule'=>$idVehicule))->result();
		}
	
		public function getLastMission($limit = 5, $offset = 0)
		{
			$this->db->select('*')
			->join('chauffeur', 'chauffeur.idChauffeur = mission.idChauffeur')
			->join('vehicule', 'vehicule.idVehicule = mission.idVehicule')
			 ->where('etat', 1)
			->limit($limit, $offset);
			return $this->db->get($this->_table)->result();
		}
		
		public function vehiculeDispo()
		{
			$this->db->select('*')
			->join('vehicule', 'mission.idVehicule = vehicule.idVehicule')
			->where('etat', 1)
			->group_by('mission.idVehicule');
       return $this->db->get($this->_table)->result();
		}
		
		
	}
?>