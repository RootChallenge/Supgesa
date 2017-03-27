<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

	/**
	 * Copyright (C) 2016 Tony NGUEREZA
	 *
	 * This program is free software; you can redistribute it and/or
	 * modify it under the terms of the GNU General Public License
	 * as published by the Free Software Foundation; either version 2
	 * of the License, or (at your option) any later version.
	 *
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License
	 * along with this program; if not, write to the Free Software
	 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
	 */


	/**
	* the usersentification class
	*
	* this class is used to manage the user usersentification. It extends
	* the MX_Controller to permit the use of HMVC
	*
	* @package users
	*
	* @usersor Tony NGUEREZA <nguerezatony@gmail.com>
	*/

	class Users extends MX_Controller
	{

		/**
		* the class constructor
		*
		* @access public
		* @return void
		*/
		public function __construct(){
			
			//called the parent constructor
			parent::__construct(); 
			//load the users model class
			$this->load->model('Users_model');
		}
		

		/**
		* the default method called if no method is given
		*
		* @access public
		* @return void
		*/
		public function index(){
			modules::run('users/check_admin');
			
			$data['liste_users'] = $this->Users_model->get_all();
			$this->load->view('header');
			$this->load->view('index', $data);
			$this->load->view('footer');
		}
		
		
		
		public function add(){
			modules::run('users/check_admin');
			
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<p class = "error">', '</p>');
			
			$this->form_validation->set_rules('users_username', 'nom d\'utilisateur', 'trim|required|min_length[3]|alpha_dash|is_unique[users.users_username]');
			$this->form_validation->set_rules('users_email', 'E-mail', 'trim|required|valid_email|is_unique[users.users_email]');
			$this->form_validation->set_rules('users_nom', 'nom', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('users_prenom', 'prénom', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('users_permission', 'permission', 'required|in_list[0,1,2]');
			
			
			if($this->form_validation->run() === FALSE)
			{
				$this->load->view('header');
				$this->load->view('add');
				$this->load->view('footer');
			}
			else
			{
				$users_username = $this->input->post('users_username');
				$users_email =  $this->input->post('users_email');
				$users_permission =  $this->input->post('users_permission');
				$users_password =  'passer';
				$users_nom =  strtoupper($this->input->post('users_nom'));
				$users_prenom =  ucfirst(strtolower($this->input->post('users_prenom')));
				$users_password_hach = md5($users_password);
				
				$params = array(
					'users_username' => $users_username,
					'users_email' => $users_email,
					'users_password' => $users_password_hach,
					'users_nom' => $users_nom,
					'users_prenom' => $users_prenom,
					'users_permission' => $users_permission
				);
				
				$users_id = $this->Users_model->insert($params);
				
				if($users_id)
				{
					$this->session->set_flashdata('success', 'Le compte utilisateur a été créé avec succès le mot de passe par défaut est <b>'.$users_password.'</b>');
					redirect('users');
				}
				else
				{
					$this->session->set_flashdata('error', 'Une erreur est survenue lors de la création du compte');
					$this->load->view('header');
					$this->load->view('add');
					$this->load->view('footer');
				}
				
			}
			
		}
		
		/**
		* the usersentification method to loggeg the user
		*
		* @access public
		* @return void
		*/
		public function login(){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<p class = "error">', '</p>');
			
			$this->form_validation->set_rules('users_username', 'nom d\'utilisateur', 'trim|required');
			$this->form_validation->set_rules('users_password', 'mot de passe', 'required');
			if($this->form_validation->run() === FALSE)
			{
				redirect(base_url());
			}
			else
			{
				$users_username = $this->input->post('users_username');
				$users_password =  $this->input->post('users_password');
				$users_password_hash = md5($users_password);
				
				 if(!$this->Users_model->get_by('users_username', $users_username)){
					$this->session->set_flashdata('error', 'Ce nom d\'utilisateur n\'existe pas veuillez rééssayer');
					redirect(base_url());
				 }
				 else if(!$this->Users_model->get_by(array('users_username' => $users_username, 'users_password' => $users_password_hash))){
					$this->session->set_flashdata('error', 'Votre mot de passe est incorrect');
					redirect(base_url());
				 }
				 else{
					 $user = $this->Users_model->get_by('users_username', $users_username);
					 $this->session->set_userdata('users', $user);
					 $session = $this->session->userdata('users');
					$isAdmin = modules::run('users/is_admin');
					 if($users_password == 'passer'){
						$this->session->set_flashdata('warning', 'Veuillez changer votre mot de passe car celui que vous utilisez est celui par défaut qui est "passer"'); 
						redirect('users/edit');
					 }
					 else if($isAdmin){
						 redirect('home/construction');
					 }
					 else{
						redirect('home/construction');
					 }
				 }	
			}
		}
		
		
		public function edit(){
			modules::run('users/check');
			
			$session = $this->session->userdata('users');
			
			$data['users'] = $this->Users_model->get($session->users_id);
				
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<p class = "error">', '</p>');
			
			$this->form_validation->set_rules('users_username', 'nom d\'utilisateur', 'trim|required|min_length[3]|alpha_dash');
			$this->form_validation->set_rules('users_email', 'E-mail', 'trim|required|valid_email');
			$this->form_validation->set_rules('users_nom', 'nom', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('users_prenom', 'prénom', 'trim|required|min_length[3]');
			
			
			if($this->form_validation->run() === FALSE)
			{
				$this->load->view('header');
				$this->load->view('edit', $data);
				$this->load->view('footer');
			}
			else
			{
				$users_username = $this->input->post('users_username');
				$users_email =  $this->input->post('users_email');
				$users_password =  $this->input->post('users_password');
				$users_nom =  strtoupper($this->input->post('users_nom'));
				$users_prenom =  ucfirst(strtolower($this->input->post('users_prenom')));
				$users_password_hach = md5($users_password);
				
				$params = array(
					'users_username' => $users_username,
					'users_email' => $users_email,
					'users_nom' => $users_nom,
					'users_prenom' => $users_prenom,
				);
				
				if(!empty($users_password)){
					$params['users_password'] = $users_password_hach;
				}
				
				$update = $this->Users_model->update($session->users_id, $params);
				
				if($update)
				{
					$this->session->set_flashdata('success', 'Votre compte a été modifié avec succès veuillez vous reconnecter');
					$this->session->unset_userdata('users');
					redirect(site_url('users/login'));	
				}
				else
				{
					$this->session->set_flashdata('error', 'Une erreur est survenue lors de la modification de votre compte');
					$this->load->view('header');
					$this->load->view('edit', $data);
					$this->load->view('footer');
				}
				
			}
			
		}
		
		
		public function update($users_id){
			modules::run('users/check_admin');
			
			$session = $this->session->userdata('users');
			
			$user = $this->Users_model->get($users_id);
			if(!$user){
				$this->session->set_flashdata('error', 'Cet utilisateur n\'existe pas');
				redirect('users');
			}
			
			$data['users'] = $user;
				
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<p class = "error">', '</p>');
			
			$this->form_validation->set_rules('users_username', 'nom d\'utilisateur', 'trim|required|min_length[3]|alpha_dash');
			$this->form_validation->set_rules('users_email', 'E-mail', 'trim|required|valid_email');
			$this->form_validation->set_rules('users_nom', 'nom', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('users_prenom', 'prénom', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('users_permission', 'permission', 'required|in_list[0,1,2]');
			
			
			if($this->form_validation->run() === FALSE)
			{
				$this->load->view('header');
				$this->load->view('update', $data);
				$this->load->view('footer');
			}
			else
			{
				$users_username = $this->input->post('users_username');
				$users_email =  $this->input->post('users_email');
				$users_password =  $this->input->post('users_password');
				$users_password_hach = md5($users_password);
				$users_permission =  $this->input->post('users_permission');
				$users_nom =  strtoupper($this->input->post('users_nom'));
				$users_prenom =  ucfirst(strtolower($this->input->post('users_prenom')));
				
				$params = array(
					'users_username' => $users_username,
					'users_email' => $users_email,
					'users_nom' => $users_nom,
					'users_prenom' => $users_prenom,
					'users_permission' => $users_permission
				);
				
				if(!empty($users_password)){
					$params['users_password'] = $users_password_hach;
				}
				
				$update = $this->Users_model->update($users_id, $params);
				
				if($update)
				{
					$this->session->set_flashdata('success', 'Le compte a été modifié avec succès');
					if($users_id == $user->users_id){
						$this->session->set_flashdata('success', 'Votre compte a été modifié avec succès veuillez vous reconnecter');
						$this->session->unset_userdata('users');
						redirect(site_url('users/login'));
					}
					redirect(site_url('users'));	
				}
				else
				{
					$this->session->set_flashdata('error', 'Une erreur est survenue lors de la modification du compte');
					$this->load->view('header');
					$this->load->view('update', $data);
					$this->load->view('footer');
				}
				
			}
			
		}
		
		
		public function delete($users_id){
			modules::run('users/check_admin');
			
			$session = $this->session->userdata('users');
			$users = $this->Users_model->get($users_id);
			if(!$users){
				$this->session->set_flashdata('error', 'Cet utilisateur n\'existe pas');
				redirect('users');
			}
			else if($users_id == $session->users_id){
				$this->session->set_flashdata('error', 'Vous ne pouvez pas supprimer votre propre compte');
				redirect('users');
			}
			
			$delete = $this->Users_model->delete($users_id);
			
			if($delete){
				$this->session->set_flashdata('success', 'Le compte utilisateur a été supprimé avec succès');
				redirect('users');
			}
		}
		
		
		/**
		* the method to check if the user is login
		*
		* @access public
		* @return void
		*/
		public function check(){
			$isLogin = false;
			$users = $this->session->userdata('users');
			$isLogin = !empty($users) 
			&& isset($users->users_username) 
			&& isset($users->users_id) 
			&& isset($users->users_permission) 
			&& isset($users->users_email);
			
			if(!$isLogin){
				$this->session->set_flashdata('error', 'Vous devez vous connecter pour acceder à cette page');
				redirect('users/login');
			}
		}
		
		
		
		/**
		* the method to check if the user is an administrator
		*
		* @access public
		* @return void
		*/
		public function is_admin(){
			$isAdmin = false;
			$users = $this->session->userdata('users');
			if(!$users){
				return false;
			}
			$isAdmin = ((int)$users->users_permission === 0);
			return $isAdmin;
		}
		
		
		/**
		* the method to check if the user is login and is an administrator
		*
		* @access public
		* @return void
		*/
		public function check_admin(){
			$this->check();
			$isAdmin = $this->is_admin();
			if(!$isAdmin){
				$this->session->set_flashdata('error', 'Vous devez être un administrateur pour acceder à cette page');
				redirect(base_url());
			}
		}
		
		
		
		
		/**
		* the method to check if the user is an chef
		*
		* @access public
		* @return void
		*/
		public function is_chef(){
			$isChef = false;
			$users = $this->session->userdata('users');
			if(!$users){
				return false;
			}
			$isChef = ((int)$users->users_permission === 1);
			return $isChef;
		}
		
		
		
		/**
		* the method to check if the user is login and is an chef
		*
		* @access public
		* @return void
		*/
		public function check_chef(){
			$this->check();
			$isChef = $this->is_chef();
			if(!$isChef){
				$this->session->set_flashdata('error', 'Vous devez être un chef de garage pour acceder à cette page');
				redirect(base_url());
			}
		}
		

		/**
		* disconnect the user
		*
		* @access public
		* @return void
		*/
		public function logout(){
			$this->session->unset_userdata('users');
			$this->session->set_flashdata('info', 'Vous êtes deconnecté avec succès');
			redirect(site_url('users/login'));
		}
		
		
		

	}


?>