<!DOCTYPE html>
<html lang="fr">
	<head>
		<link rel="shortcut icon" href="<?php echo site_url('assets/img/icone.png'); ?>">
		
		<link href="<?php echo site_url('assets/css/bootstrap/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
		<link href="<?php echo site_url('assets/css/bootstrap/bootstrap/css/simple-sidebar.css') ?>" rel="stylesheet">
		<link href="<?php echo site_url('assets/css/style.css') ?>" rel="stylesheet">
		<link href="<?php echo site_url('assets/js/jquery-ui.css') ?>" rel="stylesheet">
		<link href="<?php echo site_url('assets/css/highlight.css') ?>" rel="stylesheet">
		<link href="<?php echo site_url('assets/css/modalCss.css') ?>" rel="stylesheet">
		
		<script src="<?php echo site_url('assets/js/ckeditor/ckeditor.js') ?>"></script>
		
		<title>SupGesa Ecole de Formation Supérieure</title>
	</head>
	
	<body>
	<div class="container-fluid">
	
	
		<div class="header">
			<center><img class="img-responsive" src="<?php echo site_url('assets/image/banni.png') ?>"></center>
		</div>
		
		<div class="menu">
			<nav>
				<ul class="nav nav-tabs">
					<li><a  href="<?php echo base_url();?>"><i class = "glyphicon glyphicon-home"></i> Accueil</a></li>		  	
					<li role="presentation" class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							L'Ecole <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Présentation</a></li>
							
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Organisation</a></li>
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Partenaires</a></li>
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Accès à l'école</a></li>
						</ul>
					</li>
				
					<li role="presentation" class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							 Les Formations <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Droit-Economie-Management</a></li>							
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Sciences Appliquées</a></li>
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Certifications</a></li>
						</ul>
					</li>
					<li role="presentation" class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							 Admission <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Conditons</a></li>							
							<li><a class="sous-menu" href="">Horaires</a></li>
							<li><a class="sous-menu" href="">Tarifs</a></li>
						</ul>
					</li>
					<li role="presentation" class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							 Espace Etudiant <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a class="sous-menu" href="<?php echo site_url('Forum'); ?>">Forum de discussion</a></li>
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Orientation</a></li>
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Jobs et stages</a></li>
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Bureau des étudiants</a></li>
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Réseau des diplomés de SupGesa</a></li>
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Relevé de notes</a></li>
						</ul>
					</li>
					<li role="presentation" class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							 Publication<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a class="sous-menu" href="<?php echo site_url('Accueil/construction'); ?>">Livre</a></li>
							
							<li><a class="sous-menu" href="">Mémoire projet</a></li>
							<li><a class="sous-menu" href="">Exposé</a></li>
						</ul>
					</li>
					<li role="presentation"><a href="moodle" target="_blanck">E-learning</a></li>
					<li role="presentation"><a href="<?php echo site_url('Accueil/construction'); ?>">Contacts</a></li>
					<li class="pull-right"><a href="#" data-toggle="modal" data-target="#login-modal">Se connecter</a></li>
				</ul>
				
						
				
			</nav>
			<!-- Fenetre modal -->
			<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="loginmodal-container">
						<h1>Connectez Vous</h1><br>
					<?php echo form_open('users/login');?>
						<?php echo form_input('users_username', set_value('users_username'), array('class' => "form-control tooltip-input", 'required' => true, 'placeholder' => 'Nom d\'utilisateur', 'title' => 'Veuillez saisir votre nom d\'utilisateur'));?>
						<?php echo form_password('users_password', null, array('class' => "form-control tooltip-input",  'required' => true, 'placeholder' => 'Mot de passe', 'title' => 'Veuillez saisir votre mot de passe personnel'));?>
						<?php echo form_submit('submit', 'Valider', array('class' => 'login loginmodal-submit'));?>	
						<p class="text-center">Pas de compte, <a href="<?php echo site_url('users/add')?>">inscrivez vous</a></p>
					<?php echo form_close();?>
					  
					</div>
				</div>
			</div>
		
		
		</div>
		
		
		<div id="myCarousel" class="carousel slide" data-ride="carousel">

						 

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
							<div class="item active">
							  <img src="<?php echo site_url('assets/image/gif.png') ?>" alt="Chania" width="100%">
							</div>

							<div class="item">
							  <img src="<?php echo site_url('assets/image/gif2.png') ?>" alt="Chania" width="100%">
							</div>

							<div class="item">
							  <img src="<?php echo site_url('assets/image/gif3.png') ?>" alt="Flower" width="100%">
							</div>
							<div class="item">
							  <img src="<?php echo site_url('assets/image/gif4.png') ?>" alt="Flower" width="100%">
							</div>

							
						  </div>

						  <!-- Left and right controls -->
						  
			</div>
			</br>
	
	
	
	
	
	
	
	
	
	
	<!-- Affichage des informations grace aux flashdata -->
		<?php
			if($this->session->flashdata('success'))
			{
				echo "<br><br><center><p class = 'alert alert-success'>".$this->session->flashdata('success')."</p></center>";
			}
			if($this->session->flashdata('info'))
			{
				echo "<br><br><center><p class = 'alert alert-info'>".$this->session->flashdata('info')."</p></center>";
			}
			if($this->session->flashdata('error'))
			{
				echo "<br><br><center><p class = 'alert alert-danger'>".$this->session->flashdata('error')."</p></center>";
			}
			if($this->session->flashdata('warning'))
			{
				echo "<br><br><center><p class = 'alert alert-warning'>".$this->session->flashdata('warning')."</p></center>";
			}
		?>
	<!-- Fin d'affichage des informations du flashdata -->