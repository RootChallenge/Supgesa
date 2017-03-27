<br><br><br><br>
<div class="container-fluid">
	<div class="row">
		<div class="row">
			<div class="col-md-offset-2 col-md-8 col-md-offset-2">
				<div class="btn-group btn-breadcrumb">
					<a href="<?php echo base_url(); ?>" class="btn btn-success"><i class="glyphicon glyphicon-home"></i></a>
					<a href="<?php echo site_url('Forum'); ?>" class="btn btn-success">Forum</a>
				</div>
			</div>
		</div>
		
		<div class="col-md-offset-1 col-md-10 col-md-offset-1">
			<div class="page-header">
				<h2>Categories des forum</h2>
			</div>
			
			<?php
			foreach($forum as $f)
			{
				
			?>
		
				<div class="row">
					<div class="col-md-12">
						
						<h4 class="nom_categorie"><?php echo $f['nom_categorie']; ?></h4><br>
					<div class="row">
					<?php
					foreach($f['forums'] as $d)
					{
					?>
					
					<div class="col-sm-5 col-md-4">
						<div class="thumbnail forum">
							
							<div class="row">
								<div class="col-md-5">
									<img class="img-responsive" src="<?php echo 'assets/uploads/'.$d['forum_image']; ?>" alt="...">
								</div>
								
								<div class="col-md-offset-1 col-md-5">
									<div class="caption">
										<center>
											<h4 class="contenu_tuto"><a href="<?php echo site_url('Forum/voir_forum/'.$d['forum_id']); ?>">
												<?php echo $d['forum_name']; ?>
											</a></h4>
										
										
										<b><?php echo '' /*$d['forum_desc']*/; ;?></b></center><br>
									</div>
								</div>
							</div>
								
								
						</div>
					</div>
				<?php
					}
				?>
					</div><br><br>
					<hr>
				</div>
			</div>
		
		<?php
			}
		?>
			
		</div>
		
	</div>
</div>