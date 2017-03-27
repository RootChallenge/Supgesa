<br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-offset-2 col-md-8 col-md-offset-2">
			<div class="page-header">
				<h2>Ajouter un nouveau sujet</h2>
			</div>
			
			<h5>NB:</h5> <p>Avant d'ajouter un nouveau sujet, faites une recherche a l'accueil des forums pour voir si le meme sujet n'existe pas déjà.</p><br><br>
			
			<?php echo form_open('Forum/ajouter_sujet/'.$forum, array("class"=>"form-horizontal")); ?>
				<div class="row">
					<div class = "col-md-12">
						<div class = "col-md-offset-2 col-md-8 col-md-offset-2">
							<div class="form">
							
								<label for="titre">Titre du sujet:</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control" placeholder="Le titre du sujet..." name="titre" id="titre">
								</div><br>
								
								<label for="contenu">Contenu du sujet:</label>
								<textarea name="contenu"></textarea><br>
								
								<center><input type="submit" class="btn btn-primary" name="submit" value="Valider"></center><br><br>
								
								
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>