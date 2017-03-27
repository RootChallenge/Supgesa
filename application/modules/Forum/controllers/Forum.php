<?php
	class Forum extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->load->model('Forum_categorie_model');
			$this->load->model('Forum_model');
			$this->load->model('Users_model');
			$this->load->model('Forum_topic_model');
			$this->load->model('Forum_post_model');
		}
		
		public function index()
		{
			$data['all_categorie'] = $this->Forum_categorie_model->get_all_categorie();
			
			
			$tab = array();
			
			$categories = $this->Forum_categorie_model->get_all_categorie();
			
			for($i = 0; $i < COUNT($categories); $i++)
			{
				$categorie = $categories[$i];
				
				$id_categorie = $categorie['id_categorie'];
				
				$forum = $this->Forum_model->get_all_forum_for_categorie($id_categorie, $limit = null, $offset = 0);
				
				$tab[$i] = $categorie;
				$tab[$i]['forums'] = $forum;
			}
			
			$data['forum'] = $tab;
			
			
			
			$this->load->view('header', $data);
			$this->load->view('Forum/index', $data);
			$this->load->view('footer');
		}
		
		public function voir_forum($forum_id)
		{
			$this->load->library('pagination');
			$config = array(
				'base_url'          => site_url('Forum/voir_forum/'.$forum_id.'/'),
				'total_rows'        => $this->Forum_topic_model->count_all($forum_id),
				'per_page'          => 1,
				'uri_segment'       => 4,
				'num_links'         => 3,
				'full_tag_open'     => '<ul class = "pagination">',
				'full_tag_close'     => '</ul>',
				'next_link'     => 'Suivant.',
				'prev_link'     => 'Précédent.',
				'num_tag_open' => '<li>',
				'num_tag_close' => '</li>',
				'prev_tag_open' => '<li>',
				'prev_tag_close' => '</li>',
				'next_tag_open' => '<li>',
				'next_tag_close' => '</li>',
				'cur_tag_open' => '<li class = "active"><a href = "#">',
				'cur_tag_close' => '</a></li>'
			);
			
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			
			
			$data['topic'] = $this->Forum_topic_model->get_all_topic_by_forum($forum_id, $config['per_page'], $this->uri->segment(4));
			//$data['annonce'] = $this->Forum_topic_model->get_all_annonce_by_forum($forum_id, $limit = null, $offset = 0);
			$data['lien'] = $forum_id;
			
			$donnees = $this->Forum_model->get_forum($forum_id);
			$nom = $donnees['forum_name'];
			
			
			
			$this->load->view('header', $data);
			$this->load->view('Forum/voir_forum', $data);
			$this->load->view('footer');
		}
		
		public function ajouter_sujet($forum_id)
		{
			$data = $this->session->userdata('login');
			$pseudo = $data['pseudo'];
			$id_users = $data['id_users'];
			
			$date = date('d/m/Y H:i:s');
			
			if(empty($pseudo))
			{
				redirect(base_url());
			}
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('titre', 'Titre', 'trim|required');
			$this->form_validation->set_rules('contenu', 'Contenu', 'trim|required');
			
			if($this->form_validation->run() === FALSE)
			{
				$data['forum'] = $forum_id;
				
				
				
				
				$this->load->view('header', $data);
				$this->load->view('Forum/ajouter_sujet', $data);
				$this->load->view('footer');
			}
			else
			{
				$titre = $this->input->post('titre');
				$contenu = $this->input->post('contenu');
				
				$params = array(
					'forum_id' => $forum_id,
					'topic_titre' => $titre,
					'topic_createur' => $id_users,
					'topic_time' => $date,
					'topic_texte' => $contenu,
				);
				
				$topic_id = $this->Forum_topic_model->add_topic($params);
				if($topic_id)
				{
					
					$this->session->set_flashdata('sucess', 'Sujet ajouté avec succes');
					redirect(site_url('Forum/voir_forum/'.$forum_id));
				}
				else
				{
					$this->session->set_flashdata('error', 'Une erreur est survenue lors de l\'ajout de votre sujet');
					
				
					$this->load->view('header', $data);
					$this->load->view('Forum/ajouter_sujet/'.$forum_id);
					$this->load->view('footer');
				}
			}
		}
		
		public function modifier_sujet()
		{
			
		}
		
		public function supprimer_sujet()
		{
			
		}
		
		public function deplacer_sujet()
		{
			
		}
		
		public function voir_topic($topic_id)
		{
			$data['topic'] = $this->Forum_topic_model->get_all_topic($topic_id, $limit = null, $offset = 0);
			$data['post'] = $this->Forum_post_model->get_all_post_by_topic($topic_id, $limit = null, $offset = 0);
			$data['lien'] = $topic_id;
			
			$donnees = $this->Forum_topic_model->get_topic($topic_id);
			$nom = $donnees['topic_titre'];
			
			
			
			$this->load->view('header', $data);
			$this->load->view('Forum/voir_topic', $data);
			$this->load->view('footer');
		}
		
		
		public function poster_commentaire()
		{
			$data = $this->session->userdata('login');
			$pseudo = $data['pseudo'];
			$id_users = $data['id_users'];
			
			$this->load->library('form_validation');
			
			$topic_id = $this->input->post('t');
			
			$this->form_validation->set_rules('contenu', 'Contenu', 'trim|required');
			
			if($this->form_validation->run() === FALSE)
			{
				$this->session->set_flashdata('error', 'Le contenu de votre commentaire est obligatoire');
				redirect(site_url('Forum/voir_topic/'.$topic_id));
			}
			else
			{
				$date = date('d/m/Y H:i:s');
				$contenu = $this->input->post('contenu');
				
				$params = array(
					'post_createur' => $id_users,
					'post_texte' => $contenu,
					'post_time' => $date,
					'topic_id' => $topic_id,
				);
				
				$post_id = $this->Forum_post_model->add_post($params);
				
				if($post_id)
				{
					$this->session->set_flashdata('sucess', 'Votre commentaire a bien été enregistrer');
					redirect(site_url('Forum/voir_topic/'.$topic_id));
				}
				else
				{
					$this->session->set_flashdata('error', 'Une erreur est survenue lors de l\'ajout de votre commentaire ');
					redirect(site_url('Forum/voir_topic/'.$topic_id));
				}
			}
		}
		
		public function alerte_moderateur()
		{
			$data = $this->session->userdata('login');
			$pseudo = $data['pseudo'];
			$id_users = $data['id_users'];
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('sujet', 'Sujet', 'trim|required');
			$this->form_validation->set_rules('message', 'Message', 'trim|required');
			
			if($this->form_validation->run() === FALSE)
			{
				$id = $this->input->post('id');
				
				redirect('Forum/voir_topic/'.$id);
			}
			else
			{
				$sujet = $this->input->post('sujet');
				$message = $this->input->post('message');
				$id_topic = $this->input->post('id');
				
				$params = 	array(
					'sujet' => $sujet,
					'message' => $message,
					'id_topic' => $id_topic,
					'id_users' => $users_id,
				);
				
				$alerte_id = $this->Forum_model->alerte_moderateur($params);
				
				if($alerte_id)
				{
					$this->session->set_flashdata('sucess', 'Votre alerte à bien été envoyée');
					redirect(site_url('Forum/voir_topic/'.$id_topic));
				}
				else
				{
					$this->session->set_flashdata('sucess', 'Une erreur est survenue lors de l\'envoie de votre alerte');
					redirect(site_url('Forum/voir_topic/'.$id_topic));
				}
			}
		}
		
	}
?>