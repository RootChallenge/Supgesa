<?php
	class Revision_model extends MY_Model
	{
		protected $_table = 'revision';
		protected $primary_key = 'idRevision';
		protected $belongs_to = array('vehicule'=> array('primary_key'=>'idVehicule', 'model'=>'Vehicule_model'));
		public function __construct()
		{
			parent::__construct();
		}
		
		
		public function get_last_revision_for_vehicule($idVehicule){
			$this->db->where('idVehicule', $idVehicule)
			->order_by('dateRevision', 'desc')
			->limit(1);
			return $this->db->get('revision')->row();
		}
		
		
	}
?>	