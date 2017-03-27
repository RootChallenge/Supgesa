<?php
	class Vehicule_model extends MY_Model
	{
		protected $_table = 'vehicule';
		protected $primary_key = 'idVehicule';
		protected $belongs_to = array('fournisseur' => array('primary_key'=>'idFournisseur', 'model'=>'Fournisseur_model'),'assurance'=> array('primary_key'=>'idAssurance', 'model'=>'Assurance_model'),'departement'=> array('primary_key'=>'idDepartement', 'model'=>'Departement_model'),'chauffeur'=> array('primary_key'=>'idChauffeur', 'model'=>'Chauffeur_model'),'marque'=> array('primary_key'=>'idMarque', 'model'=>'Marque_model'));
		
		public function __construct()
		{
			parent::__construct();
		}
		
				
	}
?>