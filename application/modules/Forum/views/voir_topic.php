<br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-offset-2 col-md-8 col-md-offset-2">
			<div class="btn-group btn-breadcrumb">
				<a href="<?php echo base_url(); ?>" class="btn btn-info"><i class="glyphicon glyphicon-home"></i></a>
				<a href="<?php echo site_url('Forum'); ?>" class="btn btn-info">Forum</a>
				<a href="<?php echo site_url('Forum/voir_topic/'.$lien); ?>" class="btn btn-info">Voir topic</a>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-offset-2 col-md-8 col-md-offset-2">
		<?php
			foreach($topic as $top)
			{
				$titre = $top['topic_titre'];
				$id = $top['topic_id'];
			}
		?>
			<div class="page-header">
				<h3><?php echo $titre; ?></h3>
			</div>
			
			
			<div class="row">
				<div class="col-md-10 text-right">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="CDeveloppeur" data-lang="fr">Tweeter</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					<a data-toggle="modal" href="#" data-target="#modo" class="btn btn-info btn-xs">Signaler aux modérateurs</a>
					
					<?php echo form_open_multipart('Forum/alerte_moderateur', array("class"=>"form-horizontal")); ?>
						<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modo" class="modal fade" style="display: none;">
							<div class="modal-dialogue modal_message">
								<div class="modal-content">
									<div class="modal-header">
										<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
										<h4 class="modal-title">Signaler aux modérateurs</h4>
									</div>
									<div class="modal-body">
										
											<div class="form-group">
												<label class="col-lg-2 control-label">Sujet</label>
												<div class="col-lg-10">
													<input type="text" placeholder="" id="inputPassword1" class="form-control" name="sujet">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-2 control-label">Message</label>
												<div class="col-lg-10">
													<textarea rows="10" cols="30" class="form-control" id="" name="message"></textarea>
												</div>
											</div>
											
											<input type="hidden" name="id" value="<?php echo $id; ?>">

											<div class="form-group">
												<div class="col-lg-offset-2 col-lg-10">
													<button class="btn btn-send" type="submit">Envoyer </button>
												</div>
											</div>
										
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					<?php echo form_close(); ?>
				</div>
			</div><br>
			
			
			
		<?php
			foreach($topic as $t)
			{
		?>
			<div class="row">
				<div class="col-md-offset-1 col-md-10 col-md-offset-1">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-4 col-md-2">
									<div class="thumbnail">
										<?php
											if(empty($t['avatar']))
											{
										?>
											<img src="<?php echo site_url('assets/avatar/users/1.jpg'); ?>" alt="...">
										<?php
											}
											else
											{
										?>
											<img src="<?php echo site_url('assets/avatar/users/'.$t['avatar']); ?>" alt="...">
										<?php
											}
										?>
									</div>
								</div>
								
								<div class="col-md-1">
									<p><?php echo "<b>".$t['pseudo']."</b>"; ?></p>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-offset-3 col-md-8">
									<p><?php echo $t['topic_texte']; ?></p>
								</div>
							</div>
						</div>
					</div><hr></hr>
				</div>
			
		<?php
			}
		?>
		
		
		<?php
		foreach($post as $p)
		{
		?>
			<!--Commentaires-->
			<div class="col-md-offset-1 col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="comment">
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-4 col-md-2">
									<div class="thumbnail">
										<?php
											if(empty($t['avatar']))
											{
										?>
											<img src="<?php echo site_url('assets/avatar/users/1.jpg'); ?>" alt="...">
										<?php
											}
											else
											{
										?>
											<img src="<?php echo site_url('assets/avatar/users/'.$t['avatar']); ?>" alt="...">
										<?php
											}
										?>
									</div>
								</div>
							
								<div class="col-md-1">
									<p><?php echo $p['pseudo']; ?></p>
								</div>
								
								<div id="heure">
									<div class="col-md-9 text-right">
										<p><i><?php echo $p['post_time']; ?></i></p>
									</div>
								</div>

								
								<?php
									$data = $this->session->userdata('login');
									$pseudo = $data['pseudo'];
									$id_users = $data['id_users'];
									$rang = $data['rang'];
								
									if(isset($pseudo) and $id_users == $p['post_createur'] || $rang == 3)
									{
								?>
									<div class="col-md-10 text-right">
										<a href="#" title="modifier"><span class="glyphicon glyphicon-cog"></span></a>
										<a href="#" title="supprimer"><span class="glyphicon glyphicon-trash"></span></a>
									
									</div>
								<?php
									}
								?>
								
										
							</div>
						
							<div class="row">
								<div class="col-md-offset-3 col-md-8">
									<p><?php echo $p['post_texte']; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div><hr></hr>
			</div>
			<!-- Fin des commentaire -->
		<?php
		}
		?>
			
			
			<?php
				if($t['annonce'] == 1)
				{
			?>
			
				<br><div class="row">
					<div class="col-md-12">
						<div class="alert alert-info" role="alert">
							<h3><center>Information!!!</center></h3>
							<center><p>Vous ne pouvez pas commenter une annonce</p></center><br>
						</div>
					</div>
				</div>
			
			<?php
				}
				else if(!$this->session->userdata('login'))
				{
			?>
				
				<br><div class="row">
					<div class="col-md-12">
						<div class="alert alert-info" role="alert">
							<h3><center>Information!!!</center></h3>
							<center><p>Vous devez vous connecté avant de poster une réponse</p></center><br>
						</div>
					</div>
				</div>
			
			<?php
				}
			
				else
				{
			?>
			
				<div class="col-md-offset-1 col-md-10 col-md-offset-1">	
					<br><br><div class="form">
						<?php echo form_open('Forum/poster_commentaire', array("class" => "form-horizontal")) ?>
							<label for="poster">Poster un commentaire:</label>
							<div class="input-group">
								<textarea name = "contenu" class="form-control"></textarea>
							</div><br>
							
							
							<input type="hidden" name="t" value="<?php echo $t['topic_id']; ?>">
							<center><input type="submit" class="btn btn-primary" name="submit" value="Poster"></center><br><br>
						<?php echo form_close(); ?>
					</div>
				</div>
			
			<?php
				}
			?>
			
		</div>
			
			
		</div>
	</div>
</div>