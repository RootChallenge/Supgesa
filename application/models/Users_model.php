<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');
	
	class Users_model extends MY_Model{
		
		protected $_table = 'users';
		
		protected $primary_key = 'idUser';
		
		
		public function __construct(){
			parent::__construct();
		}
	}


