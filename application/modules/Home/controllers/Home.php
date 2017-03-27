<?php
	class Home extends MX_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			
		}
		
		public function index()
		{		
			$this->load->view('header');
			$this->load->view('index');
			$this->load->view('footer');	
		}
		
		public function construction()
		{
			
			$this->load->view('construction');
			
		}
	}
?>