<?php
	
	if(!empty($_FILES['upload'])){
		$absolutePath = '/Challenge/assets/image/'.$_FILES['upload']['name'];
		$relativePath = '../../../../image/'.$_FILES['upload']['name'];
		
		
		if (($_FILES['upload'] == "none") || (empty($_FILES['upload']['name']))){
		   $show = "Aucun fichier selectionné !";
		}
		else if ($_FILES['upload']["size"] == 0){
		   $show = "Fichier image incorrect !";
		}
		else if (($_FILES['upload']["type"] != "image/gif") && ($_FILES['upload']["type"] != "image/pjpeg") && ($_FILES['upload']["type"] != "image/jpeg") && ($_FILES['upload']["type"] != "image/png") && ($_FILES['upload']["type"] != "image/jpg")){
		   $show = "Vous devez selectionner une image du type (jpg ,png, gif, jpeg) ! ";
		}
		else if (!is_uploaded_file($_FILES['upload']["tmp_name"])){
		   $show = "Aucun fichier selectionné";
		}
		else {
		  $show = "";
		  $move = @move_uploaded_file($_FILES['upload']['tmp_name'], $relativePath);
		  if(!$move){
			 $show = "Erreur lors d'envoi de l'image sur le serveur";
		  }
		}
	}
	else{
		$show = "Aucun fichier selectionné";
	}
	// $show = "aaaaaaaaaaaaaaaaaaaa";
	$funcNum = $_GET['CKEditorFuncNum'] ;
	echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$absolutePath', '$show');</script>";
	// echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, 'foo', '$show');</script>";
?>