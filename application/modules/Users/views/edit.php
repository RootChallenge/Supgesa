<div class = "row">
	<div class = "col-md-offset-4 col-md-4 col-md-offset-4">
		<?php echo form_open('', array('class' => 'well'));?>
			<?php echo form_fieldset('Modification de votre compte');?>
			
			<div class = "form-group">
				<?php echo form_label('Nom d\'utilisateur : <b class = "text-danger">*</b>', 'users_username');?>
				<input  value = "<?php echo set_value('users_username')?set_value('users_username'):$users->users_username;?>" type="text" name = "users_username" class="form-control tooltip-input" placeholder="Nom d'utilisateur..." required title = "Entrez le nom d'utilisateur." />
				<?php echo form_error('users_username');?>
			</div>
			
			<div class = "form-group">
				<?php echo form_label('Nouveau mot de passe : <b class = "text-danger">*</b>', 'users_password');?>
				<input  value = "" type="password" name = "users_password" class="form-control tooltip-input" placeholder="Mot de passe..."  title = "Entrez votre nouveau mot de passe ou laissez vide pour ne pas changer." />
				<?php echo form_error('users_password');?>
			</div>
								
			<div class = "form-group">
				<?php echo form_label('Nom de famille : <b class = "text-danger">*</b>', 'users_nom');?>
				<input  value = "<?php echo set_value('users_nom')?set_value('users_nom'):$users->users_nom;?>" type="text" name = "users_nom" class="form-control tooltip-input" placeholder="Nom de famille..." title = "Entrez le nom de famille." />
				<?php echo form_error('users_nom');?>
			</div>
			
			<div class = "form-group">
				<?php echo form_label('Prénom : <b class = "text-danger">*</b>', 'users_prenom');?>
				<input  value = "<?php echo set_value('users_prenom')?set_value('users_prenom'):$users->users_prenom;?>" type="text" name = "users_prenom" class="form-control tooltip-input" placeholder="Prénom ..." title = "Entrez le prénom." />
				<?php echo form_error('users_prenom');?>
			</div>
			
			
			<div class = "form-group">
				<?php echo form_submit('submit', 'Valider', array('class' => 'btn btn-primary btn-block'));?>
			</div>
			<?php echo form_fieldset_close();?>
		<?php echo form_close();?>
	</div>
</div>