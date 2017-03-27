<div class = "row">
	<div class = "col-md-offset-4 col-md-4 col-md-offset-4">
		<?php echo form_open('', array('class' => 'well'));?>
			<?php echo form_fieldset('Ajouter un utilisateur');?>
			
			<div class = "form-group">
				<?php echo form_label('Nom d\'utilisateur : <b class = "text-danger">*</b>', 'users_username');?>
				<input  value = "<?php echo set_value('users_username');?>" type="text" name = "users_username" class="form-control tooltip-input" placeholder="Nom d'utilisateur..." required title = "Entrez le nom d'utilisateur." />
				<?php echo form_error('users_username');?>
			</div>
			<div class = "form-group">
				<?php echo form_label('Adresse E-mail : <b class = "text-danger">*</b>', 'users_email');?>
				<input  value = "<?php echo set_value('users_email');?>" type="email" name = "users_email" class="form-control tooltip-input" placeholder="Adresse E-mail..." title = "Entrez l'adresse E-mail." />
				<?php echo form_error('users_email');?>
			</div>
			
			<div class = "form-group">
				<?php echo form_label('Nom de famille : <b class = "text-danger">*</b>', 'users_nom');?>
				<input  value = "<?php echo set_value('users_nom');?>" type="text" name = "users_nom" class="form-control tooltip-input" placeholder="Nom de famille..." title = "Entrez le nom de famille." />
				<?php echo form_error('users_nom');?>
			</div>
			
			<div class = "form-group">
				<?php echo form_label('Prénom : <b class = "text-danger">*</b>', 'users_prenom');?>
				<input  value = "<?php echo set_value('users_prenom');?>" type="text" name = "users_prenom" class="form-control tooltip-input" placeholder="Prénom ..." title = "Entrez le prénom." />
				<?php echo form_error('users_prenom');?>
			</div>
			
			<div class = "form-group">
				<?php echo form_label('Fonction : <b class = "text-danger">*</b>', 'users_permission');?>
				<?php
					$permissions = array(
										'' => 'choisir la permission',
										'0' => 'Directeur',
										'1' => 'chef de département',
										'2' => 'Secretaire'
										);
				echo form_dropdown('users_permission', $permissions, set_value('users_permission'), array('class' => 'form-control tooltip-input', 'required' => true));
				?>
				<?php echo form_error('users_permission');?>
			</div>
			
			<div class = "form-group">
				<?php echo form_submit('submit', 'Valider', array('class' => 'btn btn-primary btn-block'));?>
			</div>
			<?php echo form_fieldset_close();?>
		<?php echo form_close();?>
	</div>
	<p class = "text-center"><a href="<?php echo site_url('users'); ?>" class="btn btn-sm btn-primary"><i class = "glyphicon glyphicon-th-list"></i> Liste des utilisateurs</a></p>
</div>