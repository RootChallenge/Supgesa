<br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-offset-2 col-md-8 col-md-offset-2">
			<div class="btn-group btn-breadcrumb">
				<a href="<?php echo base_url(); ?>" class="btn btn-success"><i class="glyphicon glyphicon-home"></i></a>
				<a href="<?php echo site_url('Forum'); ?>" class="btn btn-success">Forum</a>
				<a href="<?php echo site_url('Forum/voir_forum/'.$lien); ?>" class="btn btn-success">Voir forum</a>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-offset-2 col-md-8 col-md-offset-2">
	<?php
		if(!empty($topic))
		{
			foreach($topic as $top)
			{
				$titre = $top['forum_name'];
			}
	?>
			<div class="page-header">
				<h2><?php echo $titre; ?></h2>
			</div>
		
		<?php
			if(!empty($annonce))
			{
				foreach($annonce as $a)
				{
		?>
				<div class="row">
					<a href="<?php echo site_url('Forum/voir_topic/'.$a['topic_id']); ?>"><div class="col-md-offset-1 col-md-10 col-md-offset-1">
						<div class="panel panel-default annonce">
							<div class="panel-body">
								<div class="row">
									
									<div class="col-xs-2">
										<div class="thumbnail">
										  <img src="<?php echo site_url('assets/uploads/'.$a['forum_image']);?>" alt="...">
										</div>
									</div>
									<div class="col-xs-6">
										<p><?php echo $a['topic_titre']; ?></p>
									</div>
									
									<div id="heure">
										<div class="col-xs-4 text-right">
											<p><?php echo $a['topic_time'];?></p>
											<p>Par: <span class="glyphicon glyphicon-user"></span> <?php echo $a['pseudo']; ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
					</a>
				</div>
			<?php
				}
			}
			else
			{
			?>
			
				<div class = "col-md-12">
					<div id="pan">
						<div class="alert alert-warning" role="alert">
							<h3><center>Désolé!!!</center></h3>
							<center><p>Il n'ya aucune annonce pour l'instant</p></center><br>
							<!--<center><a class="btn btn-primary" href='index.php'>Accueil</a></center>-->
						</div>
					</div>
				</div><br><br>
				<hr></hr>
			
			<?php
			}
			?>
		
		
		
		
		
		
		<?php
			foreach($topic as $t)
			{
		?>
		<br><br><br><br>
		<hr></hr>
		<div class="row">	
			<a href="<?php echo site_url('Forum/voir_topic/'.$t['topic_id']); ?>"><div class="col-md-offset-1 col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							
							<div class="col-xs-2">
								<div class="thumbnail">
								  <img src="<?php echo site_url('assets/uploads/'.$t['forum_image']);?>" alt="...">
								</div>
							</div>
							<div class="col-xs-6">
								<p><?php echo $t['topic_titre']; ?></p>
							</div>
							
							<div id="heure">
								<div class="col-xs-4 text-right">
									<p><?php echo $t['topic_time'];?></p>
									<p>Par: <span class="glyphicon glyphicon-user"></span> <?php echo $t['pseudo']; ?></p>
								</div>
							</div>
							
							
							<?php
								$data = $this->session->userdata('login');
								$pseudo = $data['pseudo'];
								$id_users = $data['id_users'];
								$rang = $data['rang'];
							
								if(isset($pseudo) and $id_users == $t['topic_createur'] || $rang == 3) 
								{
							?>
								<div class="col-md-10 text-right">
									<a href="#" title="modifier"><span class="glyphicon glyphicon-cog"></span></a>
									<a href="#" title="supprimer"><span class="glyphicon glyphicon-trash"></span></a>
								
								<?php
								if(isset($pseudo) and $rang == 3)
								{
							?>
							
									<a href="#" title="deplacer"><span class="glyphicon glyphicon-edit"></span></a>
							
							<?php
								}
							?>
								</div>
							<?php
								}
							?>
						
							
							
							
					</div>
				</div>
			</div>
			</div></a>
		</div>
			
		<?php
				
		
			}
		?>
		
		<?php
			}
			else
			{
		?>
		<br><br>
			<div class = "col-md-12">
				<div id="pan">
					<div class="alert alert-warning" role="alert">
						<h3><center>Désolé!!!</center></h3>
						<center><p>Il n'ya aucun sujet pour l'instant</p></center><br>
						<!--<center><a class="btn btn-primary" href='index.php'>Accueil</a></center>-->
					</div>
				</div>
			</div>
		
		<?php
				
			}
			
				$data = $this->session->userdata('login');
				$pseudo = $data['pseudo'];
				
				if($pseudo)
				{
					echo "<center><a class='btn btn-primary' href='".site_url('Forum/ajouter_sujet/'.$lien)."'>Ajouter un sujet</a></center>";
				}
				
		?>
			
			<br><br>
			<div class = "col-lg-12 text-center">
					<?php echo $pagination;?>
				</div>
		</div>
	</div>
</div>